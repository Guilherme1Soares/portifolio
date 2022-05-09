<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acompanhe;
use Validator;
use Helper;
use Mail;
use App\Mail\NewsMail;
use App\News;

class AcompanheController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->today = strtotime("now");
    }

    public function index()
    {

        $acompanhe = Acompanhe::where('datePost','<', $this->today)->orderBy('order','asc')->first();
        $news = Acompanhe::where('datePost','<', $this->today)->where('id','<>',$acompanhe['id'])->get();
        
        return view('pages/acompanhe', array(
            'acompanhe' => $acompanhe,
            'news' => $news,
        ));
    }

    public function ajax(Request $request)
    {
        $acompanhe = Acompanhe::where('datePost','<', $this->today)->where('title','LIKE','%'.$request->buscar.'%')->where('id','<>', $request->id)->get();

        if($request->buscar == '')
        {
            $acompanhe = Acompanhe::where('datePost','<', $this->today)->where('id','<>',$request->id)->get();
        }

        return view('template/Ajax', array(
            'news' => $acompanhe
        ));
    }

    public function article($url)
    {
        $acompanhe = Acompanhe::where('datePost','<', $this->today)->where('url','=',$url)->first();
        $news = Acompanhe::where('datePost','<', $this->today)->where('id','<>',$acompanhe['id'])->get();

        return view('pages/acompanhe', array(
            'acompanhe' => $acompanhe,
            'news' => $news,
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
                'url' => URL('acompanhe'),
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
                return redirect('acompanhe')->with('success','Dados enviados com sucesso!');
            }

            else
            {
                return redirect('acompanhe')->with('error','Erro ao enviar mensagem');
            }

        }

    }

    
}
