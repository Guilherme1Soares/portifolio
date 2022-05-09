<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helper;
use App\Video;
use App\Contato;
use App\News;
use Validator;
class VideosController extends Controller
{
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

    public function index()
    {
    
       $Video = Video::orderBy('ordem','asc')->paginate(15);

        return view('adm/videos/videos-home', array(
            'video' => $Video,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    public function showCreate()
    {
        return view('adm/videos/videos-create', array(
            'notiContato' => $this->notiContato,
            'notiNews' => $this->notiNews
        ));
    }

    public function Create(Request $request)
    {

        $Validator = Validator::make($request->all(), [
            'nomeDoVideo' => 'required|string|max:1000',
            'autor' => 'required|string|max:255',
            'idDoVideo' => 'required|string|max:255',
        ]);

        if($Validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($Validator);
        }

        $url = Helper::cleanUrl($request->nomeDoVideo);
        $Video = Video::where('url','=',$url)->first();

        if($Video != null)
        {
            return redirect('adm/videos/showCreate')->with('Error','Erro ao cadastrar: esse vídeo já está cadastrado em seu site');
        }

        else
        {
            $date = date('d/m/Y');
            $explode = explode('/',$date);
            $newDate = Helper::showMonth($explode[1]);
            $date_formated = $explode[0].'.'.$newDate[0].$newDate[1].$newDate[2].'.'.$explode[2];
            
            $remodel = Video::orderBy('ordem','desc')->get();
            foreach($remodel as $remodels)
            {
                $id = $remodels['ordem'] + 1;
                $Video = Video::find($remodels['id']);
                $Video['ordem'] = $id;
                $Video->update();
            }

            $Video = new Video();
            $Video['code'] = $request->idDoVideo;
            $Video['url'] = $url;
            $Video['name'] = $request->nomeDoVideo;
            $Video['postedBy'] = $request->autor;
            $Video['date'] = $date_formated;
            $Video['ordem'] = 1;

            if($Video->save())
            {
                return redirect('adm/videos/showCreate')->with('success','Video cadastrado com successo');
            }

        }

    }

    public function showEdit($id)
    {
        $Video = Video::find($id);

        if($Video == null)
        {
            return abort(404);
        }
           
        return view('adm/videos/videos-edit', array(
            'video' => $Video,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    public function Edit(Request $request, $id)
    {
        $Video = Video::where('id','=', $id)->first();

        if($Video == null)
        {
            return abort(404);
        }

        else
        {

            $Validator = Validator::make($request->all(), [
                'nomeDoVideo' => 'required|string|max:1000',
                'autor' => 'required|string|max:255',
                'idDoVideo' => 'required|string|max:255',
            ]);
    
            if($Validator->fails())
            {
                return redirect()->back()->withInput()->withErrors($Validator);
            }
    
            $url = Helper::cleanUrl($request->nomeDoVideo);
            $VideoUrl = $Video->url;
                        
                $Video = Video::find($id);
                $Video['code'] = $request->idDoVideo;
                if($url != $VideoUrl) { $Video['url'] = $url; }
                $Video['name'] = $request->nomeDoVideo;
                $Video['postedBy'] = $request->autor;
    
                if($Video->update())
                {
                    return redirect('adm/videos/edit/'.$id)->with('success','Video atualizado com successo');
                }
        }
    }

    public function order()
    {
        
        $Video = Video::orderBy('ordem','asc')->paginate(15);
           
        return view('adm/videos/videos-order', array(
            'acompanhe' => $Video,
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
            $Video = Video::find($id);
            $erray['array '.$ordem] = $Video;
            $erray['order '.$ordem] = $ordem;
            $Video['ordem'] = $ordem;
            $Video->save();
            $ordem++;
        }
        return "Dados ordernados com sucesso!";
    }


    public function search(Request $request)
    {

        $search = $request['busca'];
        $acompanhe = Video::where('name', 'like', '%'.$search.'%')->orderBy('ordem', 'asc')->paginate(15);

        return view('adm/videos/videos-search', array(
            'acompanhe' => $acompanhe,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));

    }

    public function del($id)
    {
        $Video = Video::where('id','=', $id)->first();

        if($Video == null)
        {
            return abort(404);
        }

        $Video = Video::find($id);

        if($Video->delete())
        {
            return redirect('adm/videos')->with('delete','Dados deletado com sucesso');
        }
    }

}
