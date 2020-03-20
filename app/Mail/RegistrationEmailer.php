<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationEmailer extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;
    public $admin;
    public $password;
    public $practice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$url)
    {
        //
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Verification')
            ->markdown('emails.registration');
    }
}
