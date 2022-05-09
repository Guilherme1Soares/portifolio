<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    // variaveis do email
    public $url;
    public $nome;
    public $email;
    public $telefone;
    public $mensagem;
    public $termos;
    public $value;

    // montato array de dados
    public function __construct($data)
    {
        $this->value = array(
            $this->url = $data['url'],
            $this->nome = $data['nome'],
            $this->email = $data['email'],
            $this->telefone = $data['telefone'],
            $this->mensagem = $data['mensagem'],
            $this->termos = $data['termos'],
            'data' => date('d/m/Y')
        );
    }

    // retorma view de email views/email/contatos-email com dados
    public function build()
    {
        return $this->view('template/contatoMail')->subject('Novo e-mail de contato')->with($this->value);
    }
}
