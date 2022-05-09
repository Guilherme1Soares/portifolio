<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contato;
use App\News;
use App\Seo;

class SeoController extends Controller
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
            return view('adm/seo/seo-home', array(
                'notiNews' => $this->notiNews,
                'notiContato' => $this->notiContato,
            ));
        }

        public function upload(Request $request){
            $Seo = Seo::all();
            if(count($Seo) > 0)
            {
                return redirect()->back()->with('error','Sitemap já foi anexado, caso necessite anexar novamente entre em contato com suporte técnico.');
            }
            else
            {
                if($request->hasFile('sitemap'))
                {
                    $sitemap = $request->file('sitemap');
                    $ext = $sitemap->getClientOriginalExtension();

                    if($ext != 'xml')
                    {
                        return redirect()->back()->with('error','Você deve anexar um arquivo xml');
                    }
                    
                    else
                    {
                        $xml = '';
                        $sitemap_name = md5(date('d-m-y').time()).'.'.$ext;
                        $request->file('sitemap')->move(public_path('upload/map/'), $sitemap_name);
                        $sitemap_xml = public_path('upload/map/').$sitemap_name;
                        $file = file($sitemap_xml);
                        foreach ($file as $line_num => $line) {
                           $xml = $xml.$line;
                        }                       
                        $Seo = new Seo();
                        $Seo['sitemap'] = $xml;
                        if($Seo->save())
                        {
                            $xml_header = Self::XmlHeader();
                            $xml_body = $xml;
                            $xml_footer = "</urlset>";
                            $xml_generator = $xml_header.$xml_body.$xml_footer;
                            $dir = $_SERVER['DOCUMENT_ROOT']."/sitemap.xml";
                            file_put_contents($dir, $xml_generator);
                            return redirect()->back()->with('success','sitemap anexado com successo');
                        }
                        else
                        {
                            return redirect()->back()->with('error','Erro ao gerar o sitemap.');
                        }
                    }
                }
                else
                {
                    return redirect()->back()->with('error','Favor anexar um arquivo sitemap.xml');
                }
            }
        }
    }
