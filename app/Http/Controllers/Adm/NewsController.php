<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Contato;
use Validator;
use Helper;

class NewsController extends Controller
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
        $news = News::paginate(10);

        return view('adm/news/news-home', array(
            'news' => $news,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // retorna a view de cadastro
    public function create()
    {
        return view('adm/news/news-create', array(
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // validando e amarzenando dados
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'telefone' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // amarzenando dados no banco
        $news = new News();
        $news['title'] = $request->input('nome');
        $news['telephone'] = $request->input('telefone');
        $news['date'] = date('d/m/Y');
        $news['time'] = date('H:i:d');
        $news['status'] = "Não lido";

        // redirecionando com mensagem de sucesso
        if ($news->save()) {
            return redirect('/adm/news/')->with('success', 'Seus dados foram cadastrados com sucesso');
        }

    }
    
    // retorna a view de edição
    public function edit($id)
    {
        $news = News::find($id);
        $news['status'] = "lido";
        $news->save();

        return view('adm/news/news-edit', array(
            'news' => $news,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // validando e amazernando dados editados
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'telefone' => 'required|string',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // amarzenando dados no banco
        $news = News::find($id);
        $news['title'] = $request->get('nome');
        $news['telephone'] = $request->get('telefone');

        // redirecionando com mensagem de sucesso
        if ($news->save()) {
            return redirect('/adm/news/')->with('success', 'Seus dados foram editados com sucesso');
        }
    }

    // buscando dados
    public function search(Request $request) 
    {
        $search = $request['busca'];
        $news = News::where('title', 'like', '%'.$search.'%')->paginate(15);

        return view('adm/news/news-search', array(
            'news' => $news,
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }
    
    // gerar relatório Exel
    public function excel()
    {
        $excels = News::get()->all();

        return view('adm/news/news-excel', array(
            'excels' => $excels,
        ));
    }

    // deletar dados solicitado
    public function destroy($id)
    {
        $news = News::find($id);
        if ( $news->delete() ) {
            return redirect('/adm/news/')->with('delete', 'Seus dados foram removido com sucesso');
        }
    }
}
