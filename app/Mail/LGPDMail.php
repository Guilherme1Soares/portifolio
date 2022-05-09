<?php







namespace App\Mail;







use Illuminate\Bus\Queueable;



use Illuminate\Mail\Mailable;



use Illuminate\Queue\SerializesModels;



use Illuminate\Contracts\Queue\ShouldQueue;

use Helper;





class LGPDMail extends Mailable



{



    use Queueable, SerializesModels;







    // variaveis do email



    public $mensagem;



    // montato array de dados



    public function __construct($data)



    {



        $this->value = array(



            $this->mensagem = $data['mensagem'],

            

           'Date' => date('d/m/Y')



        );



    }







    // retorma view de email views/email/contatos-email com dados



    public function build()



    {



        return $this->view('template/LGPDMail')->subject(Helper::getItem('subjectMail'))->with($this->value);



    }



}



