<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RatingsAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var User
     * @var employeeDetails
     */
    public $user;

    public $employeeDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $employeeDetails)
    {
        $this->user = $user;
        $this->employeeDetails = $employeeDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New rating alert')
            ->view('emails.member_submission_alert');
    }
}
