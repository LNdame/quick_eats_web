<?php

namespace App\Mail;

use App\Practice;
use App\User;
use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationInvitationMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;
    public $password;
    public $vendor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$password,$url,Vendor $vendor)
    {
        //
        $this->user = $user;
        $this->url = $url;
        $this->password = $password;
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Invitation')
            ->markdown('emails.registration.invite-user');
    }
}
