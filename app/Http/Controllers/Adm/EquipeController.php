<?php



namespace App\Http\Controllers\Adm;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Acompanhe;

use App\Contato;

use App\News;

use App\Equipe;

use Validator;

use Helper;

use URL;

use \Gumlet\ImageResize;





class EquipeController extends Controller

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



    // mostrar todos os dados 

    public function index()

    {

        // trazendo os dados que nao foram agendadas

        $new = Equipe::orderBy('id', 'desc')->get()->first();

        $acompanhe = Equipe::orderBy('id','desc')->paginate(10);

        
        return view('adm/equipe/equipe-home', array(

            'new' => $new,

            'acompanhe' => $acompanhe,

            'notiNews' => $this->notiNews,

            'notiContato' => $this->notiContato,

        ));

    }



    // retorna a view de cadastro 

    public function create()

    {

        return view('adm/equipe/equipe-create', array(

            'notiNews' => $this->notiNews,

            'notiContato' => $this->notiContato,

        ));

    }



    // validação e armazenamento de dados cadastrados

    public function store(Request $request)

    {

        // validando os dados recebidos

        $validator = Validator::make($request->all(), [

            'nome' => 'required|string|max:80',

            'cro' => 'required|string',

            'conteudo' => 'required|string',

        ]);



        // redirecionando caso houver algum erro

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }


        $remodel = Equipe::orderBy('ordem','desc')->get();

        foreach($remodel as $remodels)

        {

            $id = $remodels['ordem'] + 1;

            $acompanhe = Equipe::find($remodels['id']);

            $acompanhe['ordem'] = $id;

            $acompanhe->update();

        }


        // armazenandos dados no banco de dados

        $acompanhe = new Equipe();

        $acompanhe['title'] = $request->input('nome');

        $acompanhe['cro'] = $request->input('cro');

        $acompanhe['subtitle'] = $request->input('descricao');

        $acompanhe['text'] = $request->input('conteudo');

        $acompanhe['ordem'] =  1;


        // verificando status

        // verificando se foi feito algum upload de imagem

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $name = env('APP_NAME')."-".date('d-m-y-h-i-s').time().".".$image->getClientOriginalExtension();

            $request->file('image')->move(public_path('upload/acompanhe/'), $name);



            // $resize = new ImageResize('public/upload/acompanhe/'.$name);

            // $resize->save('public/upload/acompanhe/'.$name_webp, IMAGETYPE_WEBP);



            // armazenar o caminho no banco

            $acompanhe['image'] = "public/upload/acompanhe/".$name;

        }

        $equipe = Equipe::where('title','=',$request->nome)->first();
        
        if($equipe != null){
            return redirect('/adm/equipe/')->with('delete', 'Membro já cadastrado');
        }

        // redirecionando com mensagem de sucesso

        if ($acompanhe->save()) {

            return redirect('/adm/equipe/')->with('success', 'Seus dados foram cadastrado com sucesso');

        }        

    }



    // retorna a view de edição

    public function edit($id)

    {

        $acompanhe = Equipe::find($id);

        return view('adm/equipe/equipe-edit', array(

            'acompanhe' => $acompanhe,

            'notiNews' => $this->notiNews,

            'notiContato' => $this->notiContato,

        ));

    }



    // recenbendo dados para serem atualizados

    public function update(Request $request, $id)

    {

       // validando os dados recebidos

       $validator = Validator::make($request->all(), [

        'nome' => 'required|string|max:80',

        'cro' => 'required|string',

        'conteudo' => 'required|string',

       ]);



        // redirecionando caso houver algum erro

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }



        // armazenandos dados no banco de dados

        $acompanhe = Equipe::find($id);

        $acompanhe['title'] = $request->input('nome');

        $acompanhe['cro'] = $request->input('cro');

        $acompanhe['subtitle'] = $request->input('descricao');

        $acompanhe['text'] = $request->input('conteudo');


        // verificando se foi feito algum upload de imagem

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $name = env('APP_NAME')."-".date('d-m-y-h-i-s').time().".".$image->getClientOriginalExtension();

            // $name_webp = env('APP_NAME')."-".Helper::toTimestamp($acompanhe['date'], $acompanhe['time']).".webp";

            $request->file('image')->move(public_path('upload/acompanhe/'), $name);



            // $resize = new ImageResize('public/upload/acompanhe/'.$name);

            // $resize->save('public/upload/acompanhe/'.$name_webp, IMAGETYPE_WEBP);



            // amarzena o caminho no banco

            $acompanhe['image'] = "public/upload/acompanhe/".$name;

        }

        $equipe = Equipe::where('title','=',$request->nome)->first();

        if($equipe == null){
            if ($acompanhe->save()) {
                return redirect('/adm/equipe/')->with('success', 'Seus dados foram editados com sucesso');
            }
        }
        else
        {
            if($equipe->id != $id)
            {
                return redirect('/adm/equipe/')->with('delete', 'Erro ao atualizar dados');
            }
            else
            {
                $acompanhe->save();
                return redirect('/adm/equipe/')->with('success', 'Seus dados foram editados com sucesso');
            }
        }

        // redirecionando com mensagem de sucesso

    }



    // retorna a view de ordenação

    public function order()

    {

        $acompanhe = Equipe::orderBy('ordem', 'asc')->paginate(15);


        return view('adm/equipe/equipe-order', array(

            'acompanhe' => $acompanhe,

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

            $acompanhe = Equipe::find($id);

            $erray['array '.$ordem] = $acompanhe;

            $erray['ordem '.$ordem] = $ordem;

            $acompanhe['ordem'] = $ordem;

            $acompanhe->save();

            $ordem++;

        }

        return "Dados ordernados com sucesso!";

    }



    // buscando dados

    public function search(Request $request)

    {

        // criando uma variavel de busca

        $search = $request['busca'];


        // trazendo os dados que nao foram agendadas

        $new = Equipe::where('title', 'like', '%'.$search.'%')->first();

        // validando se os dados são nulos

        if ($new != null) {

            $acompanhe = Equipe::where('title', 'like', '%'.$search.'%')->where('id', '<>', $new['id'])->orderBy('id', 'desc')->paginate(14);

        }else{
            $acompanhe = null;
        }

        return view('adm/equipe/equipe-search', array(

            'acompanhe' => $acompanhe,

            'new' => $new,

            'notiNews' => $this->notiNews,

            'notiContato' => $this->notiContato,

        ));



    }



    // apagando dados e fotos solicitados

    public function destroy($id)

    {

        // listando caminhos das fotos

        $storage = Equipe::find($id);

       

        // apagando dados no bando e redirecionando 

        $acompanhe = Equipe::find($id)->delete();

        return redirect('/adm/equipe')->with('delete', 'Seus dados foram removidos com sucesso');

    }

}

