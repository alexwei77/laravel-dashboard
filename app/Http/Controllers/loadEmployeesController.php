<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeesLoad;
use App\Employees;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Redirect;
use App;
use App\Mail\ContractRequested;
use App\Mail\EmployeeSLIPVerification;
use Illuminate\Support\Facades\Mail;
use Bogardo\Mailgun\Facades\Mailgun;
use Session;
use App\Repositories\CompanyVerifyRepository;
use App\Models\EmployeesModel;

class loadEmployeesController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(EmployeesLoad $request)
    {
        $user = Sentinel::getUser();
         $getSubscription = DB::table('dmmx_paysubscriptions')->where('id',$user->permissions2)->first();

         //check if company is verified
        $verification_docs_status = CompanyVerifyRepository::companyVerified($user->id); 

         if(!$verification_docs_status){
              if($user->companyname == null){ //This caters for companies that were registered before the company name fields was added in the registration form
                return json_encode('Please verify your company before performing this action.');
              }
         }

         //validate email 
        $validateEmail = Mailgun::validator()->validate($request->email);
        if (!($validateEmail->is_valid)) {
             return json_encode('Please enter a valid email address');
        }

         //check if there is at least one credit to perform this
         if($getSubscription->employees_avail == 0){
              return Redirect::back()->with('error', "You do not have enough subscription credits to perform this.");
         }

         //check if the user is not adding themselves
         if($request->email == $user->email){
             return json_encode('You cannot add yourself as an employee.');
         }

         //check if the user does not exist as either employer or admin
         $activeAdminEmployerCheck = DB::table('users')->where('email',$request->email)->count();
         if($activeAdminEmployerCheck > 0){
             return json_encode("There is a user with this email address as an admin or employer.");
         }

         //check if the user is inactive admin
         $inactiveAdminCheck = DB::table('dmmx_admins_table')->where('email',$request->email)->count();
         if($inactiveAdminCheck > 0){
             return json_encode('error', "Admin request was sent to this user. You cannot add them as an employee.");
         }

         //add an employee
         //add the employee to number of employees for today
            $getTodayRow = DB::table('daily_employees_quantity')->where('date', date("Y-m-d"))->get();

            if(count($getTodayRow) > 0){
                //add one to the column
                $updateRow = DB::table('daily_employees_quantity')->where('date', date("Y-m-d"))->increment('employees_quantity');
            }else{
                //create a new column
                $createRow = DB::table('daily_employees_quantity')->insert(['userid' => $user->id, 'employees_quantity' => 1, 'date' => date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
            }

            $prospectCheck = DB::table('dmmx_employees')->where('idnumber',$request->idnumber)->count();
            $prospectEmailCheck = DB::table('dmmx_employees')->where('email',$request->email)->count();
            //add the employee if he is not there already
            if($prospectCheck == 0 && $prospectEmailCheck == 0){
                 $account_number = $this->generateAccNumber("U");
                 $insertEmployee = DB::table('dmmx_employees')->insert(
                     [ 'first_name'=>$request->first_name,'last_name'=>$request->last_name, 'idnumber' => $request->idnumber, 'email' => $request->email,'created_at' => date('Y-m-d H:i:s'), 'acc_no' => $account_number]
                    );

            }else{

                 $employeeWatchCheck = DB::table('dmmx_employees_watch')->where([['employeeid',$request->idnumber],['companyid',$user->id],['status',1]])->first();

                if($employeeWatchCheck){
                     return Redirect::back()->with('error',"You already have " .$request->first_name ." " .$request->last_name ." on your employees list!");
                }

            }

            $employeeDetails = DB::table('dmmx_employees')->where('idnumber',$request->idnumber)->orWhere('email',$request->email)->first();

            //subtract contract unit
            DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail');

            //Add the employee/prospect to watchlist
            $addWatchStatus = DB::table('dmmx_employees_watch')->insert(
                    ['employeeid' => $employeeDetails->idnumber, 'companyid' => $user->id, 'watchstatus' => 'No start date', 'created_at' => date('Y-m-d H:i:s')]
            );

            //Mail::to($request->email)->queue(new ContractRequested($user, $employeeDetails));
            if(getenv('GAE_INSTANCE', true) === false) {
            Mail::to($employeeDetails->email)->queue(new EmployeeSLIPVerification($user, $employeeDetails));
            } else {
                Mail::to($employeeDetails->email)->send(new EmployeeSLIPVerification($user, $employeeDetails));
            }

             //update the sitemap
             // $this->createUpdateSitemap();
             Session::put('section', 'SLIP');
             return json_encode('Prospect(s) successfully moved to contract');
    }

    /**
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Employees $task, Request $request)
    {
        $request->merge(['user_id' => Sentinel::getUser()->id]);
        $task->update($request->except('_method', '_token'));
    }

    /**
     * Delete the given Driver.
     *
     * @param  Task $task
     */
    public function delete(Employees $task)
    {
        $task->delete();
    }

    /**
     * Ajax Data
     * @return array;
     */
    public function data()
    {
        return Employees::where('user_id', Sentinel::getUser()->id)
            ->orderBy('ticked', 'ASC')
            ->orderBy('task_deadline', 'DESC')
            ->get()
            ->toArray();

    }

    public function addToPending() {
        //check that the employee is not there already in the employees table. If not, add them, if they are there just update the watchstatus table 
        $user = Sentinel::getUser();
        //get all the prospects 
        $prospects = DB::table('loademployees')->where('user_id',$user->id)->get();
        //move the prospects to employees table and to watchstatus table
        foreach($prospects as $prospect){

            //check the validity of the email 
            $validateEmail = Mailgun::validator()->validate($prospect->email);
                if(!($validateEmail->is_valid)){
                return Redirect::back()->with('error', $prospect->first_name ." " .$prospect->last_name ." with Identity " .$prospect->idnumber ." has a invalid email address."); 
           }

            //check that the prospect's id does not exist
            $prospectCheck = DB::table('dmmx_employees')->where('idnumber',$prospect->idnumber)->count();
            //add the employee if he is not there already 
            if($prospectCheck == 0){
               $insertEmployee = DB::table('dmmx_employees')->insert(
                     [ 'first_name'=>$prospect->first_name,'last_name'=>$prospect->last_name,'idnumber' => $prospect->idnumber, 'email' => $prospect->email,'created_at' => date('Y-m-d H:i:s')]
                    );
            }
           
           //Add the employee/prospect to watchlist 
           $addWatchStatus = DB::table('dmmx_employees_watch')->insert(
                     ['employeeid' => $prospect->idnumber, 'companyid' => $user->id, 'watchstatus' => 'Pending', 'created_at' => date('Y-m-d H:i:s')]
                    );
           //delete the prospects 
           if($addWatchStatus){
               DB::table('loademployees')->where('user_id',$user->id)->delete();
           }
        }

       Session::put('section', 'Pending');

        //take the user to employees table 
        return redirect('myemployees')->with('success', 'Prospect(s) successfully moved to pending');
        
    }

    public function moveToContract() {
      //check that the employee is not there already in the employees table. If not, add them, if they are there just update the watchstatus table 
        $user = Sentinel::getUser();
        //get all the prospects 
        $prospects = DB::table('loademployees')->where('user_id',$user->id)->get();

        //first check that the user has enough credits to perform this action. If not, alert them
        $prospectsCount = DB::table('loademployees')->where('user_id',$user->id)->count();
        $getSubscription = DB::table('dmmx_paysubscriptions')->where('id',$user->permissions2)->first();//this should be a check for terms available

        //print_r($getSubscription);
       // echo $getSubscription->employees_avail;
       // die;

       //if the id number or the email match, create the record by copying

        if(($getSubscription->employees_avail) < $prospectsCount && ($getSubscription->employees_avail) > 0){
          return Redirect::back()->with('error', 'You do not have enough credits to perform this action, you are only allowed to add ' .$getSubscription->employees_avail .' employees/prospects or less'); 
        }
        foreach($prospects as $prospect){

         //check if the user is not adding themselves 
         if($prospect->email == $user->email){
             return Redirect::back()->with('error', "You cannot add yourself as an employee.");
         }

         //check if the user does not exist as either employer or admin 
         $activeAdminEmployerCheck = DB::table('users')->where('email',$prospect->email)->count();
         if($activeAdminEmployerCheck > 0){
             return Redirect::back()->with('error', "There is a user with " .$prospect->email ." address as an admin or employer.");
         }

         //check if the user is inactive admin
         $inactiveAdminCheck = DB::table('dmmx_admins_table')->where('email',$prospect->email)->count();
         if($inactiveAdminCheck > 0){
             return Redirect::back()->with('error', "Admin request was sent to user with email address " .$prospect->email .". You cannot add them as an employee.");
         }

            //check that the prospect's id does not exist
            $prospectCheck = DB::table('dmmx_employees')->where('idnumber',$prospect->idnumber)->count();
            $prospectEmailCheck = DB::table('dmmx_employees')->where('email',$prospect->email)->count();
            //add the employee if he is not there already 
            if($prospectCheck == 0 && $prospectEmailCheck == 0){
               $insertEmployee = DB::table('dmmx_employees')->insert(
                     [ 'first_name'=>$prospect->first_name,'last_name'=>$prospect->last_name, 'idnumber' => $prospect->idnumber, 'email' => $prospect->email,'created_at' => date('Y-m-d H:i:s')]
                    );

                //Add the employee/prospect to watchlist 
           $addWatchStatus = DB::table('dmmx_employees_watch')->insert(
                     ['employeeid' => $prospect->idnumber, 'companyid' => $user->id, 'watchstatus' => 'No start date', 'created_at' => date('Y-m-d H:i:s')]
                    );
           //delete the prospects 
           if($addWatchStatus){
              //send notification emails 
              $employeeDetails = DB::table('dmmx_employees')->where('idnumber',$prospect->idnumber)->first();
               Mail::to($prospect->email)->queue(new ContractRequested($user, $employeeDetails));
               DB::table('loademployees')->where('user_id',$user->id)->delete();
              }
            }else{
                //check if the employee is not on the watchlist already 
                $employeeWatchCheck = DB::table('dmmx_employees_watch')->where([['employeeid',$prospect->idnumber],['companyid',$user->id],['status',1]])->first();

                if($employeeWatchCheck){
                     return Redirect::back()->with('error',"You already have " .$prospect->first_name ." " .$prospect->last_name ." on your employees list!");
                }

               //Add the employee/prospect to watchlist 
              $addWatchStatus = DB::table('dmmx_employees_watch')->insert(
                     ['employeeid' => $prospect->idnumber, 'companyid' => $user->id, 'watchstatus' => 'No start date', 'created_at' => date('Y-m-d H:i:s')]
                    );
             //delete the prospects 
             if($addWatchStatus){
              //send notification emails 
              $employeeDetails = DB::table('dmmx_employees')->where('idnumber',$prospect->idnumber)->first();
               Mail::to($prospect->email)->queue(new ContractRequested($user, $employeeDetails));
               DB::table('loademployees')->where('user_id',$user->id)->delete();
              }

              //Maybe insert the employee based on a copy and then alert the user of what happened;
              return Redirect::back()->with('error',$prospect->first_name ." " .$prospect->last_name ." with identity number: " .$prospect->idnumber ." was loaded with a copy from our database because an employee with similar identity number or email exists" );

            }
           
        }
       //take the user to employees table 
        //update the sitemap 
       // $this->createUpdateSitemap();

        Session::put('section', 'SLIP');
        return redirect('myemployees')->with('success', 'Prospect(s) successfully moved to contract')->with('section');
    }

    public function createUpdateSitemap(){
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
        if ($counter == 50000) 
        {
            // generate new sitemap file
            $sitemap->store('xml','sitemap-'.$sitemapCounter);
            // add the file to the sitemaps array
            $sitemap->addSitemap(secure_url('sitemap-'.$sitemapCounter.'.xml'));
            // reset items array (clear memory)
            $sitemap->model->resetItems();
            // reset the counter
            $counter = 0;
            // count generated sitemap
            $sitemapCounter++;
        }

        // add employee to items array
        $sitemap->add(url('/') .'/view-employee/' .$e->id);
        // count number of elements
        $counter++;
      }

      // you need to check for unused items
      if (!empty($sitemap->model->getItems()))
      {
           // generate sitemap with last items
           $sitemap->store('xml','sitemap-'.$sitemapCounter);
           // add sitemap to sitemaps array
           $sitemap->addSitemap(secure_url('sitemap-'.$sitemapCounter.'.xml'));
           // reset items array
           $sitemap->model->resetItems();
       }

       // generate new sitemapindex that will contain all generated sitemaps above
       $sitemap->store('sitemapindex','sitemap');
    }

    public function loademployeesSubmit(Request $request){
         $user = Sentinel::getUser();
         $getSubscription = DB::table('dmmx_paysubscriptions')->where('id',$user->permissions2)->first();

         //check if compay is verified 
        $verification_docs_status = CompanyVerifyRepository::companyVerified($user->id);

        $validateEmail = Mailgun::validator()->validate($request->email);
                if (!($validateEmail->is_valid)) {
                    return Redirect::back()->with('error', 'Please enter a valid email address.');
                }

         if(!$verification_docs_status){
             //check that the company name exists
              if($user->companyname == null){ //This caters for companies that were registered before the company name fields was added in the registration form
                return Redirect::back()->with('error', "Please verify your company before performing this action.");
              }
         }

         //check if there is at least one credit to perform this 
         if($getSubscription->employees_avail == 0){
              return Redirect::back()->with('error', "You do not have enough subscription credits to perform this.");
         }

         //check if the user is not adding themselves 
         if($request->email == $user->email){
             return Redirect::back()->with('error', "You cannot add yourself as an employee.");
         }

         //check if the user does not exist as either employer or admin 
         $activeAdminEmployerCheck = DB::table('users')->where('email',$request->email)->count();
         if($activeAdminEmployerCheck > 0){
             return Redirect::back()->with('error', "There is a user with this email address as an admin or employer.");
         }

         //check if the user is inactive admin
         $inactiveAdminCheck = DB::table('dmmx_admins_table')->where('email',$request->email)->count();
         if($inactiveAdminCheck > 0){
             return Redirect::back()->with('error', "Admin request was sent to this user. You cannot add them as an employee.");
         }

         //add an employee 
         //add the employee to number of employees for today 
            $get_this_month_row = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->get();

            if(count($get_this_month_row) > 0){
                //add one to the column
                $updateRow = DB::table('daily_employees_quantity')->whereMonth('created_at', '=', date('m'))->increment('employees_quantity');
            }else{
                //create a new column 
                $createRow = DB::table('daily_employees_quantity')->insert(['userid' => $user->id, 'employees_quantity' => 1, 'date' => date("Y-m-d"), 'created_at' => date("Y-m-d H:i:s")]);
            }

            $prospectCheck = DB::table('dmmx_employees')->where('idnumber',$request->idnumber)->count();
            $prospectEmailCheck = DB::table('dmmx_employees')->where('email',$request->email)->count();
            //add the employee if he is not there already 
            if($prospectCheck == 0 && $prospectEmailCheck == 0){
                $account_number = $this->generateAccNumber("U");
                 $insertEmployee = DB::table('dmmx_employees')->insert(
                     [ 'first_name'=>$request->first_name,'last_name'=>$request->last_name, 'idnumber' => $request->idnumber, 'email' => $request->email,'created_at' => date('Y-m-d H:i:s'), 'acc_no' => $account_number]
                    );
          
            }else{
                 $employeeWatchCheck = DB::table('dmmx_employees_watch')->where([['employeeid',$request->idnumber],['companyid',$user->id],['status',1]])->first();

                if($employeeWatchCheck){
                     return Redirect::back()->with('error',"You already have " .$request->first_name ." " .$request->last_name ." on your employees list!");
                }
               
            }

            $employeeDetails = DB::table('dmmx_employees')->where('idnumber',$request->idnumber)->orWhere('email',$request->email)->first();
           
            //subtract contract unit
            DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail');

            //Add the employee/prospect to watchlist 
            $addWatchStatus = DB::table('dmmx_employees_watch')->insert(
                    ['employeeid' => $employeeDetails->idnumber, 'companyid' => $user->id, 'watchstatus' => 'No start date', 'created_at' => date('Y-m-d H:i:s')]
            );

            //Mail::to($request->email)->queue(new ContractRequested($user, $employeeDetails));

             //update the sitemap 
             // $this->createUpdateSitemap();
             Session::put('section', 'SLIP');
             if(getenv('GAE_INSTANCE', true) === false) {
             Mail::to($employeeDetails->email)->queue(new EmployeeSLIPVerification($user, $employeeDetails));
             } else {
                 Mail::to($employeeDetails->email)->send(new EmployeeSLIPVerification($user, $employeeDetails));
             }
             return redirect('myemployees')->with('success', 'Prospect(s) successfully moved to contract');



    }

     public function generateAccNumber($class_letter){
        if($class_letter == "C"){
          $last_row = User::orderBy('id', 'desc')->first();
        }
        if($class_letter == "A"){
          $last_row = Admin::orderBy('id', 'desc')->first();
        }
        if($class_letter == "U"){
          $last_row = EmployeesModel::orderBy('id', 'desc')->first();
        }
        $get_last_acc_number = $last_row->acc_no;
        if(!isset($get_last_acc_number)){
            $acc_no =$class_letter . "100000";
        }else{
            $acc_no = $class_letter .(substr($get_last_acc_number, 1) + rand(1, 50));
        }

        return $acc_no;
    }

}
