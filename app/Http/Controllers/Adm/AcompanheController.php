<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Acompanhe;
use App\Contato;
use App\News;
use Validator;
use Helper;
use URL;
use App\Seo;
use \Gumlet\ImageResize;


class AcompanheController extends Controller
{
    // metodo construtor
    public function __construct()
    {
        // aplicando verificação de login
        $this->middleware('auth');
        
        // definindo timezone e data/hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $this->today = strtotime('now');

        // notificçoes contatos e news
        $this->notiContato = Contato::where('status', '=', 'Não lido')->get()->all();
        $this->notiNews = News::where('status', '=', 'Não lido')->get()->all();
    }

    // mostrar todos os dados 
    public function index()
    {
        // trazendo os dados que nao foram agendadas
        $new = Acompanhe::where('order', '=', null)->orderBy('id', 'desc')->get()->first();
        if ($new === null) {
            $new = Acompanhe::orderBy('order', 'asc')->get()->first();
        }

        // validando se os dados são nulos
        if ($new === null) {
            $acompanhe = null;
        } else {
            // trazendo todos os post com excessao do dado new
            $acompanhe = Acompanhe::where('id', '<>', $new['id'])->orderBy('id', 'desc')->paginate(10);
        }

        return view('adm/acompanhe/acompanhe-home', array(
            'new' => $new,
            'acompanhe' => $acompanhe,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // retorna a view de cadastro 
    public function create()
    {
        return view('adm/acompanhe/acompanhe-create', array(
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // validação e armazenamento de dados cadastrados
    public function store(Request $request)
    {
        // validando os dados recebidos
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:200',
            'resumo' => 'required|string',
            'autor' => 'required|string',
            'conteudo' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $remodel = Acompanhe::orderBy('order','desc')->get();
        foreach($remodel as $remodels)
        {
            $id = $remodels['order'] + 1;
            $acompanhe = Acompanhe::find($remodels['id']);
            $acompanhe['order'] = $id;
            $acompanhe->update();
        }

        // armazenandos dados no banco de dados
        $acompanhe = new Acompanhe();
        $acompanhe['title'] = $request->input('titulo');
        $acompanhe['subtitle'] = $request->input('resumo');
        $acompanhe['text'] = $request->input('conteudo');
        $acompanhe['author'] = $request->input('autor');
        $acompanhe['url'] = Helper::cleanUrl($request->input('titulo'));
        $acompanhe['video'] = $request->input('video');
        $acompanhe['date'] = $request->input('date');
        $acompanhe['time'] = $request->input('time');
        $acompanhe['type'] = $request->input('type');
        $acompanhe['datePost'] = Helper::toTimestamp($acompanhe['date'], $acompanhe['time']);
        $acompanhe['order'] = 1;
        
        $imageRequestEdit = $acompanhe['image'];
        $imageRequestEditPng = substr($acompanhe['image'], 0, -4);
        // verificando status
        if ($acompanhe['datePost'] > $this->today) {
            $acompanhe['status'] = "Pendente";
        } else {
            $acompanhe['status'] = "Publicado";
        }

        // verificando se foi feito algum upload de imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extensao = $image->getClientOriginalExtension();
            $name = env('APP_NAME')."-".Helper::toTimestamp($acompanhe['date'], $acompanhe['time'])."-".$acompanhe['id'].".".$image->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/acompanhe/'), $name);

            // amarzena o caminho no banco
            $acompanhe['image'] = "public/upload/acompanhe/".$name;

            $row = Acompanhe::where("title","=", $request->input('titulo'))->first();
            if($row != null)
            {
                return redirect('/adm/acompanhe/')->with('delete',"O Titulo já existe.");
            }
            else
            {
                $xml = "";
                $xml_seo = "";
                $acompanhe->save();
                $acompanhe = Acompanhe::all();
                if(count($acompanhe) > 0)
                {
                    foreach($acompanhe as $acompanhes)
                    {
                        $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                        $data = date('Y-m-d',$acompanhes['datePost']);
                        $time = $acompanhes['time'];
                        $assemble = '
                            <url>
                                <loc>'.$url.'</loc>
                                <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                                <priority>1.00</priority>
                            </url>
                        ';
                        $xml = $xml.$assemble;
                    }

                    $Seo = Seo::all();
                    if(count($Seo) > 0)
                    {
                        foreach($Seo as $Seos){
                            $xml_seo = $xml_seo.$Seos['sitemap'];
                        }
                    }

                    $xml_header = Self::XmlHeader();
                    $xml_body = $xml_seo.$xml;
                    $xml_footer = "</urlset>";
                    $xml_generator = $xml_header.$xml_body.$xml_footer;
                    $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                    file_put_contents($dir, $xml_generator);
                }

                return redirect('/adm/acompanhe/')->with('success', 'Seus dados foram cadastrado com sucesso');
            } 

        }
        else
        {
            return redirect('/adm/acompanhe/create')->with('error', 'Favor anexar uma foto.');
        }
    }

    // retorna a view de edição
    public function edit($id)
    {
        $acompanhe = Acompanhe::find($id);

        return view('adm/acompanhe/acompanhe-edit', array(
            'acompanhe' => $acompanhe,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // recenbendo dados para serem atualizados
    public function update(Request $request, $id)
    {
        // validando os dados recebidos
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:200',
            'resumo' => 'required|string',
            'autor' => 'required|string',
            'conteudo' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // armazenando dados patualizados
        $acompanhe = Acompanhe::find($id);
        $acompanhe['title'] = $request->get('titulo');
        $acompanhe['subtitle'] = $request->get('resumo');
        $acompanhe['text'] = $request->get('conteudo');
        $acompanhe['author'] = $request->get('autor');
        $acompanhe['url'] = Helper::cleanUrl($request->get('titulo'));
        $acompanhe['video'] = $request->input('video');
        $acompanhe['date'] = $request->get('date');
        $acompanhe['time'] = $request->get('time');
        $acompanhe['type'] = $request->get('type');
        $acompanhe['datePost'] = Helper::toTimestamp($acompanhe['date'], $acompanhe['time']);

        // verificando status
        if ($acompanhe['datePost'] > $this->today) {
            $acompanhe['status'] = "Pendente";
        } else {
            $acompanhe['status'] = "Publicado";
        }
        
        // verificando se foi feito algum upload de imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extensao = $image->getClientOriginalExtension();
            $name = env('APP_NAME')."-".Helper::toTimestamp($acompanhe['date'], $acompanhe['time'])."-".$acompanhe['id'].".".$image->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/acompanhe/'), $name);

            // amarzena o caminho no banco
            $acompanhe['image'] = "public/upload/acompanhe/".$name;

            $checkTitle = Acompanhe::where("title","=", $request->input('titulo'))->get();

            if(count($checkTitle) > 0)
            {
                if($checkTitle[0]['id'] == $id)
                {
                $xml = "";
                $xml_seo = "";
                $acompanhe->save();
                $acompanhe = Acompanhe::all();
                if(count($acompanhe) > 0)
                {
                    foreach($acompanhe as $acompanhes)
                    {
                        $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                        $data = date('Y-m-d',$acompanhes['datePost']);
                        $time = $acompanhes['time'];
                        $assemble = '
                            <url>
                                <loc>'.$url.'</loc>
                                <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                                <priority>1.00</priority>
                            </url>
                        ';
                        $xml = $xml.$assemble;
                    }

                    $Seo = Seo::all();
                    if(count($Seo) > 0)
                    {
                        foreach($Seo as $Seos){
                            $xml_seo = $xml_seo.$Seos['sitemap'];
                        }
                    }

                    $xml_header = Self::XmlHeader();
                    $xml_body = $xml_seo.$xml;
                    $xml_footer = "</urlset>";
                    $xml_generator = $xml_header.$xml_body.$xml_footer;
                    $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                    file_put_contents($dir, $xml_generator);
                    }
                    return redirect('/adm/acompanhe/')->with('success', 'Seus dados foram editados com sucesso');
                }
                else
                {
                    return redirect('/adm/acompanhe/')->with('delete',"O Titulo já existe.");
                }
            }
            else
            {
                $xml = "";
                $xml_seo = "";
                $acompanhe->save();
                $acompanhe = Acompanhe::all();
                if(count($acompanhe) > 0)
                {
                    foreach($acompanhe as $acompanhes)
                    {
                        $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                        $data = date('Y-m-d',$acompanhes['datePost']);
                        $time = $acompanhes['time'];
                        $assemble = '
                            <url>
                                <loc>'.$url.'</loc>
                                <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                                <priority>1.00</priority>
                            </url>
                        ';
                        $xml = $xml.$assemble;
                    }

                    $Seo = Seo::all();
                    if(count($Seo) > 0)
                    {
                        foreach($Seo as $Seos){
                            $xml_seo = $xml_seo.$Seos['sitemap'];
                        }
                    }

                    $xml_header = Self::XmlHeader();
                    $xml_body = $xml_seo.$xml;
                    $xml_footer = "</urlset>";
                    $xml_generator = $xml_header.$xml_body.$xml_footer;
                    $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                    file_put_contents($dir, $xml_generator);
                    }
                    return redirect('/adm/acompanhe/')->with('success', 'Seus dados foram editados com sucesso');
            }
    
        }

        else
        {
            $checkTitle = Acompanhe::where("title","=", $request->input('titulo'))->get();

            if(count($checkTitle) > 0)
            {
                if($checkTitle[0]['id'] == $id)
                {
                $xml = "";
                $xml_seo = "";
                $acompanhe->save();
                $acompanhe = Acompanhe::all();
                if(count($acompanhe) > 0)
                {
                    foreach($acompanhe as $acompanhes)
                    {
                        $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                        $data = date('Y-m-d',$acompanhes['datePost']);
                        $time = $acompanhes['time'];
                        $assemble = '
                            <url>
                                <loc>'.$url.'</loc>
                                <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                                <priority>1.00</priority>
                            </url>
                        ';
                        $xml = $xml.$assemble;
                    }

                    $Seo = Seo::all();
                    if(count($Seo) > 0)
                    {
                        foreach($Seo as $Seos){
                            $xml_seo = $xml_seo.$Seos['sitemap'];
                        }
                    }

                    $xml_header = Self::XmlHeader();
                    $xml_body = $xml_seo.$xml;
                    $xml_footer = "</urlset>";
                    $xml_generator = $xml_header.$xml_body.$xml_footer;
                    $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                    file_put_contents($dir, $xml_generator);
                    }
                    return redirect('/adm/acompanhe/')->with('success', 'Seus dados foram editados com sucesso');
                }
                else
                {
                    return redirect('/adm/acompanhe/')->with('delete',"O Titulo já existe.");
                }
            }
            else
            {
                $xml = "";
                $xml_seo = "";
                $acompanhe->save();
                $acompanhe = Acompanhe::all();
                if(count($acompanhe) > 0)
                {
                    foreach($acompanhe as $acompanhes)
                    {
                        $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                        $data = date('Y-m-d',$acompanhes['datePost']);
                        $time = $acompanhes['time'];
                        $assemble = '
                            <url>
                                <loc>'.$url.'</loc>
                                <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                                <priority>1.00</priority>
                            </url>
                        ';
                        $xml = $xml.$assemble;
                    }

                    $Seo = Seo::all();
                    if(count($Seo) > 0)
                    {
                        foreach($Seo as $Seos){
                            $xml_seo = $xml_seo.$Seos['sitemap'];
                        }
                    }

                    $xml_header = Self::XmlHeader();
                    $xml_body = $xml_seo.$xml;
                    $xml_footer = "</urlset>";
                    $xml_generator = $xml_header.$xml_body.$xml_footer;
                    $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                    file_put_contents($dir, $xml_generator);
                    }
                    return redirect('/adm/acompanhe/')->with('success', 'Seus dados foram editados com sucesso');
            }
        }
    }

    // retorna view ordenação
    public function order()
    {
        $acompanhe = Acompanhe::where('order', '=', null)->orderBy('id', 'desc')->get();
        
        if (count($acompanhe) <= 0) {
            $acompanhe = Acompanhe::orderBy('order', 'asc')->get();
        }
       
        return view('adm/acompanhe/acompanhe-order', array(
            'acompanhe' => $acompanhe,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
            'datatual' => $this->today,
        ));

    }

    // orderna os dados recebidos
    public function orderned(Request $request) 
    {
        $dados = explode(',',$request['cad_id_item']);
        $ordem = 1; 

        $erray = array();
        foreach($dados as $item) {
            $id = $item;
            $acompanhe = Acompanhe::find($id);
            $erray['array '.$ordem] = $acompanhe;
            $erray['order '.$ordem] = $ordem;
            $acompanhe['order'] = $ordem;
            $acompanhe->save();
            $ordem++;
        }
        return "Dados ordernados com sucesso!";
    }

    // buscando dados
    public function search(Request $request)
    {
        // criando uma variavel de busca
        $search = $request['busca'];

        // trazendo os dados que nao foram agendadas
        $new = Acompanhe::where('datePost', '<', $this->today)->where('order', '=', null)->orderBy('id', 'desc')->get()->first();
        if ($new === null) {
            $new = Acompanhe::where('datePost', '<', $this->today)->orderBy('order', 'asc')->get()->first();
        }
        // validando se os dados são nulos
        if ($new === null) {
            $acompanhe = Acompanhe::where('title', 'like', '%'.$search.'%')->orderBy('id', 'desc')->paginate(15);
        } else {
            // trazendo todos os post com excessao do dado new
            $acompanhe = Acompanhe::where('title', 'like', '%'.$search.'%')->where('id', '<>', $new['id'])->orderBy('id', 'desc')->paginate(14);
        }
        return view('adm/acompanhe/acompanhe-search', array(
            'acompanhe' => $acompanhe,
            'new' => $new,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));

    }

    // apagando dados e fotos solicitados
    public function destroy($id)
    {
        // listando caminhos das fotos
        $storage = Acompanhe::find($id);

        // apagando dados no bando e redirecionando 
        $acompanhe = Acompanhe::find($id)->delete();
        $xml = "";
        $xml_seo = "";
        $acompanhe = Acompanhe::all();
        if(count($acompanhe) > 0)
        {
            foreach($acompanhe as $acompanhes)
            {
                $url = ENV('APP_URL_ARTICLES').$acompanhes['url'];
                $data = date('Y-m-d',$acompanhes['datePost']);
                $time = $acompanhes['time'];
                $assemble = '<url>
                    <loc>'.$url.'</loc>
                    <lastmod>'.$data.'T'.$time.':00+00:00</lastmod>
                    <priority>1.00</priority>
                    </url>';
                    $xml = $xml.$assemble;
            }

                $Seo = Seo::all();
                if(count($Seo) > 0)
                {
                    foreach($Seo as $Seos){
                        $xml_seo = $xml_seo.$Seos['sitemap'];
                    }
                }

                $xml_header = Self::XmlHeader();
                $xml_body = $xml_seo.$xml;
                $xml_footer = "</urlset>";
                $xml_generator = $xml_header.$xml_body.$xml_footer;
                $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                file_put_contents($dir, $xml_generator);
        }
        return redirect('/adm/acompanhe')->with('delete', 'Seus dados foram removidos com sucesso');
    }
}
