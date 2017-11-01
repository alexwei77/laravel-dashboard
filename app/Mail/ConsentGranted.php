<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsentGranted extends Mailable
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
        return $this->subject('Consent Received')
            ->view('emails.employee_consent_granted');
    }
}
