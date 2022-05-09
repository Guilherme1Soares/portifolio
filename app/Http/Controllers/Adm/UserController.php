<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\Contato;
use App\News;
use Helper;

class UserController extends Controller
{
    // metodo constructor 
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
        //$user = User::where('id', '=', 1)->get()->first();

        return view('adm/user/user-edit', array(
            
            'notiNews' => $this->notiNews,
            'notiContato' => $this->notiContato,
        ));
    }

    // aplicando edições 
    public function submit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'usuario' => 'required|string',
            'email' => 'required|email',
        ]);

        // redirecionando caso houver algum erro
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::find($id);
        $user['name'] = $request->get('nome');
        $user['username'] = $request->get('usuario');
        $user['email'] = $request->get('email');
        if ($request->get('senha') != null) {
            $user['password'] = Hash::make($request->get('senha'));    
        }
        if($user->save()) {
            return redirect('/adm/dados-usuario')->with('success', 'Dados alterado com sucesso');
        }

    }
}
