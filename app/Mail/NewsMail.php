<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsMail extends Mailable
{
    use Queueable, SerializesModels;

    // variaveis do email
    public $url;
    public $nome;
    public $telefone;
    public $value;

    // montato array de dados
    public function __construct($data)
    {
        $this->value = array(
            $this->url = $data['url'],
            $this->nome = $data['nome'],
            $this->telefone = $data['telefone'],
            'data' => date('d/m/Y')
        );
    }

    // retorma view de email views/email/news-email com dados
    public function build()
    {
        return $this->view('template/newsMail')->subject('Novo e-mail de news')->with($this->value);
    }
}
