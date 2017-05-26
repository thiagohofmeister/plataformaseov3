<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FaleConosco extends Mailable
{
    use Queueable, SerializesModels;

    private $infos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $infos)
    {
        $this->infos = $infos;
        $this->getSubject();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $Infos = $this->infos;
        return $this->view(TM . 'mails/fale_conosco', compact('Infos'))
            ->subject("[Fale Conosco] {$this->infos['nome']} - {$this->infos['assunto']}");
    }

    private function getSubject()
    {
        $Assunto = 'none';
        switch ($this->infos['assunto']) {
            case '1':
                $Assunto = "Dúvidas";
                break;
            case '2':
                $Assunto = "Orçamento";
                break;
            case '3':
                $Assunto = "Sugestão";
                break;
            case '4':
                $Assunto = "Críticas";
                break;               
            default:
                $Assunto = "Sem Assunto";
        }

        $this->infos['assunto'] = $Assunto;
    }
}
