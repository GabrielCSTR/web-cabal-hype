<?php

namespace App\Mail;

use App\Models\cabalAuth;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.created.welcome')
                    ->subject($this->details['subject'])
                    ->from('suporte@gameshype.com.br', 'Suporte Games Hype')
                    ->with('details', $this->details);
    }
}
