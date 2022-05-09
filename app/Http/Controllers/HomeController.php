<?php

namespace App\Http\Controllers;

use App\Acompanhe;
use Illuminate\Http\Request;
use Helper;
use App\Contato;
use App\GoogleMetaTag;
use App\Mail\NewsMail;
use App\News;
use App\tv;
use Illuminate\Support\Facades\Mail;
use Validator;

class HomeController extends Controller
{
    // metodo constructor
    public function __construct()
    {
        // definindo timezone e data/hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $this->today = strtotime('now');
    }

    // retorna view home
    public function index()
    {

        $Google = GoogleMetaTag::where('title',"=","home")->first();

        if($Google == null)
        {
            $Google = null;
        }

        $acompanhe = Acompanhe::where('datePost','<', $this->today)->orderBy('order','asc')->first();
       
        if($acompanhe == null)
        {
            $acompanhe = null;
        }

        return view('pages/home', array(
            'acompanhe' => $acompanhe,
            'Google' => $Google
        ));
        
    }

    public function news(Request $request)
    {
        if($request->codigo != '')
        {
            die();
        }

        $Validator = Validator::make($request->all(),[
            "nome" => "required|string|max:255",
            "Whatsapp" => "required|string|max:18",
        ]);

        if($Validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($Validator);
        }

        else
        {

            $dados = array(
                'url' => URL('/'),
                'nome' => $request->nome,
                'telefone' => $request->Whatsapp
            );

            Mail::to(Helper::getItem('email-client'))->send(new NewsMail($dados));

            $news = new News();
            $news['title'] = $request->nome;
            $news['telephone'] = $request->Whatsapp;
            $news['date'] = date('d/m/Y');
            $news['time'] = date('H:i:s');
            $news['status'] = 'Não lido';
            $news['telephone'] = $request->Whatsapp;

            if($news->save())
            {
                return redirect('/')->with('success','Dados enviados com sucesso!');
            }

            else
            {
                return redirect('/')->with('error','Erro ao enviar mensagem');
            }

        }

    }

}
