<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RefralEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $code;
    public function __construct($user,$code,$senderemail,$url)
    {
        $this->user = $user;
        $this->code = $code;
        $this->senderemail = $senderemail;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('web.email.reffral-user')->with([
            'email' => $this->user,
            'code' => $this->code,
            'senderemail' => $this->senderemail,
            'url' => $this->url,
        ]);
    }
}
