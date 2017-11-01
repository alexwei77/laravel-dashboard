<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendWatchNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The companyUser instance.
     *
     * @var companyUser
     */
    public $companyUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(companyUser $companyUser)
    {
        $this->companyUser = $companyUser;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dev14@stafflife.com')
                    ->view('view.name');
    }
}
