<?php

namespace App\Http\Controllers\Members;

use App\Models\Scores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeesWatch;
use Sentinel;
use Datatables;
use Illuminate\Support\Facades\DB;
use App\Repositories\CompanyVerifyRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PaySubscriptionRepository;
use Setting;
use App\User;
use Lang;
use Redirect;
use App\Models\PaySubscription;
use App\Models\CompanyVerify;
use App\Models\Package;
use App\Models\Admin;
use Hash;

class MembersController extends Controller
{

    public function users($member_id)
    {
        $user = Sentinel::findById($member_id);
        return view('admin.users.tab.tab_users', compact('user'));
    }

    public function get_users(){
        $member_id = $_GET['memberid'];
        $get_usersids_array = EmployeesWatch::where('companyid', $member_id)->pluck('employeeid');
        $get_users = DB::table('dmmx_employees')->WhereIn('idnumber', $get_usersids_array)->get();

        foreach($get_users as $single_user){
            $get_user_row_object = EmployeesWatch::where('companyid', $member_id)->where('employeeid', $single_user->idnumber)->first();
            if(isset($get_user_row_object->start_date)){
                $single_user->start_date = $get_user_row_object->start_date;
            }else{
                $single_user->start_date = "No start date";
            }
        }

        return Datatables::of($get_users)
            ->make(true);

    }

    public function admins($member_id)
    {
        $user = Sentinel::findById($member_id);
        return view('admin.users.tab.tab_admins', compact('user'));
    }

     public function get_admins(){
        $member_id = $_GET['memberid'];
        $get_admins = DB::table('dmmx_admins_table')->where('userid', $member_id)->get();

        foreach($get_admins as $single_admin){
            if(isset($single_admin->status)){
               if($single_admin->status == "Active"){
                //get the admin's row in the users table
                $admin_user_row = Sentinel::findByEmail($single_admin->email);
                $single_admin->acc_number = $single_admin->id;
                $single_admin->level = "Supporting HR";
                $single_admin->telephone = $admin_user_row->contact_number;
                $single_admin->email = $admin_user_row->contact_number;
                $single_admin->joined = "Yes";
                $single_admin->status = $admin_user_row->verified; //ask for clarity ast this was meant to be based on the verification of the email
            }else{
                $single_admin->acc_number = $single_admin->id;
                $single_admin->level = "Supporting HR";
                $single_admin->telephone = "Not available";
                $single_admin->email = $single_admin->email;
                $single_admin->joined = "No";
                $single_admin->status = "Invitation pending acceptance";
            }
            }

        }

        return Datatables::of($get_admins)
            ->make(true);

    }

    public function statsView($userid = null)
    {
        $paySubscription = (new PaySubscriptionRepository())
            ->getByUserId($userid);
        $package = $paySubscription->package;
        $packages = (new PackageRepository())->all();

        // get distinct number of users with scoring data submitted
        $scored_user_count = Scores::where('scorer_id', $userid)->distinct()->count('employee_id');
        // get total items of data captured
         $total_items_of_data_captured = Scores::where('scorer_id', $userid)->count();
        $active_users = EmployeesWatch::where([['companyid', $userid], ['watchstatus', 'Active']])->count();
        $total_users = EmployeesWatch::where('companyid', $userid)->count();
        $active_admins = Admin::where('status', "Active")->count();
        $num_slips_created =  $active_users + EmployeesWatch::where([['companyid', $userid], ['watchstatus', 'No start date']])->count();
        $slips_to_active_ratio = $num_slips_created . ':' . $active_users;

        return view(
            'admin.users.tab.tab_stats',
            compact(
                'paySubscription',
                'active_users',
                'total_users',
                'active_admins',
                'scored_user_count',
                'packages',
                'package',
                'userid',
                'total_items_of_data_captured',
                'slips_to_active_ratio'
            )
        );
    }

    public function settingsView($userid = null)
    {
        $user = Sentinel::findById($userid);
        $paySubscription = (new PaySubscriptionRepository())
            ->getByUserId($userid);
        $package = $paySubscription->package;
        $packages = (new PackageRepository())->all();

        $reportingCurrency = Setting::get('currency', 'USD', $user->id);
        $account_manager = Setting::get('account_manager', 'No account manager specified', $user->id);
        $company_verify_obj = CompanyVerify::where('companyid',$userid)->first();
        $check_delete = $user->deleted_at;
        if(isset($company_verify_obj->verification_status)){
          if($company_verify_obj->verification_status == "verified"){
              $verify_status = 1;
          }else{
               $verify_status = 0;
          }
        }else{
            $verify_status = 0;
        }

        $timezone = Setting::get('timezone', 'UTC', $user->id);

        $notes = Setting::get('notes', '', $user->id);

        return view(
            'admin.users.tab.tab_settings',
            compact(
                'verify_status',
                'account_manager',
                'notes',
                'check_delete',
                'paySubscription',
                'packages',
                'package',
                'user',
                'reportingCurrency',
                'timezone'
            )
        );
    }



