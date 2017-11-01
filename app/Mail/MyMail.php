<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title; //public property

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title) //This instructs the mailable that we would receive the title whenever we send the mail
    {
        $this->title = $title; //this title, the public title, is equalt to what is passed through the constructor
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dev14@stafflife.com')
                    ->view('emails.mail'); //we could use view('emails.mail', compact('variable'))
    }
}
