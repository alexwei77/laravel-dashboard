<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeSLIPVerification extends Mailable
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
        return $this->subject('Employee Induction Notice')
                    ->view('emails.employee_verification_slip');
    }
}
