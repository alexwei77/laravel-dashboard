<?php

namespace App\Mail;

use App;
use App\Mail\ContractRequested;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeScores extends Mailable
{
    use Queueable, SerializesModels;

    public $employee_name;
    public $reviewers;
    public $companies;
    public $reviews;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee_name, $companies, $reviewers, $reviews)
    {
        $this->employee_name = $employee_name;
        $this->reviewers = $reviewers;
        $this->companies = $companies;
        $this->reviews = $reviews;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.tasks.employeescore');
    }
}
