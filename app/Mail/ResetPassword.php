<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        //
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('auth.email-fogot-password');
        return $this->markdown('auth.email-fogot-password')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'token' => $this->token,
                    ]);
    }
}