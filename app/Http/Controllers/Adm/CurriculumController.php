<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Curriculum;
use App\Contato;
use App\News;
use Helper;

class CurriculumController extends Controller
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

    public function showEdit($id)
    {
        $curriculum = Curriculum::where('id','=', $id)->first();
        
        if($curriculum == null)
        {
            return abort(404);
        }

        else
        {
            return view('adm/curriculum/curriculum-edit', array(
                'acompanhe' => $curriculum,
                'notiContato' => $this->notiContato,
                'notiNews' => $this->notiNews,
            ));
        }
    }

    public function edit(Request $request, $id)
    {
        $curriculum = Curriculum::where('id','=', $id)->first();
        
        if($curriculum == null)
        {
            return abort(404);
        }

        else
        {
            $Validator = Validator($request->all(),[
                "nome" => "required|string|max:255",
                "crm" => "required|string|max:255",
                "conteudo" => "required|string",
            ]);

            if($Validator->fails())
            {
                return redirect()->back()->withInput()->withErrors($Validator);
            }

            else
            {
                if($request->file('image') == null)
                {
                    $curriculum = Curriculum::find($id);
                    $curriculum['nome'] = $request->nome;
                    $curriculum['crm'] = $request->crm;
                    $curriculum['text'] = $request->conteudo;

                    if($curriculum->update())
                    {
                       return redirect('adm/profissionais/edit/'.$id)->with('success','Dados editado com sucesso'); 
                    }
                    else
                    {
                        return redirect('adm/profissionais/edit/'.$id)->with('error','Erro ao editar dados'); 
                    }
                }

                else
                {
                    $image = $request->file('image');
                    $name = env('APP_NAME')."-".Helper::toTimestamp(date('d/m/Y'), date('H:i:s')).".".$image->getClientOriginalExtension();
                    $request->file('image')->move(public_path('upload/clinica/'), $name);

                    $curriculum = Curriculum::find($id);
                    $curriculum['nome'] = $request->nome;
                    $curriculum['crm'] = $request->crm;
                    $curriculum['text'] = $request->conteudo;
                    $curriculum['img'] = 'public/upload/clinica/'.$name;

                    if($curriculum->update())
                    {
                       return redirect('adm/profissionais/edit/'.$id)->with('success','Dados editado com sucesso'); 
                    }
                    else
                    {
                        return redirect('adm/profissionais/edit/'.$id)->with('error','Erro ao editar dados'); 
                    }
                }
            }
        }
    }

    public function show()
    {
        $news = Curriculum::orderBy('id','asc')->take(2)->get();

        return view('adm/curriculum/curriculum-home', array(
            'news' => $news,
            'notiContato' => $this->notiContato,
            'notiNews' => $this->notiNews
        ));
    }
}
