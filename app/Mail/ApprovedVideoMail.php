<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedVideoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $videoData;
    public function __construct($user,$videoData)
    {
        $this->user = $user;
        $this->videoData = $videoData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Video Approved')->view('web.email.approvedVideo')->with([
            'email' => $this->user['name'],
            'video_titel' => $this->videoData['video_title'],
        ]);
    }
}
