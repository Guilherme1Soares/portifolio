<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\GoogleMetaTag;
use App\Contato;
use App\News;

class GoogleController extends Controller
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

    // retorna todos os dados
    public function index()
    {
        $google = GoogleMetaTag::orderBy('id', 'desc')->get()->all();

        return view ('adm/google/google-home', array(
            'google' => $google,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // retorna a view de cadastro 
    public function create()
    {
        return view('adm/google/google-create', array(
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // validação e armazenamento de dados cadastrados
    public function store(Request $request)
    {
        // validando os dados recebidos
        $validator = Validator::make($request->all(), [
            'pagina' => 'required|string',
            'descricao' => 'required|string',
            'PalavraChave' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $google = new GoogleMetaTag();
        $google['title'] = $request->input('pagina');
        $google['description'] = $request->input('descricao');
        $google['text'] = $request->input('PalavraChave');
        $google['status'] = "Não lido";
        $google['date'] = date('d/m/Y');
        $google['time'] = date('H:i:s');

        // redirecionando com mensagem de sucesso
        if ($google->save()) {
            return redirect('/adm/tags/')->with('success', 'Dados cadastrados com sucesso');
        }
    }

    // retorna a view de edição
    public function edit($id)
    {
        $google = GoogleMetaTag::find($id);

        return view('adm/google/google-edit', array(
            'google' => $google,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // validação e armazenamento de dados editado
    public function update(Request $request, $id)
    {
        // validando os dados recebidos
        $validator = Validator::make($request->all(), [
            'PalavraChave' => 'required|string',
            'descricao' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $google = GoogleMetaTag::find($id);
        $google['description'] = $request->get('descricao');
        $google['text'] = $request->get('PalavraChave');
        $google['status'] = "Não lido";
        $google['date'] = date('d/m/Y');
        $google['time'] = date('H:i:s');

        // redirecionando com mensagem de sucesso
        if ($google->save()) {
            return redirect('/adm/tags/')->with('edited', 'Dados atualizados com sucesso');
        }
    }

    // buscando dados
    public function search(Request $request) 
    {
        $search = $request['search'];

        $google = GoogleMetaTag::orderBy('id', 'desc')->where('title', 'like', '%'.$search.'%')->get()->all()->limit(20);

        return view('adm/google/google-search', array(
            'google' => $google,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // apagando dados e fotos solicitados
    public function destroy($id)
    {
        $google = GoogleMetaTag::find($id)->delete();

        return redirect('/adm/tags')->with('delete', 'Dados removido com sucesso');
    }
}
