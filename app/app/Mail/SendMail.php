<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $config;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view = 'email.testMail', $config = array())
    {
        $this->view = $view;
        $this->config = $config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->to($this->config['to']);
        if (!empty($this->config['cc'])) {
            $this->cc($this->config['cc']);
        }
        if (!empty($this->config['bbc'])) {
            $this->bbc($this->config['bbc']);
        }
        if (!empty($this->config['replyTo'])) {
            $this->replyTo($this->config['replyTo']);
        }

        if (!empty($this->config['subject'])) {
            $this->subject($this->config['subject']);
        }
        $this->view($this->view);
        return $this;
    }
}
