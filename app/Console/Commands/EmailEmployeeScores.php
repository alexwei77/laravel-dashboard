<?php

namespace App\Console\Commands;

use App;
use App\Mail\EmployeeScores;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class EmailEmployeeScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EmailEmployeeScores:emailscores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email most recent scores to employees';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start_ts = date('Y-m-d', strtotime('first day of last month')) . ' 00:00:01';
        $end_ts = date('Y-m-d', strtotime('last day of last month')) . ' 23:59:59';

        // note: when reviews are added for a user we don't set the updated_at column in the `scores` table- hence the OR contraint below in case its value is NULL
        $scoredUsers =  DB::table('dmmx_employees')
            ->join('scores', 'dmmx_employees.id', '=', 'scores.employee_id')
            ->join('metrics', 'scores.metric_id', '=', 'metrics.id')
            ->join('users', 'scores.scorer_id', '=', 'users.id')
            ->select(DB::raw('dmmx_employees.email AS employee_email, dmmx_employees.first_name AS employee_firstname, dmmx_employees.last_name AS employee_lastname, metrics.description AS review, users.email AS admin_email, users.first_name AS admin_firstname, users.last_name AS admin_lastname, users.companyname'))
            ->where([ ['scores.created_at', '>=', $start_ts], ['scores.created_at', '<=', $end_ts] ])
            ->orwhere([ ['scores.updated_at', '>=', $start_ts], ['scores.updated_at', '<=', $end_ts] ])
            ->get();
            //->toSql(); <-- we'd use that to dump the SQL

        $employees = array();
        $companies = array();
        $reviewers = array();
        $reviews = array();

        foreach($scoredUsers as $scoredUser) 
        {
            $employees[$scoredUser->employee_email] = $scoredUser->employee_firstname . ' ' . $scoredUser->employee_lastname;
            $companies[$scoredUser->employee_email][] = $scoredUser->companyname;
            $reviewer = $scoredUser->admin_firstname . ' ' . $scoredUser->admin_lastname;
            $reviewers[$scoredUser->companyname][] = $reviewer;
            $reviews[$reviewer][] = $scoredUser->review;
            $companies[$scoredUser->employee_email] = array_unique($companies[$scoredUser->employee_email]);
            $reviewers[$scoredUser->companyname] = array_unique($reviewers[$scoredUser->companyname]);
        }

        // var_dump($employees, $companies, $reviewers, $reviews);

        $is_cloud_instance = is_bool(getenv('GAE_INSTANCE', true)) ? false : true;

        // now process ratings for each user
        foreach($employees as $email => $employee) {
            $linked_companies = array_values($companies[$email]);
            if($is_cloud_instance) {
                Mail::to($email)->send(new EmployeeScores($employee, $linked_companies, $reviewers, $reviews));
            } else {
            Mail::to($email)->queue(new EmployeeScores($employee, $linked_companies, $reviewers, $reviews));
        }
            
    }
    
}

}
