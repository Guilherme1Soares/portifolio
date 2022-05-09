<?php

namespace App\Http\Controllers\LGPD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\News;
use App\Contato;
use App\Mail\LGPDMail;
use Mail;
use Helper;
use Illuminate\Support\Facades\DB;

class TermosController extends Controller
{
    public function index(){
       
        return view('LGPD/termos');
       }
    
       public function submit(Request $request){

        date_default_timezone_set('America/Sao_Paulo');

        $Query = null;
        $type = "";
        $nome = $request->nome;
        $phone = $request->whatsapp;
        $email = $request->email;

        if($nome != "" ){ $type = 'nome'; $value = $nome; }
        if($phone != ""){ $type = 'phone'; $value = $phone; }
        if($email != ""){ $type = 'email'; $value = $email; }

        switch($type)
        {
            case 'nome':
                 $Query = News::where("title","=",$value)->first();
            break;

            case 'phone':
                $Query =  News::where("telephone","=",$value)->first(); 
                $Query =  News::where("title","=",$value)->first();   
            break; 

            case 'email':
                $Query = News::where("email","=",$value)->first();       
            break;

            default:
               echo 'error';
        }

        if($Query != null)
        {
              switch($type)
              {
                  case 'nome':
                     $del = News::where("title","=",$value)->delete();   
                     $mensagemCompleta =  "Nome / Telefone: ".$value."<br>";
                     $mensagemCompleta .= "Cancelou sua inscrição no website.<br>";
                     $mensagemCompleta .= "Data do cancelamento.".date('d/m/Y H:i:s');
                     $dados = array(
                       "mensagem" => $mensagemCompleta
                     );
                     if($del > 0){
                       Mail::to(Helper::getItem('email-client'))->send(new LGPDMail($dados));
                    }
      
                  break;

                  case 'phone':
                    $delNews = News::where("telephone","=",$value)->delete(); 
                    $del = Contato::where("telephone","=",$value)->delete(); 
                    $mensagemCompleta =  "Nome / Telefone: ".$value."<br>";
                    $mensagemCompleta .= "Cancelou sua inscrição no website.<br>";
                    $mensagemCompleta .= "Data do cancelamento.".date('d/m/Y H:i:s');
                    $dados = array(
                       "mensagem" => $mensagemCompleta
                     );
                     Mail::to(Helper::getItem('email-client'))->send(new LGPDMail($dados));

                  break; 

                  case 'email':
                     $delContato = Contato::where("email","=",$value)->delete();
                     $mensagemCompleta = "Seus dados foram removidos com sucesso da base de dados do website <a href='https://www.oestefer.com.br/termos'>Oeste Comercial de Ferro e Aço</a><br>";
                     $mensagemCompleta .= "Você não receberá mais e-mail deste website.<br>";
                     $mensagemCompleta .= "Data da Exclusão.".date('d/m/Y H:i:s');
                     $dados = array(
                       "mensagem" => $mensagemCompleta
                     );
                      Mail::to($value)->send(new LGPDMail($dados));

                  break;

                  default:
                     echo 'error';
              }
 
            
            return redirect()->back()->with("success","Sua inscrição foi cancelada com sucesso. Seus dados foram removidos de nossa base de dados");
        }else
        {
            return redirect()->back()->with("success","Nenhuma informação fornecida foi encontrada em nossa base de dados");
        }

      }
}