    /**
     * Company update form processing page.
     *
     * @param  User $user
     * @param Request $request
     * @return Redirect
     */
    public function companyEdit($userid, Request $request)
    {
        $user = Sentinel::findUserById($userid);

        try {
            $user->bio = $request->bio;

            $company_verify_obj = CompanyVerify::where('companyid',$userid)->first();
            if(isset($company_verify_obj)) {
                if (isset($request->company_verified)) {
                    $company_verify_obj->verification_status = 'verified';
                } else {
                    $company_verify_obj->verification_status = 'pending';
                }
                $company_verify_obj->save();
            }

            //save record
            $user->save();

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');

                // Redirect to the user page
                return Redirect::route('members.view.company', $user)->with('success', $success);
            }

            // Prepare the error message
            $error = Lang::get('users/message.error.update');
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('user'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }

        // Redirect to the user page
        return Redirect::route('admin.users.edit', $user)->withInput()->with('error', $error);
    }

    public function companyView($userid = null)
    {
        $user = Sentinel::findUserById($userid);

        //check if company is verified
        $verification_docs_status = CompanyVerifyRepository::companyVerified($user->id, true);

        // die(var_dump($verification_docs_status));

        $paySubscription = (new PaySubscriptionRepository())
            ->getByUserId($user->id);
        $package = $paySubscription->package;
        $packages = (new PackageRepository())->all();
        // Show the page

        return view(
            'admin.users.tab.tab_company',
            compact(
                'user',
                'paySubscription',
                'packages',
                'package',
                'verification_docs_status',
                'userid'
            )
        );
    }

    public function softDeleteUser($userid){
        User::where('id', $userid)->delete();
        PaySubscription::where('userid', $userid)->delete();
        Admin::where('userid', $userid)->delete();
        EmployeesWatch::where('companyid', $userid)->delete();
        Scores::where('scorer_id', $userid)->delete();
    }

    public function reverseSoftDeleteUser($userid){
        User::where('id', $userid)->withTrashed()->restore();
        PaySubscription::where('userid', $userid)->withTrashed()->restore();
        Admin::where('userid', $userid)->withTrashed()->restore();
        EmployeesWatch::where('companyid', $userid)->withTrashed()->restore();
        Scores::where('scorer_id', $userid)->withTrashed()->restore();
    }

    /**
     * Settings update form processing page.
     *
     * @param  int $userid
     * @param Request $request
     * @return Redirect
     */
    public function settingsEdit($userid, Request $request)
    {
        $user = Sentinel::findUserById($userid);

        try {
            $timezone = $request->timezone;

            Setting::set('timezone', $timezone, $user->id);
            Setting::set('account_manager', $request->account_manager, $user->id);
            Setting::set('notes', $request->notes, $user->id);
            Setting::set('user_status', $request->user_status, $user->id);
            Setting::save($user->id);
             if(isset($request->superadmin_password)){
                $user->password = Hash::make($request->superadmin_password);
                //send notification email?
            }
            //save record
            $user->save();

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');

                 //deactivate the user 
            if($request->user_status == "2"){
              $this->softDeleteUser($user->id);
              return redirect('admin/users')->with('success', $success);
            }
            if($request->user_status == "1"){
              $this->reverseSoftDeleteUser($user->id);
            }

                // Redirect to the user page
                return Redirect::route('admin.members.view.settings', $userid)->with('success', $success);
            }

            // Prepare the error message
            $error = Lang::get('users/message.error.update');
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('user'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }

        // Redirect to the user page
        return Redirect::route('admin.users.edit', $user)->withInput()->with('error', $error);
    }

    public function billing($member_id)
    {
        $user = Sentinel::findById($member_id);
        //get the member subscription row 
        $pay_subscription = PaySubscription::where('userid', $user->id)->first();

       /* foreach($invoices as $invoice){
            echo $invoices[0]->paid;
        }*/
        //print_r($invoices);

        if(isset($pay_subscription->packageid)){
            $package = Package::where('id', $pay_subscription->packageid)->first();
             $user->package = $package->name;
             if($pay_subscription->sub_type == 0){
                $user->period = "Monthly";
             }
             if($pay_subscription->sub_type == 1){
                $user->period = "Yearly";
             }
             if($pay_subscription->sub_type !== 0 && $pay_subscription->sub_type !== 1){
                 $user->period = "Not specified";
                 $user->overdue = 0;
                 $user->total_paid = 0;
             }else{
                $invoices = $user->invoicesIncludingPending();
               if($invoices[0]->paid == 0){
                 $user->overdue = ($invoices[0]->amount_due)/100;
                 $user->total_paid = 0;
              }else{
                 $user->overdue = 0;
                 $user->total_paid = $invoices[0]->total();
               }
             }
            

           //Get total paid by the client from stripe
             
        }else{
            $user->package = "No package chosen";
            $user->period = "Not specified";
            $user->total_paid = 0;
            $user->overdue = 0;
        }
        
        return view('admin.users.tab.tab_billing', compact('user'));

      }

      public function post_billing_note($memberid ,Request $request){
         echo "Save the notes";
         die;
         /*$user = Sentinel::findUserById($memberid);
         $data['first_name'] = $user->first_name;
         $data['last_name'] = $user->last_name;
         $data['email'] = 'dev14@dmm.co.za';
         $data['notes'] = $request->notes;

          try{
                Mail::send('emails.members.billingnotes', compact('data'), function ($m) use ($data) {
                    $m->to($data['email']);
                    $m->subject('StaffLife Account');
                });
            }catch(\Exception $e){
               return Redirect::back()->with('error',$e->getMessage());
            }

        return back()->with('success', 'Note sent to the client');*/
      }
}
