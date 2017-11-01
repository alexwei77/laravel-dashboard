<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
use Vsmoraes\Pdf\Pdf;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Mail\RatingsAlert;
use App\Mail\ConsentGranted;
use App\Mail\ContractRequested;
use App\Jobs\SendReminderEmail;
use App;
use Bogardo\Mailgun\Facades\Mailgun;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use App\MyLibrary\GetIpLocale;
use App\MyLibrary\Util;
use App\Repositories\CompanyVerifyRepository;
use App\Repositories\EmployeesRepository;
use App\Models\EmployeesModel;
use Illuminate\Support\Facades\Storage as Storage;
Use Setting;
use App\Repositories\EmployeesCountRepository;
use App\Repositories\DashboardRepository;
use App\Models\Scores;
use App\User;
use App\Models\EmployeesWatch;

class EmployeesController extends Controller
{

    public function contract($employeeID)
    {
        //get the user
        $user = Sentinel::getUser();
        //check that the employer has credit sto perform this action
        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

        if (($subscriptionRow->employees_avail) == 0) {
            return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
        }

        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();

        /*$employeeDetails = $employeeData;

         Mail::to($employeeDetails->email)->queue(new ContractRequested($user, $employeeDetails));


        return Redirect::back()->with('success', 'Email sent');*/

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $contractRequest = DB::table('dmmx_employees_watch')->where([['companyid', $adminRow->userid], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'No start date']);
        } else {
            $contractRequest = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'No start date']);
        }


        if ($contractRequest) {
            //subtract a unit from employees available
            DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail');

            //add the employee to number of employees for today 
            $get_this_month_row = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->get();

            if (count($get_this_month_row) > 0) {
                //add one to the column
                $updateRow = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->increment('employees_quantity');
            } else {
                //create a new column 
                $createRow = DB::table('daily_employees_quantity')->insert(['userid' => $user->id, 'employees_quantity' => 1, 'date' => date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
            }

            //send a notification email to the employee 
            $employeeDetails = $employeeData;

            //Mail::to($employeeDetails->email)->queue(new ContractRequested($user, $employeeDetails));
            /* $data = (object)array_merge((array)$user, (array)$employeeDetails);
             Mailgun::send('emails.contracts.contractrequest', $data, function ($message) {
                       $message->to($employeeDetails->email, $employeeDetails->first_name ." " .$employeeDetails->last_name)->subject('Contract Request');
             });*/
            // Mailgun::send(['html' => 'emails.contracts.contractrequest'], $data, $callback);

            // $this->createUpdateSitemap();
            Session::put('section', 'No start date');
            return Redirect::back()->with('success', 'Contract generated');
        }
    }

    public function delete($employeeID)
    {
        //get the user
        $user = Sentinel::getUser();

        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $deleteRequest = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->delete();
        if ($deleteRequest) {
            return Redirect::back()->with('success', 'Successfully deleted');
        }
    }

    public function consentGranted(Request $request, $employeeID)
    {
        //insert the start data 
        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $user = Sentinel::getUser();
        //echo $request->startdate;
        //die;
        $update_consent = false;
        $consent_status = isset($request->consent_obtained) ? $request->consent_obtained : '0';
        if (isset($consent_status) && intval($consent_status) == 1) {
            $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
            if (count($checkIfAdmin) > 0) {
                $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                //$userID = $adminRow->userid;
                $update_consent = DB::table('dmmx_employees_watch')->where([['companyid', $adminRow->userid], ['employeeid', $employeeData->idnumber]])->update(['consent_granted' => $consent_status]);
            } else {
                $update_consent = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['consent_granted' => $consent_status]);
                //$userID = $user->id;
            }
        }

        Session::put('section', 'SLIP');

        if ($update_consent) {
            // TODO: perhaps update the update_at column in the table
            // DB::table('dmmx_employees_watch')->where([['companyid', $userID],['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Active']);
            if (getenv('GAE_INSTANCE', true) === false) {
            Mail::to($employeeData->email)->queue(new ConsentGranted($user, $employeeData));
            } else {
                Mail::to($employeeData->email)->send(new ConsentGranted($user, $employeeData));
            }
            return Redirect::back()->with('success', 'You may now view employee details');
        } else {
            return Redirect::back();
        }
    }

    public function addstart(Request $request, $employeeID)
    {
        //insert the start data 
        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $user = Sentinel::getUser();

        $EmployeesCountRepository = new EmployeesCountRepository;
        $dashBoardRepository = new DashboardRepository;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        $insertDate = 0;
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
            $insertDate = DB::table('dmmx_employees_watch')->where([['companyid', $adminRow->userid], ['employeeid', $employeeData->idnumber]])->update(['start_date' => $request->startdate]);
        } else {
            $insertDate = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['start_date' => $request->startdate]);
            $userID = $user->id;
        }

        if ($insertDate) {
            //update the employee's watchstatus 
            DB::table('dmmx_employees_watch')->where([['companyid', $userID], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Active']);
            Session::put('section', 'Active');
           

            //update the daily_employees_qauntity table;
            $check_this_month_row = $EmployeesCountRepository->checkThisMonthRow($userID);
            if($check_this_month_row > 0){
                 $EmployeesCountRepository->updateEmployeeCount($userID, 1);
            }else{
                $EmployeesCountRepository->insertEmployeeCount($userID, 1);
            }

            //update the dashboard table 
            $check_this_year_row = $dashBoardRepository->checkThisYearRow($userID);
            if($check_this_year_row > 0){
                $dashBoardRepository->incrementSuccessfulCandidates($userID, 1);
            }

            return Redirect::back()->with('success', 'Start date inserted');
        }
        return Redirect::back()->with('error', 'Adding start date failed');
    }

    public function getStartDateAll()
    {

    }

    public function addstartAll(Request $request)
    {
        //insert the start data 
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();


        $employeesWatchData = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'No start date']])->get();
        //echo $request->startdate;
        //die;
        foreach ($employeesWatchData as $employeeWatchData) {
            DB::table('dmmx_employees_watch')->where('id', $employeeWatchData->id)->update(['watchstatus' => 'Active', 'start_date' => $_REQUEST['startdate']]);
            //increment the active employees row in the dashboard table
            //check if the there is a row for the dashboard already 
            $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
            if ($dashboard_data_count == 0) {
                //insert the row
                DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 0, 'employees_joined' => 1, 'employees_left' => 0, 'successful_applicants' => 1, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            } else {
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('employees_joined');
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('successful_applicants');
            }
        }
        Session::put('section', 'Active');
        return Redirect::back()->with('success', 'Employees/Porspects moved to active');
    }

    public function getStartDateSelected()
    {

    }

    public function addstartSelected(Request $request)
    {
        session_name("Checked_id_session");
        session_start();
        $checkedIDs = explode(",", $_SESSION['checkedids']);
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();


        foreach ($checkedIDs as $checkedID) {
            //get employee row 
            $employeeData = DB::table('dmmx_employees')->where('id', $checkedID)->first();
            if (isset($employeeData)) {
                DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Active', 'start_date' => $_REQUEST['startdate']]);
            }
            //increment the active employees row in the dashboard table
            //check if the there is a row for the dashboard already 
            $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
            if ($dashboard_data_count == 0) {
                //insert the row
                DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 0, 'employees_joined' => 1, 'employees_left' => 0, 'successful_applicants' => 1, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            } else {
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('employees_joined');
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('successful_applicants');
            }
        }
        Session::put('section', 'Active');
        return Redirect::back()->with('success', 'Employees/Prospects moved to active');

    }


    public function getaddendDateAll()
    {

    }

    public function addendDateAll(Request $request)
    {
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        $employeesWatchData = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Active']])->get();
        //echo $request->startdate;
        //die;
        foreach ($employeesWatchData as $employeeWatchData) {
            DB::table('dmmx_employees_watch')->where('id', $employeeWatchData->id)->update(['watchstatus' => 'Expired', 'end_date' => $_REQUEST['enddate']]);
            //increment the active employees row in the dashboard table
            //check if the there is a row for the dashboard already 
            $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
            if ($dashboard_data_count == 0) {
                //insert the row
                DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 0, 'employees_joined' => 0, 'employees_left' => 1, 'successful_applicants' => 0, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            } else {
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('employees_left');
            }
        }
        Session::put('section', 'Expired');
        return Redirect::back()->with('success', 'Employees moved to expired');
    }

    public function getaddendDateSelected()
    {

    }

    public function addendDateSelected(Request $request)
    {
        session_name("Checked_id_session");
        session_start();
        $checkedIDs = explode(",", $_SESSION['checkedids']);
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        foreach ($checkedIDs as $checkedID) {
            //get employee row 
            $employeeData = DB::table('dmmx_employees')->where('id', $checkedID)->first();
            DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Expired', 'end_date' => $_REQUEST['enddate']]);

            //increment the active employees row in the dashboard table
            //check if the there is a row for the dashboard already 
            $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
            if ($dashboard_data_count == 0) {
                //insert the row
                DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 0, 'employees_joined' => 0, 'employees_left' => 1, 'successful_applicants' => 0, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
            } else {
                DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('employees_left');
            }
        }
        Session::put('section', 'Expired');
        return Redirect::back()->with('success', 'Employees/Porspects moved to expired');
    }

    public function addend(Request $request, $employeeID)
    {
        //insert the start data 
        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $user = Sentinel::getUser();
        //echo $request->startdate;
        //die;

        $userID = 0;
        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        $insertDate = 0;
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
            $insertDate = DB::table('dmmx_employees_watch')->where([['companyid', $userID], ['employeeid', $employeeData->idnumber]])->update(['end_date' => $request->enddate]);
        } else {
            $userID = $user->id;
            $insertDate = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['end_date' => $request->enddate]);
        }


        //increment the active employees row in the dashboard table 
        //check if the there is a row for the dashboard already
        $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
        if ($dashboard_data_count == 0) {
            //insert the row
            DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 0, 'employees_joined' => 0, 'employees_left' => 1, 'successful_applicants' => 0, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        } else {
            DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('employees_left');
        }

        if ($insertDate) {
            //update the employee's watchstatus 
            DB::table('dmmx_employees_watch')->where([['companyid', $userID], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Expired']);
            Session::put('section', 'Expired');
            return Redirect::back()->with('success', 'End date inserted');
        }
    }

    public function moveAllToContract()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        //check if the user has enough credits for this action
        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

        if (($subscriptionRow->employees_avail) == 0) {
            return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
        }

        //count the employees and subtract units 
        $countEmployees = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->count();
        $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->pluck('employeeid');


        //subtract the employees from employees available
        $decrement = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail', $countEmployees);
        if ($decrement) {
            $insertDate = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->update(['watchstatus' => 'No start date']);

            //send notifications to all the employees
            foreach ($employeesIds as $employeeId) {
                $employeeData = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                $employeeDetails = $employeeData;
                //Mail::to($employeeDetails->email)->queue(new ContractRequested($user, $employeeDetails));

                //
                //add the employee to number of employees for today
                $get_this_month_row = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->get();

                if (count($get_this_month_row) > 0) {
                    //add one to the column
                    $updateRow = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->increment('employees_quantity');
                } else {
                    //create a new column
                    $createRow = DB::table('daily_employees_quantity')->insert(['userid' => $user->id, 'employees_quantity' => 1, 'date' => date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
                }
            }

            // $this->createUpdateSitemap();
            return Redirect::back()->with('success', 'Employees/Prospets moved to No start date');
        }

    }

    public function checkedids(Request $request)
    {
        session_name("Checked_id_session");
        session_start();

        //first check if checked ids is empty 
        if (empty($_SESSION['checkedids']) || !isset($_SESSION['checkedids'])) {
            $_SESSION['checkedids'] = $request->checkedids;
        } else {
            $uncheckedId = $request->uncheckedId;
            //remove the id from checkedids
            $checkedIdsArray = explode(",", $_SESSION['checkedids']);
            $indexOfCheckedID = array_search($uncheckedId, $checkedIdsArray);
            unset($checkedIdsArray[$indexOfCheckedID]);
            $_SESSION['checkedids'] = implode(",", $checkedIdsArray);

        }
    }

    public function checkedAll(Request $request)
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        session_name("Checked_id_session");
        session_start();
        $checkedids = array();

        $checkedSection = $request->checkedAll;
        if ($checkedSection !== -1) {
            if ($checkedSection == 0) {
                $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->pluck('employeeid');
                foreach ($employeesIds as $employeeId) {
                    $getEmployee = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                    //print_r($getEmployee);
                    //die;
                    array_push($checkedids, $getEmployee->id); //the id is incorrect 4565464464
                }
            }
            if ($checkedSection == 1) {
                $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'No start date']])->pluck('employeeid');
                foreach ($employeesIds as $employeeId) {
                    $getEmployee = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                    //print_r($getEmployee);
                    //die;
                    array_push($checkedids, $getEmployee->id); //the id is incorrect 4565464464
                }
            }
            if ($checkedSection == 2) {
                $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Active']])->pluck('employeeid');
                foreach ($employeesIds as $employeeId) {
                    $getEmployee = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                    //print_r($getEmployee);
                    //die;
                    array_push($checkedids, $getEmployee->id); //the id is incorrect 4565464464
                }
            }
            if ($checkedSection == 3) {
                $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Expired']])->pluck('employeeid');
                foreach ($employeesIds as $employeeId) {
                    $getEmployee = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                    //print_r($getEmployee);
                    //die;
                    array_push($checkedids, $getEmployee->id); //the id is incorrect 4565464464
                }
            }
            if ($checkedSection == 4) {
                $employeesIds = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Past employee']])->pluck('employeeid');
                foreach ($employeesIds as $employeeId) {
                    $getEmployee = DB::table('dmmx_employees')->where('idnumber', $employeeId)->first();
                    //print_r($getEmployee);
                    //die;
                    array_push($checkedids, $getEmployee->id); //the id is incorrect 4565464464
                }
            }
        }

        $_SESSION['checkedids'] = implode(",", $checkedids);
    }

    public function moveSelectedToContract()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        session_name("Checked_id_session");
        session_start();

        /*print_r($_SESSION['checkedids']);
        die;*/

        $checkedIds = explode(",", $_SESSION['checkedids']);

        //check if there are any ids stored
        if (!empty($_SESSION['checkedids'])) {
            $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

            if (($subscriptionRow->employees_avail) == 0) {
                return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
            }


            if (count($checkedIds) > ($subscriptionRow->employees_avail) && ($subscriptionRow->employees_avail) > 0) {
                return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
            }
            /*print_r($checkedIds);
            die;*/
            foreach ($checkedIds as $checkedId) {
                $employeeData = DB::table('dmmx_employees')->where('id', $checkedId)->first();
                $updateWatchStatus = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'No start date']);
                //email the employee
                $employeeDetails = $employeeData;
                //Mail::to($employeeDetails->email)->queue(new ContractRequested($user, $employeeDetails));

                //add the employee to number of employees for today
                $get_this_month_row = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->get();

                if (count($get_this_month_row) > 0) {
                    //add one to the column
                    $updateRow = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->increment('employees_quantity');
                } else {
                    //create a new column
                    $createRow = DB::table('daily_employees_quantity')->insert(['userid' => $user->id, 'employees_quantity' => 1, 'date' => date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
                }

            }


            // $this->createUpdateSitemap();
            Session::put('section', 'No start date');
            return Redirect::back()->with('success', 'Employees/Prospets moved to No start date');
        }

        session_destroy();
        session_name("Checked_All_session");
        session_start();

        if ($_SESSION['checkedAll'] == -1) {
            return Redirect::back()->with('error', 'No employee selected');
        } else {
            //Move the employees to contract 

            // $this->createUpdateSitemap();
            return Redirect::back()->with('success', 'All Employees/Prospets moved to No start date');
        }


        /*$this->createUpdateSitemap();
        return Redirect::back()->with('success', 'Employees/Prospets moved to No start date');*/
    }

    private $pdf;

    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

    public function viewcontract($employeeID)
    {
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }


        //Get avarage star rating for the employee 
        $user = DB::table('users')->where('id', $userID)->first();

        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $employeeData->uniquenumber = "Unique ID: " . "I" . $employeeData->id . "H" . substr(md5($employeeData->email), 0, 5) . substr(md5($employeeData->idnumber), 0, 5);
        //check get the watchstatus table for retrieval of the created_at 
        $employeeWatchRow = DB::table('dmmx_employees_watch')->where([['employeeid', $employeeData->idnumber], ['companyid', $user->id]])->first();
        //print the contract
        //echo "printing the contract";
        $counter = 0;
        $html2 = "";
        while ($counter < 5) {
            $html = view('contractpdf', compact('user', 'employeeData', 'employeeWatchRow'))->render();
            $html2 .= $html;
            $counter++;

        }

        return $this->pdf
            ->load($html2)
            ->filename($employeeData->first_name . '_' .  $employeeData->last_name . '_SLIP')
            ->show();

        /*return $this->pdf
        ->load($html2)
        ->filename("assets/img/authors/test.pdf")
        ->output();*/
    }

    public function viewratings($companyID = null, $employeeID = null)
    //public function viewratings($companyID = 199, $employeeID = 8)
    {
        // die(var_dump($companyID));
        // $companyID = 199; $employeeID = 8;
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        //Get average star rating for the employee
        $company = DB::table('users')->where('id', $companyID)->first();
        $employeeDetails = DB::table('dmmx_employees')->where([['id', '=', $employeeID]])->first();

        //get the employee details
        $watchDetails = DB::table('dmmx_employees_watch')->where([['companyid', '=', $company->id], ['employeeid', '=', $employeeDetails->idnumber]])->first();

        //get the metrics
        $metrics = DB::table('metrics')->get();

        //get scores check status
        $theScores = DB::table('scores')->where([['scorer_id', '=', $company->id], ['employee_id', '=', $employeeID]])->get();

        ///get list of users that scored the employee
        $usersids = DB::table('scores')->where('employee_id', $employeeDetails->id)->pluck('scorer_id');
        $idscollection = array();
        foreach ($usersids as $usersid) {
            if (!in_array($usersid, $idscollection)) {
                array_push($idscollection, $usersid);
            }
        }

        //get list of the users
        $scorers = DB::table('users')->whereIn('id', $idscollection)->get();

        //increment profile lookups
        //check if the there is a row for the dashboard already
        $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
        if ($dashboard_data_count == 0) {
            //insert the row
            DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 1, 'employees_joined' => 0, 'employees_left' => 0, 'successful_applicants' => 0, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        } else {
            DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('candidate_searches');
        }

        $currencySet = Setting::get('currency', 'USD', $user->id);

        $disk = Storage::disk('gcs');

        $url = $disk->url('/users/'.$employeeDetails->pic);

        return view('viewratings', compact('user', 'employeeDetails', 'watchDetails', 'metrics', 'scorers', 'scorersNumber', 'theScores', 'url', 'currencySet'));
    }

    public function singleemployee($employeeID)
    {
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        //Get average star rating for the employee
        $company = DB::table('users')->where('id', $userID)->first();
        $RatingsAverage = DB::table('dmmx_ratings')->where([['rater_id', '=', $employeeID]])->avg('stars');
        //All Ratings
        $allRatings = DB::table('dmmx_ratings')->where([['rater_id', '=', $employeeID]])->get();
        //get the watch details 
        $employeeDetails = DB::table('dmmx_employees')->where([['id', '=', $employeeID]])->first();
        $company_verify = DB::table('company_verify')->where('companyid', $userID)->first();

        //testing the mail engine
        //$employeeData = $employeeDetails;
        /*Mail::to('dev14@dmm.co.za')->send(new ContractRequested($user, $employeeDetails));

        die;*/

        //get the employee details
        $watchDetails = DB::table('dmmx_employees_watch')->where([['companyid', '=', $company->id], ['employeeid', '=', $employeeDetails->idnumber]])->first();

        //get the metrics 
        $metrics = DB::table('metrics')->get();

        $metrics_stats = array();

        //get scores check status
        $theScores = DB::table('scores')->where([['scorer_id', '=', $company->id], ['employee_id', '=', $employeeID]])->get();

        $allScores = DB::table('scores')->where([['employee_id', '=', $employeeID]])->get();

        $scored_metrics = 0;
        $total_employer_score = 0;
        $total_score_for_all_employers = 0;
        $section_stats = array();

        foreach ($metrics as $metric) {
            foreach($allScores as $theScore) {
                if(($theScore->metric_id) == ($metric->id)) {
                    if($metric->rating_type == -1) {
                        $metrics_stats['negative'] = isset($metrics_stats['negative']) ? $metrics_stats['negative'] + 1 : 0;
                    } elseif($metric->rating_type == 1) {
                        $metrics_stats['positive'] = isset($metrics_stats['positive']) ? $metrics_stats['positive'] + 1 : 0;
                    }
                    if($metric->fact_opinion == 'Opinion') {
                        if($theScore->checked_unchecked > 0) {
                            $scored_metrics += 1;
                            if($theScore->scorer_id == $company->id) {
                                $total_employer_score += $theScore->checked_unchecked;
                            } else {
                                $total_score_for_all_employers += $theScore->checked_unchecked;
                            }
                        }
                    } else {
                        if($theScore->scorer_id == $company->id) {
                            $section_stats[$metric->metric_section]['company_total'] = isset($section_stats[$metric->metric_section]['company_total']) ? $section_stats[$metric->metric_section]['company_total'] + $metric->rating_type : 0;
                        }
                        $section_stats[$metric->metric_section]['user_total'] = isset($section_stats[$metric->metric_section]['user_total']) ? $section_stats[$metric->metric_section]['user_total'] + $metric->rating_type : 0;
                    }
                }
            }
        }

        $metrics_stats['average_score_for_employer'] = $scored_metrics > 0 ? round($total_employer_score/$scored_metrics, 2) : 'Not Available';

        $metrics_stats['average_score_for_all_employers'] = $scored_metrics > 0 ? round($total_score_for_all_employers/$scored_metrics, 2) : 'Not Available';

        // get list of users that scored the employee
        $usersids = DB::table('scores')->where('employee_id', $employeeDetails->id)->pluck('scorer_id');
        $idscollection = array();
        foreach ($usersids as $usersid) {
            if (!in_array($usersid, $idscollection)) {
                array_push($idscollection, $usersid);
            }
        }

        //get list of the users 
        $scorers = DB::table('users')->whereIn('id', $idscollection)->get();

        $linked_companies = array();
        $company_metadata = array();
        $number_of_employees = array();

        foreach ($scorers as $scorer) {
            $linked_companies[$scorer->id] = $scorer->companyname;
            $company_metadata[$scorer->id]['start_date'] = $scorer->created_at;
            $number_of_employees[$scorer->id] = DB::table('dmmx_employees_watch')->where([['companyid', $scorer->id], ['watchstatus', 'Active']])->count();
        }

        $company_count = sizeof(array_keys($linked_companies));

        $scorersNumber = DB::table('users')->whereIn('id', $idscollection)->count();

        //$this->viewcontract($employeeID);
        //check the availability of start date 
        $startDateCheck = $watchDetails->start_date;
        $endDateCheck = $watchDetails->end_date;

        //increment profile lookups
        //check if the there is a row for the dashboard already
        $dashboard_data_count = DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->count();
        if ($dashboard_data_count == 0) {
            //insert the row
            DB::table('dashboard_data')->insert(['user_id' => $userID, 'candidate_searches' => 1, 'employees_joined' => 0, 'employees_left' => 0, 'successful_applicants' => 0, 'unsuccessful_applicants' => 0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        } else {
            DB::table('dashboard_data')->where('user_id', $userID)->whereYear('updated_at', '=', date('Y'))->increment('candidate_searches');
        }

        $currencySet = Setting::get('currency', 'USD', $userID);

        $disk = Storage::disk('gcs');

        $url = $disk->url('/users/'.$employeeDetails->pic);

        //get companies that scored the employee;
        $companyids_that_scored_employee = Scores::where('employee_id', $employeeDetails->id)->distinct()->pluck('scorer_id');
        $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();

        foreach($companies_that_scored_employee as $company){
             $number_of_employees = EmployeesWatch::where('companyid', $company->id)->count();
             $company->number_of_employees = $number_of_employees;
        }
       

        return view('singleemployee', compact('user', 'employeeDetails', 'watchDetails', 'RatingsAverage', 'allRatings', 'metrics', 'scorers', 'scorersNumber', 'theScores', 'startDateCheck', 'endDateCheck', 'company_verify', 'company_count', 'url', 'currencySet', 'company', 'companies_that_scored_employee'));
    }

    public function rateemployee($employeeID)
    {
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        //Get average star rating for the employee
        $company = DB::table('users')->where('id', $userID)->first();
        $RatingsAverage = DB::table('dmmx_ratings')->where([['rater_id', '=', $employeeID]])->avg('stars');
        //All Ratings
        $allRatings = DB::table('dmmx_ratings')->where([['rater_id', '=', $employeeID]])->get();
        //get the watch details
        $employeeDetails = DB::table('dmmx_employees')->where([['id', '=', $employeeID]])->first();
        $company_verify = DB::table('company_verify')->where('companyid', $userID)->first();

        //get the employee details
        $watchDetails = DB::table('dmmx_employees_watch')->where([['companyid', '=', $company->id], ['employeeid', '=', $employeeDetails->idnumber]])->first();

        //get the metrics
        $metrics = DB::table('metrics')->get();

        //get scores check status
        $theScores = DB::table('scores')->where([['scorer_id', '=', $company->id], ['employee_id', '=', $employeeID]])->get();

        $mostRecentScoreData = DB::table('scores')->where([['scorer_id', '=', $company->id], ['employee_id', '=', $employeeID]])->orderBy('updated_at', 'desc')->first();

        $most_recent_submission_member_date = isset($mostRecentScoreData) ? date('Y-m-d', strtotime($mostRecentScoreData->updated_at)) : 'Not Available';

        ///get list of users that scored the employee
        $usersids = DB::table('scores')->where('employee_id', $employeeDetails->id)->pluck('scorer_id');
        $idscollection = array();
        foreach ($usersids as $usersid) {
            if (!in_array($usersid, $idscollection)) {
                array_push($idscollection, $usersid);
            }
        }

        //get list of the users
        $scorers = DB::table('users')->whereIn('id', $idscollection)->get();

        $scorersNumber = DB::table('users')->whereIn('id', $idscollection)->count();

        //check the availability of start date
        $startDateCheck = $watchDetails->start_date;
        $endDateCheck = $watchDetails->end_date;

        $currencySet = Setting::get('currency', 'USD', $user->id);

        //get all the currency codes
        $currencyInfo = DB::table('currency')->get();

        $currency_lookup = array();

        foreach ($currencyInfo as $currency) {
            $currency_code = $currency->code;
            $currency_lookup[$currency_code] = $currency->country . ' (' . $currency_code . ')';
        }

        Setting::set('currency', $currencySet, $userID);
        Setting::save($userID);

        return view('addrating', compact('user', 'employeeDetails', 'watchDetails', 'RatingsAverage', 'allRatings', 'metrics', 'scorers', 'scorersNumber', 'theScores', 'startDateCheck', 'endDateCheck', 'company_verify', 'currencySet', 'currency_lookup', 'most_recent_submission_member_date'));
    }

    public function metricadd()
    {
        return view('admin.metrics.metricadd', compact('groups', 'countries'));
    }

    public function metricstore(Request $request)
    {
        $metricStore = DB::table('metrics')->insert(
            ['name' => $request->name, 'description' => $request->description, 'metric_section' => $request->metric_section, 'fact_opinion' => $request->fact_opinion, 'req_as_proof' => $request->req_as_proof, 're_by' => $request->re_by, 'internal' => $request->internal, 'item' => $request->item, 'created_at' => date('Y-m-d H:i:s')]
        );
        if ($metricStore) {
            return Redirect::back()->with('success', 'Metric inserted');
        } else {
            return Redirect::back()->with('error', 'Metric insertion failed');
        }
    }

    public function submitscore(Request $request)
    {
        // die(var_dump($request->all()));

        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        //Save the data to scores table
        $creationDate = date('Y-m-d H:i:s');
        $metrics = DB::table('metrics')->get();

        $changed_metrics = array();

        foreach ($metrics as $metric) {
            //check if the metric is checked
            $metric_id = $metric->id;
            $metricName = 'scoring' . $metric->id;
            if (isset($request->$metricName)) {
            $changed_metrics[] = $metric_id;
            /* if($request->$metricName){
                 echo "there is a value: ";
                 echo $request->$metricName ."<br>";
             }*/
            //check if there is a score already
            $scoreCheck = DB::table('scores')->where([['scorer_id', '=', $userID], ['employee_id', '=', $request->employeeid], ['metric_id', '=', $metric_id]])->first(); //this picks one score

            if (!$scoreCheck) {
                    $scoreStore = DB::table('scores')->insert(
                        ['employee_id' => $request->employeeid, 'scorer_id' => $userID, 'metric_id' => $metric_id, 'checked_unchecked' => $request->$metricName, 'created_at' => $creationDate]
                    );

                } else {
                    //keep a copy of the score and update the score
                    $scoreCopy = DB::table('scores_history')->insert(
                        ['employee_id' => $scoreCheck->employee_id, 'scorer_id' => $scoreCheck->scorer_id, 'metric_id' => $scoreCheck->metric_id, 'checked_unchecked' => $scoreCheck->checked_unchecked, 'created_at' => $scoreCheck->created_at, 'updated_at' => $scoreCheck->updated_at]
                    );
                    $scoreUpdate = DB::table('scores')->where([['scorer_id', '=', $userID], ['employee_id', '=', $request->employeeid], ['metric_id', '=', $metric_id]])->update(
                        ['checked_unchecked' => $request->$metricName, 'updated_at' => $creationDate]
                    );

                }

            }

        }//end of foreach

//        $scoreDetails = DB::table('metrics')
//            ->join('scores', 'metrics.id', '=', 'scores.metric_id')
//            ->select(DB::raw('scores.checked_unchecked AS metric_value, metrics.name'))
//            ->where([ ['scores.scorer_id', '=', $userID], ['scores.employee_id', '=', $request->employeeid] ])
//            ->whereIn('scores.metric_id', $changed_metrics)
//            ->get();
//
//        $score_deets = array();

//        foreach($scoreDetails as $scoreDetail)
//        {
//            $score_deets[$scoreDetail->name] = $scoreDetail->metric_value;
//        }

        $employeeDetails = DB::table('dmmx_employees')->where('id', $request->employeeid)->first();

if (getenv('GAE_INSTANCE', true) === false)
{
        Mail::to($employeeDetails->email)->queue(new RatingsAlert($user, $employeeDetails));
}

else {
    Mail::to($employeeDetails->email)->send(new RatingsAlert($user, $employeeDetails));
}

        return Redirect::back()->with('success', 'employee ratings updated');


        //if only 'did not pitch up' is checked, move the employee to expired
//        foreach ($metrics as $metric) {
//            //check if the metric is checked
//            $metricName = 'scroring' . $metric->id;
//            if (isset($request->$metricName)) {
//                $checked_unchecked = 1;
//            } else {
//                $checked_unchecked = 0;
//            }
//
//            if ($metric->name == "Pitch up") {
//                if ($checked_unchecked) {//did not pitch up is checked
//                    //get employee row;
//                    $employeeRow = DB::table('dmmx_employees')->where('id', $request->employeeid)->first();
//                    //move the employee to expired
//                    $updateRow = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeRow->idnumber]])->update(['watchstatus' => 'Expired']);
//
//                    return Redirect::route('employees')->with('success', 'employee moved to expired');
//                }
//            }
//        }
    }

    public function employeesdata(User $user)
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //Get IDs of people being watched by the company 
        $user = Sentinel::getUser();

        //This should be a selection of only those columns the company requested to watch them 
        $employeesWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
        $employeesWatchedArray = array();
        foreach ($employeesWatched as $singleid) {
            array_push($employeesWatchedArray, $singleid->employeeid);
        }
        if ($employeesWatched) {
            $AllEmployeesData = DB::table('dmmx_employees')->whereIn('idnumber', $employeesWatchedArray)->get(['id', 'idnumber', 'email', 'permissions2', 'last_login', 'first_name', 'last_name', 'bio', 'gender', 'dob', 'pic', 'country', 'state', 'city', 'address', 'postal', 'authoritiesverified', 'lastknownaddresses', 'lastknowncontactnumbers', 'lastknownemployers', 'watchingcompanies', 'created_at', 'updated_at']);
        }

        // print_r($AllEmployeesData);
        // die;
        foreach ($AllEmployeesData as $employeesData) {
            //get whatch status for the current employee and add it
            $employeeWatchRow = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeesData->idnumber]])->first();
            $employeesData->watchstatus = $employeeWatchRow->watchstatus;
        }
        return Datatables::of($AllEmployeesData)
            ->add_column('checkbox', function ($employee) {
                $checkbox = '<input class="checkbox-select" type="checkbox" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                return $checkbox;
            })
            ->add_column('actions', function ($employee) {
                //get the watch status for this employee 
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                if ($getStatus->watchstatus == 'Pending') {
                    $actions = '<a href=' . route('employees.contract', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This moves the prospect/employee to contract">Contract</i></a>';
                }

                if($getStatus->watchstatus == 'No start date'){
                    $actions = '<a data-toggle="modal" class="add_start_date" data-target="#add_start_date" href="#" data-employeeid=' .$employee->id .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This moves the prospect/employee to Active">Add start date</i></a>' .'|' .'<a data-toggle="modal" href=' .route('employees.employee.view', $employee->id) .' data-employeeid=' .$employee->id .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip">Profile</i></a>';
                }
                if ($getStatus->watchstatus == 'Active') {
                    $actions = '<a data-toggle="modal" class="add_end_date" data-target="#add_end_date" href="#" data-employeeid=' . $employee->id . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This moves the prospect/employee to expired">Add end date</i></a>';
                }
                if ($getStatus->watchstatus == 'Expired') {
                    $actions = '<a href=' . route('employees.delete', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This deletes the prospect/employee">Delete</i></a>';
                }

                return $actions;
            })
            ->add_column('watchstatus', function ($employee) {
                //Check the status associated with the company

                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                $actions = $getStatus->watchstatus;
                //}
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    public function pastAll()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        //check if the user has enough credits for this action
        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

        //count the employees and subtract units 
        $countEmployees = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->count();

        if (($subscriptionRow->employees_avail) == 0 || ($subscriptionRow->employees_avail) < $countEmployees) {
            return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
        } else {
            $insertDates = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->update(['watchstatus' => 'Past employee', 'start_date' => $_REQUEST['startdate'], 'end_date' => $_REQUEST['enddate']]);

            if ($insertDates) {
                return Redirect::back()->with('success', 'Employees/Prospets moved to past employees');
            }
        }

    }

    public function pastSelected()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        session_name("Checked_id_session");
        session_start();
        $checkedIds = explode(",", $_SESSION['checkedids']);

        $countChecked = count($checkedIds);

        //check if the user has enough credits for this action 
        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

        //count the employees and subtract units
        $countEmployees = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Pending']])->count();

        if ($countChecked > $countEmployees) {
            return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
        }

        foreach ($checkedIds as $checkedID) {
            //get employee row 
            $employeeData = DB::table('dmmx_employees')->where('id', $checkedID)->first();
            $selectedPast = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Past employee', 'start_date' => $_REQUEST['startdate'], 'end_date' => $_REQUEST['enddate']]);
        }
        Session::put('section', 'Past employees');
        return Redirect::back()->with('success', 'Employees/Prospets moved to past employees');
    }

    public function backPendingAll()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        $backPendingAll = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Past employee']])->update(['watchstatus' => 'Pending', 'start_date' => NULL, 'end_date' => NULL]);

        if ($backPendingAll) {
            return Redirect::back()->with('success', 'Employees/Prospets moved to pending');
        }

    }

    public function backPendingSelected()
    {
        $user = Sentinel::getUser();

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        session_name("Checked_id_session");
        session_start();
        $checkedIds = explode(",", $_SESSION['checkedids']);

        $countChecked = count($checkedIds);

        //check if the user has enough credits for this action 
        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->first();

        //count the employees and subtract units
        /* $countEmployees = DB::table('dmmx_employees_watch')->where([['companyid', $user->id],['watchstatus', 'Pending']])->count();

        if($countChecked  > $countEmployees){
            return Redirect::back()->with('error', 'You do not have enough credits to perform this action');
        }*/


        foreach ($checkedIds as $checkedID) {
            //get employee row 
            $employeeData = DB::table('dmmx_employees')->where('id', $checkedID)->first();
            $selectedPast = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeData->idnumber]])->update(['watchstatus' => 'Pending', 'start_date' => NULL, 'end_date' => NULL]);
        }
        return Redirect::back()->with('success', 'Employees/Prospets moved to back to pending');

    }

    public function createUpdateSitemap()
    {
        // create new sitemap object

        $sitemap = App::make("sitemap");

        // get all employees from db (this should be only of employees that are not in pending)
        $employees = DB::table('dmmx_employees')->orderBy('created_at', 'desc')->get();

        // print_r($employees);

        // counters
        $counter = 0;
        $sitemapCounter = 0;

        // add every employee to multiple sitemaps with one sitemapindex
        foreach ($employees as $e) //$e replaced $p
        {
            if ($counter == 50000) {
                // generate new sitemap file
                $sitemap->store('xml', 'sitemap-' . $sitemapCounter);
                // add the file to the sitemaps array
                $sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
                // reset items array (clear memory)
                $sitemap->model->resetItems();
                // reset the counter
                $counter = 0;
                // count generated sitemap
                $sitemapCounter++;
            }

            // add employee to items array
            $sitemap->add(url('/') . '/view-employee/' . $e->id);
            // count number of elements
            $counter++;
        }

        // you need to check for unused items
        if (!empty($sitemap->model->getItems())) {
            // generate sitemap with last items
            $sitemap->store('xml', 'sitemap-' . $sitemapCounter);
            // add sitemap to sitemaps array
            $sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
            // reset items array
            $sitemap->model->resetItems();
        }

        // generate new sitemapindex that will contain all generated sitemaps above
        $sitemap->store('sitemapindex', 'sitemap');
    }

    public function deleteAll()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        $getUpdateAllExpired = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Expired'], ['status', 1]])->update(['status' => 0]);

        Session::put('section', 'Expired');

        if ($getUpdateAllExpired) {
            return Redirect::back()->with('success', 'Employee(s) successfully deleted');
        } else {
            return Redirect::back()->with('error', 'Employee(s) deleted failed');
        }

    }

    public function deleteSelected()
    {
        $user = Sentinel::getUser();

        $userID = 0;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        session_name("Checked_id_session");
        session_start();
        $checkedIds = explode(",", $_SESSION['checkedids']);
        $countChecked = count($checkedIds);

        Session::put('section', 'Expired');

        if ($countChecked == 0) {
            return Redirect::back()->with('error', 'no selection made');
        }

        $idnumbers = array();
        foreach ($checkedIds as $checkedID) {
            $id = DB::table('dmmx_employees')->where('id', $checkedID)->pluck('idnumber');;
            array_push($idnumbers, $id);
        }

        foreach ($idnumbers as $idnumber) {
            $getUpdateSelectedExpired = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Expired'], ['status', 1], ['employeeid', $idnumber]])->update(['status' => 0]);
        }

        return Redirect::back()->with('success', 'Employee(s) successfully deleted');

    }

    public function employeesinfo($lang = null)
    {
        /*$value = session('custom_lang');
        echo $value;
        die;*/
        $util = new Util();
        $ip_locale = $this->GetIpLocale();
        Session::put('nav_section', 'staff');
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!$this->crawlerCheck() && !$lang) {
            //die;

            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international

                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/staff');
                }
                return $util->moddedRedirect('en/staff');
            }

            return $util->moddedRedirect($ip_locale . '/staff');
        }
        return view('employeesinfo');
    }

    public function partOfOurLocales($string)
    {
        return in_array($string, ["en", "au", "ca", "ie", "nz", "za", "uk", "us"]);
    }

    public function crawlerCheck()
    {
        $CrawlerDetect = new CrawlerDetect;
        $crawlerCheck = $CrawlerDetect->isCrawler();
        return $crawlerCheck;
    }

    public function GetIpLocale()
    {

        $ip2location = new GetIpLocale();

        $returned_locale = $ip2location->get_locale();

        return $returned_locale;

    }

    public function deleteEmployee($employeeid = null)
    {
        if ($employeeid == null) {
            return Redirect::back()->with('error', 'Deletion failed');
        }

        //remove associated record from employees and employees_watch
        $employee_class = new EmployeesRepository;
        $delete_employee = $employee_class->deleteEmployee($employeeid);
        if ($delete_employee) {
            return Redirect::back()->with('success', 'Delete successful');
        } else {
            return Redirect::back()->with('error', 'Delete failed');
        }
    }

    public function deleteEmployeeSlip($employeeid = null){
        $user = Sentinel::getUser();
        $dashBoardRepository = new DashboardRepository;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        $insertDate = 0;

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

         if ($employeeid == null) {
            return Redirect::back()->with('error', 'Deletion failed');
        }

        //remove associated record from employees and employees_watch
        $employee_class = new EmployeesRepository;
        $delete_employee = $employee_class->deleteEmployee($employeeid);
        if ($delete_employee) {
            //update unsuccessful candidates dashboard data 
            //update the dashboard table 
            $check_this_year_row = $dashBoardRepository->checkThisYearRow($userID);
            if($check_this_year_row > 0){
                $dashBoardRepository->incrementUnsuccessfulCandidates($userID, 1);
            }

            return Redirect::back()->with('success', 'Delete successful');
        } else {
            return Redirect::back()->with('error', 'Delete failed');
        }
    }

    public function editEmployee($employeeid = null)
    {
        $user = Sentinel::getUser();
        if ($employeeid == null) {
            return Redirect::back()->with('error', 'Editing denied');
        }
        $employeeData = EmployeesModel::where('idnumber', $employeeid)->first();
        return view('editemployee', compact('employeeid', 'employeeData', 'user'));
    }

    public function postEditEmployee(Request $request)
    {

        if ($request->first_name == "" && $request->last_name == "" && $request->idnumber == "" && $request->email == "") {
            return Redirect::back()->with('error', 'Nothing to update');
        }

        if ($request->first_name !== "") {
            EmployeesModel::where([['idnumber', $request->employeeid], ['email', $request->employeeemail]])->update(['first_name' => $request->first_name]);
        }
        if ($request->last_name !== "") {
            EmployeesModel::where([['idnumber', $request->employeeid], ['email', $request->employeeemail]])->update(['last_name' => $request->last_name]);
        }
        if ($request->idnumber !== "") {
            EmployeesModel::where([['idnumber', $request->employeeid], ['email', $request->employeeemail]])->update(['idnumber' => $request->idnumber]);
        }
        if ($request->email !== "") {
            //validate the email address
            $validateEmail = Mailgun::validator()->validate($request->email);
            if (!($validateEmail->is_valid)) {
                return Redirect::back()->with('error', 'Please enter a valid email address');
            }
            EmployeesModel::where([['idnumber', $request->employeeid], ['email', $request->employeeemail]])->update(['email' => $request->email]);
        }

        return Redirect::route('myemployees')->with('success', 'Staff member details updated');

    }
}
