<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function build()
    {
        return $this->subject('New Post Published')
            ->view('emails.new_post')
            ->with(['post' => $this->post]);
    }
}
