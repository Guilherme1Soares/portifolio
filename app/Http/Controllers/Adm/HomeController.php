<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helper;
use App\Contato;
use App\News;

class HomeController extends Controller
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
        return view('adm/home', array(
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

}
