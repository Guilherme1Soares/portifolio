<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Contato;
use Mail;
use Helper;
use App\Mail\ContatoMail;

class ContatoController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->today = strtotime("now");
    }

    public function index()
    {
        return view('pages/contato');
    }

    public function create(Request $request)
    {
        if($request->codigo != '')
        {
            die();
        }

        else
        {
            $Validator = Validator::make($request->all(),[
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'telefone' => 'required|string|max:18',
                'mensagem' =>  'required|string|max:18'
            ]);

            if($Validator->fails())
            {
                return redirect()->back()->withInput()->withErrors($Validator);
            }
            
            else
            {
                $dados = array(
                    'url' => URL('/contato'),
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'mensagem' => $request->mensagem,
                    'termos' => $request->checkbox == 'on' ? 'Aceito receber os informativos da Oftalmologia Correa
                    ' : 'Não aceito receber os informativos da Oftalmologia Correa'
                );

                Mail::to(Helper::getItem('email-client'))->send(new ContatoMail($dados));
                // Mail::to('adm@engenhodeimagens.com.br')->send(new ContatoMail($data));

                $Contato = new Contato();
                $Contato['title'] = $request->nome;
                $Contato['email'] = $request->email;
                $Contato['telephone'] = $request->telefone;
                $Contato['text'] = $request->mensagem;
                $Contato['date'] = date('d/m/Y');
                $Contato['time'] = date('H:i:s');
                $Contato['status'] = 'Não lido';
                $Contato['term'] = $request->checkbox;

                if($Contato->save())
                {
                    return redirect('/contato')->with('success', 'Dados enviados com sucesso');
                }else
                {
                    return redirect('/contato')->with('error', 'Erro ao enviar dados');
                }
            }
        }
    }
}
