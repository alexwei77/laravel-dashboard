<?php

namespace App\Http\Controllers;

use Activation;
use App\Http\Requests\UserRequest;
use Response;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Reminder;
use Validator;
use Sentinel;
use URL;
use View;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Storage;
use Vsmoraes\Pdf\Pdf;
use Datatables;
use IP2LocationLaravel;
use App;
use Session;
use App\Mail\AdminsMail;
use App\Mail\StaffAlert;
use App\Mail\AdminsRemoveMail;
use Bogardo\Mailgun\Facades\Mailgun;
use Jrean\UserVerification\Facades\UserVerification;
use RegistersUsers;
use VerifiesUsers;
use App\MyLibrary\GetIpLocale;
use App\MyLibrary\Util;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Carbon\Carbon;
use nlutro\LaravelSettings\SettingStore;
use Setting;
use App\Models\Currencies;
use App\Repositories\CompanyVerifyRepository;
use App\Models\EmployeesWatch;
use App\Repositories\EmployeesRepository;
use App\Models\Scores;
use App\Models\Metrics;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin;
class FrontEndController extends JoshController
{
    /*
     * $user_activation set to false makes the user activation via user registered email
     * and set to true makes user activated while creation
     */
    private $user_activation = true;

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getLogin()
    {

        // Is the user logged in?
        if (Sentinel::check()) {
            return redirect()->intended();
        }

        // Show the login page
        return Response::view('login')->header('Cache-control', 'max-age=86400');
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function employeeLogin()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return redirect()->intended();
        }

        // Show the login page
        return Response::view('employeelogin')->header('Cache-control', 'max-age=86400');
    }

    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    //this is a login for employers
    public function postLogin(Request $request)
    {

        //try {
            //first check that the email has got permissions
            // $permissionsCheck = DB::table('users')->where([['email', '=', $request->email], ['permissions2', '>', 0]])->count();
            // Try to log the user in
            // echo $permissionsCheck;
            // die;
            //if($permissionsCheck !== 0){
            if (Sentinel::authenticate($request->only('email', 'password'), $request->get('remember-me', 0))) {
                return redirect()->intended('dashboard');
            }
            else {
                return redirect('login')->with('error', 'Email or password is incorrect.');
            }

//        } catch (UserNotFoundException $e) {
//            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
//        } catch (NotActivatedException $e) {
//            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
//        } catch (UserSuspendedException $e) {
//            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
//        } catch (UserBannedException $e) {
//            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
//        } catch (ThrottlingException $e) {
//            $delay = $e->getDelay();
//            $this->messageBag->add('email', Lang::get('auth/message.account_suspended', compact('delay')));
//        }
//
//        // Ooops.. something went wrong
//        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Employee account sign in form processing.
     *
     * @return Redirect
     */
    //this is a login for employers
    public function employeePostLogin(Request $request)
    {

        try {
            //first check that the email has got permissions
            $employeeCheck = DB::table('dmmx_employees')->where('email', '=', $request->email)->count();

            // Try to log the user in
            // echo $permissionsCheck;
            // die;
            if ($employeeCheck !== 0) {
                if (Sentinel::authenticate($request->only('email', 'password'), $request->get('remember-me', 0))) {
                    return redirect()->intended('/');
                }
            } else {
                return redirect('employeelogin')->with('error', 'Email or password is incorrect.');
                //return Redirect::back()->withInput()->withErrors($validator);
            }

        } catch (UserNotFoundException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
        } catch (UserSuspendedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
        } catch (UserBannedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended', compact('delay')));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegister($firstname=null, $lastname=null, $email=null)
    {
        
        // Is the user logged in?
        if (Sentinel::check()) {
            return redirect()->intended();
        }

        if($firstname == null || $lastname == null || $email == null){
            //direct the user to home
            return redirect('/');
        }

        // Show the login page
        return Response::view('register', compact('firstname', 'lastname', 'email'))->header('Cache-control', 'max-age=86400');
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postRegister(UserRequest $request)
    {
        //check for the validity of the email
        $validateEmail = Mailgun::validator()->validate($request->email);
        if (!($validateEmail->is_valid)) {
            return Redirect::back()->with('error', 'Please enter a valid email address');
        }

        $activate = $this->user_activation; //make it false if you don't want to activate user automatically.

        try {
            // Register the user
            //check if the user is a supporting admin
            $checkifAdmin = DB::table('dmmx_admins_table')->where('email', $request->get('email'))->first();
            $checkifAdminGet = DB::table('dmmx_admins_table')->where('email', $request->get('email'))->get();
            //check if employee
            $checkIfEmployeeGet = DB::table('dmmx_employees')->where('email', $request->get('email'))->get();
            $permissions = 0;

            if (count($checkifAdminGet) > 0) {
                //This is an admin
                if ($checkifAdmin->status == "request sent") {
                    //the user must be registered
                    $getPermission = DB::table('dmmx_paysubscriptions')->where('userid', $checkifAdmin->userid)->first();
                    $permissions = $getPermission->id;
                } else {
                    //alert the user that they are already an admin
                    return back()->with('error', 'You are already an admin, please login');
                }
            }

            if (count($checkIfEmployeeGet) > 0) {
                return back()->with('error', 'There is an employee associated with this email address, employee registration is not allowed through this form');
            }

            //if neither employee nor admin, redirect them to package choosing
            if (count($checkIfEmployeeGet) == 0 && count($checkifAdminGet) == 0) {
                return redirect('pricing')->with('error', "Please choose a package first before registration");
            }

            $request['permissions2'] = $permissions;
            $user = Sentinel::register($request->only(['permissions2', 'businessstatus', 'postal', 'address', 'city', 'state', 'country', 'companyname', 'registrationnumber', 'first_name', 'last_name', 'email', 'password', 'gender']), $activate);
            if ($user) {
                //update the admin status to Active
                DB::table('dmmx_admins_table')->where('email', $request->get('email'))->update(['status' => 'Active', 'first_name' => $request->get('first_name'), 'last_name' => $request->get('last_name')]);
            }
            //add user to 'User' group
            $role = Sentinel::findRoleByName('User');
            $role->users()->attach($user);

            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
                return redirect('login')->with('success', Lang::get('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);

            //send email verification mail 
            UserVerification::generate($user);
            UserVerification::send($user, 'StaffLife Email Verification');
            
            // Redirect to the my account with success notification
            return Redirect::route("dashboard")->with('success', Lang::get('auth/message.signup.success'));
            //return View::make('user_account')->with('success', Lang::get('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * User account activation page.
     *
     * @param number $userId
     * @param string $activationCode
     *
     */
    public function getActivate($userId, $activationCode)
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('my-account');
        }

        $user = Sentinel::findById($userId);

        if (Activation::complete($user, $activationCode)) {
            // Activation was successful
            return Redirect::route('login')->with('success', Lang::get('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = Lang::get('auth/message.activate.error');
            return Redirect::route('login')->with('error', $error);
        }
    }

    /**
     * Forgot password page.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        // Show the page
        return Response::view('forgotpwd')->header('Cache-control', 'max-age=86400');
    }

    /**
     * Forgot password form processing page.
     * @param Request $request
     * @return Redirect
     */
    public function postForgotPassword(Request $request)
    {
        try {
            // Get the user password recovery code
            //$user = Sentinel::FindByLogin($request->get('email'));
            $user = Sentinel::findByCredentials(['email' => $request->email]);
            if (!$user) {
                return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_email_not_found'));
            }

            $activation = Activation::completed($user);
            if (!$activation) {
                return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_activated'));
            }

            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view
            $data = array(
                'user' => $user,
                //'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', [$user->id, $reminder->code]),
            );

            // Send the activation code through email
            Mail::send('emails.forgot-password', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Account Password Recovery');
            });
        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return back()->with('success', Lang::get('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($userId, $passwordResetCode = null)
    {
        if (!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

        if ($reminder = Reminder::exists($user)) {
            if ($passwordResetCode == $reminder->code) {
                return Response::view('forgotpwd-confirm', compact(['userId', 'passwordResetCode']))->header('Cache-control', 'max-age=86400');
            } else {
                return 'code does not match';
            }
        } else {
            return 'does not exist';
        }


        // Show the page
        //   return View::make('forgotpwd-confirm', compact(['userId', 'passwordResetCode']));
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  string $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(Request $request, $userId, $passwordResetCode = null)
    {

        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::route('login')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
        }

        // Password successfully reseted
        return Redirect::route('login')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Thank you page
     * @param Request $request
     * @return Redirect
     */
    public function getThankYou(Request $request)
    {
        //return multi regional thank you page
        return Response::view('thankyou')->header('Cache-control', 'max-age=86400');
    }

    public function getPrivacy(Request $request, $lang = null)
    {
        $util = new Util();

        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'privacy';

        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/privacy');
                }
                return $util->moddedRedirect($ip_locale . '/privacy');
            }
            return $util->moddedRedirect($ip_locale . '/privacy');
        }
        return Response::view('privacy', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    /**
     * Contact form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postContact(Request $request)
    {
        if (App::environment('local') || (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))) {
            if (App::environment('prod')) {
                $captcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';

                // our site secret key
                $secret = '6Lc7HysUAAAAAM9NufeJKZDLhpaOW4tNc0uhZ62E';

                //get verify response data
                // note: unable to use the line below as the function is disabled on account of allow_url_fopen being disabled, thanks Hetzner!
                // $verifyResponse = file_get_contents($captcha_verify_url . '?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $captcha_verify_url . '?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'],
                    CURLOPT_USERAGENT => 'SLAgent'
                ));

                // Send the request & save response to $resp
                $verifyResponse = curl_exec($curl);
                // Close request to clear up some resources
                curl_close($curl);
                $responseData = json_decode($verifyResponse);

            }
            if (App::environment('local') || $responseData->success) {
                // Data to be used on the email view
                $data = array(
                    'contact-name' => $request->get('contact-name'),
                    'contact-email' => $request->get('contact-email'),
                    'contact-tel' => $request->get('contact-tel'),
                    'contact-msg' => $request->get('contact-msg'),
                );

                $validateEmail = Mailgun::validator()->validate($data['contact-email']);
                if (!($validateEmail->is_valid)) {
                    return Redirect::back()->with('error', 'Please enter a valid email address');
                }

                if(!isset($data['contact-name']) || strlen(trim($data['contact-name'])) == 0) {
                    return Redirect::back()->with('error', 'Please enter your name');
                }

                if(!isset($data['contact-msg']) || strlen(trim($data['contact-msg'])) == 0) {
                    return Redirect::back()->with('error', 'Please enter a message to send');
                }

                // Send the activation code through email
                Mail::send('emails.contact', compact('data'), function ($m) use ($data) {
                    $m->from($data['contact-email'], $data['contact-name']);
                    $m->to('info@stafflife.com', @trans('general.site_name'));
                    $m->subject('Received a mail from ' . $data['contact-name']);

                });

                //return multi regional thank you page
                return Response::view('thankyou')->header('Cache-control', 'max-age=86400');
            } else {
                return Redirect::back()->with('error', 'Robot verification failed. Please try again.')->withInput();
            }
        } else {
            return Redirect::back()->with('error', 'Please click on the reCAPTCHA box.')->withInput();
        }
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        // Log the user out
        Sentinel::logout();

        // Redirect to the users page
        return redirect('login')->with('success', 'You have successfully logged out!');
    }

    ////////////USER SUBSCRIPTION//////////////

    /**
     * get subscription form and display
     */
    public function getSubscribe($packageChosen)
    {
        //Get packages prices
        $countryPrices = DB::table('dmmx_country_prices')->get();
        //get all the currency codes
        $currencyInfo = DB::table('currency')->get();
        $user = Sentinel::getUser();
        $countries = $this->countries;
        if ($packageChosen !== "") {
            $packageView = $packageChosen;
        } else {
            $packageView = " ";
        }
        return Response::view('user_subscribe', compact('user', 'countries', 'currencyInfo', 'countryPrices', 'packageView'))->header('Cache-control', 'max-age=86400');
    }

    public function getSubscribePublic($lang=null, $packageChosen, $yearly)
    {
        if ($yearly == "yearly") {
            $yearly = 1;
        }

        if ($yearly == "monthly") {
            $yearly = 0;
        }
        //Get packages prices
        $countryPrices = DB::table('dmmx_country_prices')->get();
        //get all the currency codes
        $currencyInfo = DB::table('currency')->get();
        $user = Sentinel::getUser();
        $countries = $this->countries;
        if ($packageChosen !== "") {
            $packageView = $packageChosen;
        } else {
            $packageView = " ";
        }
        // Is the user logged in?
        if (Sentinel::check()) {
            $getSubscription = DB::table('packages')->where('name', ucfirst($packageChosen))->first();
            // update package chosen in DB
            $packageID = $getSubscription->id;
            DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['packageid' => $packageID]);

            //go to the dashboard
            return Redirect::route('dashboard')->with('success', 'Your subscription trial has been started');;


        } else {
            return view('user_subscribe_public', compact('user', 'countries', 'currencyInfo', 'countryPrices', 'packageView', 'packageChosen', 'yearly'));
        }
    }

    public function generateAccNumber($class_letter){
        if($class_letter == "C"){
          $last_row = User::orderBy('id', 'desc')->first();
        }
        if($class_letter == "A"){
          $last_row = Admin::orderBy('id', 'desc')->first();
        }
        $get_last_acc_number = $last_row->acc_no;
        if(!isset($get_last_acc_number)){
            $acc_no =$class_letter . "100000";
        }else{
            $acc_no = $class_letter .(substr($get_last_acc_number, 1) + rand(1, 50));
        }

        return $acc_no;
    }

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     * @return Redirect
     */
    public function subscribe(Request $request, User $user)
    {
        $util = new Util();

        //validate the email address
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $validateEmail = Mailgun::validator()->validate($request->email);

            if (!($validateEmail->is_valid)) {
                return Redirect::back()->with('error', 'Please enter a valid email address');
            }
        } else {
            return Redirect::back()->with('error', 'Please enter a valid email address');
        }

        if (!isset($request->first_name)) {
            return Redirect::back()->with('error', 'Please enter your first name');
        }

        if (!isset($request->last_name)) {
            return Redirect::back()->with('error', 'Please enter your last name');
        }

        if (!isset($request->password)) {
            return Redirect::back()->with('error', 'Please enter a password');
        }

        if (!isset($request->password_confirm)) {
            return Redirect::back()->with('error', 'Please enter confirm the password you entered initially');
        }

        if (strcmp($request->password, $request->password_confirm) !== 0) {
            return Redirect::back()->with('error', 'Please make sure the two passwords you entered match');
        }

        //die;
        /*print_r($validateEmail);
        die;*/

        $user = Sentinel::getUser();

        if ($user) {
            return Redirect::back()->with('error', 'You are not allowed to perform this action');
        } else {
            //echo "user is not logged in";
            //Register the user and log them in
            $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable
            //check if the email address does not exist already
            $emailCheck = DB::table('users')->where('email', $request->email)->first();
            //check if given password matches

            if (count($emailCheck) > 0) {
                //validate password and password confirm
                // $validatePassowrd =
                return Redirect::back()->with('error', 'Email address already please use your password for the password and password confirm fields or reset your password');
            }

            try {
                // Register the user
                $request->trial_ends_at = Carbon::now()->addDays(14);
                //create the account number
                $account_number = $this->generateAccNumber("C");

                $user = Sentinel::registerAndActivate(array(
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => $request->get('password'),
                    'country' => $request->get('country'),
                    'companyname' => $request->get('companyname'),
                    'contact_number' => $request->get('company_phone'),
                    'trial_ends_at' => $request->trial_ends_at,
                    'acc_no' => $account_number,
                    //'trial_ends_at' => $request->trial_ends_at,
                ));

                //add user to 'User' group
                $role = Sentinel::findRoleByName('User');
                $role->users()->attach($user);

                //if you set $activate=false above then user will receive an activation mail
                if (!$activate) {
                    // Data to be used on the email view
                    $data = array(
                        'user' => $user,
                        'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                    );

                    // Send the activation code through email
                    Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                        $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                        $m->subject('Welcome ' . $user->first_name);
                    });
                }
                // login user automatically
                Sentinel::login($user, false);

            } catch (UserExistsException $e) {
                //$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
                return Redirect::back()->with('error', 'Account creation failed');
            }

        }

        $user = Sentinel::getUser();

        //verify the email after checking that i is valid (could be that you do not need to check for its validity)
        //send(AuthenticatableContract $user, $subject, $from = null, $name = null);
        //$user2 = auth()->user();
        /*print_r($user2);
        die;*/
        UserVerification::generate($user);
        UserVerification::send($user, 'StaffLife Email Verification');

        //send alert email to stafflife
        if (App::environment('prod')) {
            if(getenv('GAE_INSTANCE', true) === false) {
            Mail::to('philip@stafflife.com')->cc('maxine@dmm.co.za')->queue(new StaffAlert($user));
        } else {
                Mail::to('philip@stafflife.com')->cc('maxine@dmm.co.za')->send(new StaffAlert($user));
            }
        } else {
            if(getenv('GAE_INSTANCE', true) === false) {
            Mail::to('dev14@stafflife.com')->cc('dev11@stafflife.com')->queue(new StaffAlert($user));
            } else {
                Mail::to('dev14@stafflife.com')->cc('dev11@stafflife.com')->send(new StaffAlert($user));
            }
        }

        /*Auth::logout();
        die;*/

        /*
        if (!empty($request->get('standard_category'))) {
            $categoryChosen = $request->get('standard_category');
        }
        */

        //if no contracts quatity seleceted, return to the subscribe page with an error message
        /*if(empty($request->get('subperiod'))){
            return view('user_subscribe', compact('countries', 'user', 'currencyInfo'))->with('error', 'Please select number of contracts');
        }*/
        //get the data
        $subdata = array();
        $subdata1 = array();
        if ($request->get('subperiod') == 0) {
            $subdata = array(
                'category' => $request->get('category'),
                'PAYGATE_ID' => $request->get('PAYGATE_ID'),
                'REFERENCE' => $request->get('REFERENCE'),
                'AMOUNT' => $request->get('AMOUNT'),
                'CURRENCY' => $request->get('CURRENCY'),
                'RETURN_URL' => $request->get('RETURN_URL'),
                'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
                'SUBS_START_DATE' => $request->get('SUBS_START_DATE'),
                'SUBS_FREQUENCY' => $request->get('SUBS_FREQUENCY'),
                'SUBS_END_DATE' => $request->get('SUBS_END_DATE'),
                'PROCESS_NOW' => $request->get('PROCESS_NOW'),
                'VERSION' => $request->get('VERSION'),
                'PROCESS_NOW_AMOUNT' => $request->get('PROCESS_NOW_AMOUNT'),
                'LOCALE' => $request->get('LOCALE'),
                'COUNTRY' => $request->get('COUNTRY'),
                'email' => $request->get('email'),
                'standard_category' => $request->get('standard_category'),
                'sub_countryid' => $request->get('sub_countryid'),
                'user' => $user->id,
            );

            //add paysubscription row
            $packageID = 0;
            if ($request->get('standard_category') == "standard") {
                $packageID = 1;
            }
            if ($request->get('standard_category') == "professional") {
                $packageID = 2;
            }
            if ($request->get('standard_category') == "business") {
                $packageID = 3;
            }
            if ($request->get('standard_category') == "enterprise") {
                $packageID = 4;
            }
            if ($request->get('standard_category') == "elite") {
                $packageID = 5;
            }
            if ($request->get('standard_category') == "test-plan") {
                $packageID = 8;
            }

            $the_package = DB::table('packages')->where('id', $packageID)->first();

            $employees_av = $the_package->terms_forms;
            if ($employees_av == "Unlimited") {
                $employees_av = -1;
            }
            $insertSubscription = DB::table('dmmx_paysubscriptions')->insert(
                ['packageid' => $the_package->id, 'pay_status' => 0, 'userid' => $user->id, 'REFERENCE' => $subdata['REFERENCE'], 'TRANSACTION_STATUS' => null, 'RESULT_CODE' => null, 'AUTH_CODE' => null, 'AMOUNT' => $the_package->monthly_price, 'RESULT_DESC' => '', 'TRANSACTION_ID' => '', 'SUBSCRIPTION_ID' => '', 'RISK_INDICATOR' => '', 'sub_countrcode' => $subdata['COUNTRY'], 'sub_currencycode' => $subdata['CURRENCY'], 'quantity_admins' => $the_package->admins, 'admins_avail' => (($the_package->admins)-1), 'employees' => $the_package->terms_forms, 'employees_avail' => $the_package->terms_forms, 'base' => 0, 'terms' => $the_package->terms_forms, 'support' => $the_package->support, 'TRANSACTION_DATE' => date('Y-m-d'), 'SUBS_START_DATE' => date('Y-m-d'), 'SUBS_END_DATE' => date('Y-m-d', strtotime("+12 months", strtotime(date('Y-m-d')))), 'SUBS_FREQUENCY' => null, 'PROCESS_NOW_AMOUNT' => $subdata['AMOUNT'], 'created_at' => date('Y-m-d H:i:s')]
            );

            //insert permissions for the user
            $subscriptionR = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
            //refine this to include all users depednded on this account
            DB::table('users')->where('id', $user->id)->update(['permissions2' => $subscriptionR->id]);
        } else {

            //its a yearly package

            //add paysubscription row
            $packageID = 0;
            if ($request->get('standard_category') == "standard") {
                $packageID = 1;
            }
            if ($request->get('standard_category') == "professional") {
                $packageID = 2;
            }
            if ($request->get('standard_category') == "business") {
                $packageID = 3;
            }
            if ($request->get('standard_category') == "enterprise") {
                $packageID = 4;
            }
            if ($request->get('standard_category') == "elite") {
                $packageID = 5;
            }
            if ($request->get('standard_category') == "test-plan") {
                $packageID = 8;
            }

            $the_package = DB::table('packages')->where('id', $packageID)->first();

            $subdata1 = array(
                'category' => $request->get('category'),
                'PAYGATE_ID' => $request->get('PAYGATE_ID'),
                'REFERENCE' => $request->get('REFERENCE'),
                'AMOUNT' => ($the_package->price) * 12,
                'CURRENCY' => $request->get('CURRENCY'),
                'RETURN_URL' => $request->get('RETURN_URL'),
                'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
                'LOCALE' => $request->get('LOCALE'),
                'COUNTRY' => $request->get('COUNTRY'),
                'EMAIL' => $request->get('EMAIL'),
                'CHECKSUM' => $request->get('CHECKSUM'),
                'standard_category' => $request->get('standard_category'),
                'sub_countryid' => $request->get('sub_countryid'),
                'user' => $user->id,
            );

            $employees_av = $the_package->terms_forms;
            if ($employees_av == "Unlimited") {
                $employees_av = -1;
            }
            $insertSubscription = DB::table('dmmx_paysubscriptions')->insert(['sub_type' => 1, 'packageid' => $the_package->id, 'pay_status' => 0, 'userid' => $user->id, 'REFERENCE' => $subdata1['REFERENCE'], 'TRANSACTION_STATUS' => null, 'RESULT_CODE' => null, 'AUTH_CODE' => null, 'AMOUNT' => $subdata1['AMOUNT'], 'RESULT_DESC' => '', 'TRANSACTION_ID' => '', 'SUBSCRIPTION_ID' => '', 'RISK_INDICATOR' => '', 'sub_countrcode' => $subdata1['COUNTRY'], 'sub_currencycode' => $subdata1['CURRENCY'], 'quantity_admins' => $the_package->admins, 'admins_avail' => (($the_package->admins)-1), 'employees' => $the_package->terms_forms, 'employees_avail' => $the_package->terms_forms, 'base' => 0, 'terms' => $the_package->terms_forms, 'support' => $the_package->support, 'TRANSACTION_DATE' => date('Y-m-d'), 'SUBS_START_DATE' => date('Y-m-d'), 'SUBS_END_DATE' => date('Y-m-d'), 'SUBS_FREQUENCY' => null, 'PROCESS_NOW_AMOUNT' => $subdata1['AMOUNT'], 'created_at' => date('Y-m-d H:i:s')]);

            //insert permissions for the user
            $subscriptionR = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
            //refine this to include all users depended on this account
            DB::table('users')->where('id', $user->id)->update(['permissions2' => $subscriptionR->id]);

        }
        return Redirect::back()->with('success');
       // return view('request', compact('subdata', 'user', 'subdata1', 'the_package'));
         //return Redirect::route('pay-package');


    }


    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     * @return Redirect
     */
    public function subscribeEmployer(Request $request, User $user)
    {

        $user = Sentinel::getUser();

        //get the amount that needs to be paid now or the amount that needs to be refunded
        /*$userBalance = 0;
        if($request->get('subperiod') == 1){

        }*/

        if ($request->get('downupgrade') !== "null") {
            $checkUpDownGrade = $request->get('downupgrade');

            $checkSubscription = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $request->get('REFERENCE'))->first();
            //update the package and save the refund amount in th database
            $transactionReceivedAl = 1;

            //update the package
            $countrpricesRow = DB::table('dmmx_country_prices')->where('id', $request->get("sub_countryid"))->get();
            //get values for this package
            $prefix = '';
            $adminsAvail = 0;
            $employeesAvil = 0;
            if ($request->get("standard_category") == 'standard') {
                $prefix = 'std_';
                $employeesAvil = 50;
                $adminsAvail = 0;
            }
            if ($request->get("standard_category") == 'business') {
                $prefix = 'bn_';
                $employeesAvil = 250;
                $adminsAvail = 1;
            }
            if ($request->get("standard_category") == 'professional') {
                $prefix = 'pro_';
                $employeesAvil = 1000;
                $adminsAvail = 2;
            }
            if ($request->get("standard_category") == 'enterprise') {
                $prefix = 'ent_';
                $employeesAvil = 5000;
                $adminsAvail = 4;
            }
            if ($request->get("standard_category") == 'elite') {
                $prefix = 'el_';
                $employeesAvil = -1;
                $adminsAvail = -1;
            }
            //columns to get
            $usersColumn = $prefix . 'users';
            $priceColumn = $prefix . 'price';
            $employeesColumn = $prefix . 'employees';
            $baseColumn = $prefix . 'base';
            $discountColumn = $prefix . 'discount';
            $termsColumn = $prefix . 'terms';
            $supportColumn = $prefix . 'support';

            ////update the subscription
            //determine the number of employees watched an dthe number of already available
            //|| Get admins using this package
            $adminsUsingPackage = DB::table('users')->where('permissions2', $checkSubscription->id)->get();
            $arrayOfUsersIds = array();
            $numberOfAdmins = 0;
            foreach ($adminsUsingPackage as $singleAdmin) {
                array_push($arrayOfUsersIds, $singleAdmin->id);
                $numberOfAdmins++;
            }
            $numberOfEmployee = DB::table('dmmx_employees_watch')->whereIn('companyid', $arrayOfUsersIds)->count();

            //print_r($adminsUsingPackage);
            $updateSubscription = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $request->get('REFERENCE'))->update(
                ['AMOUNT' => ($request->get('AMOUNT')) * 100, 'quantity_admins' => $countrpricesRow[0]->$usersColumn, 'admins_avail' => ($adminsAvail - $numberOfAdmins) + 1, 'employees' => $countrpricesRow[0]->$employeesColumn, 'employees_avail' => ($employeesAvil - $numberOfEmployee), 'base' => $countrpricesRow[0]->$baseColumn, 'terms' => $countrpricesRow[0]->$termsColumn, 'support' => $countrpricesRow[0]->$supportColumn, 'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'), 'SUBS_FREQUENCY' => $request->get('SUBS_FREQUENCY'), 'refund' => $request->get('PROCESS_NOW_AMOUNT'), 'created_at' => date('Y-m-d H:i:s')]
            );

            if ($updateSubscription) {
                //add permission to all the users that have permission to this subscription package
                $subscriptionID = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $request->get('REFERENCE'))->get();
                //refine this to include all users depednded on this account
                foreach ($subscriptionID as $subscriptionID1) {
                    DB::table('users')->where('id', $user->id)->update(['permissions2' => $subscriptionID1->id]);
                }

            }


            return Redirect::back()->with('success', 'Downgrade request received');

        };
        if ($user) {
            //echo "user is logged in";
        } else {
            //echo "user is not logged in";
            //Register the user and log them in
            $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable
            //check if the email address does not exist already
            $emailCheck = DB::table('users')->where('email', $request->email)->first();
            if ($emailCheck) {
                return Redirect::back()->with('error', 'Email address already exists');
            }

            try {
                // Register the user
                $user = Sentinel::register($request->only(['businessstatus', 'postal', 'address', 'city', 'state', 'country', 'companyname', 'registrationnumber', 'first_name', 'last_name', 'email', 'password', 'gender']), $activate);

                //add user to 'User' group
                $role = Sentinel::findRoleByName('User');
                $role->users()->attach($user);

                //if you set $activate=false above then user will receive an activation mail
                if (!$activate) {
                    // Data to be used on the email view
                    $data = array(
                        'user' => $user,
                        'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                    );

                    // Send the activation code through email
                    Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                        $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                        $m->subject('Welcome ' . $user->first_name);
                    });
                }
                // login user automatically
                Sentinel::login($user, false);

            } catch (UserExistsException $e) {
                //$this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
                return Redirect::back()->with('error', 'Account creation failed');
            }

        }

        $user = Sentinel::getUser();

        //if no contracts quatity seleceted, return to the subscribe page with an error message
        /*if(empty($request->get('subperiod'))){
            return view('user_subscribe', compact('countries', 'user', 'currencyInfo'))->with('error', 'Please select number of contracts');
        }*/
        //get the data
        $subdata = array(
            'category' => $request->get('category'),
            'PAYGATE_ID' => $request->get('PAYGATE_ID'),
            'REFERENCE' => $request->get('REFERENCE'),
            'AMOUNT' => $request->get('AMOUNT'),
            'CURRENCY' => $request->get('CURRENCY'),
            'RETURN_URL' => $request->get('RETURN_URL'),
            'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
            'SUBS_START_DATE' => $request->get('SUBS_START_DATE'),
            'SUBS_FREQUENCY' => $request->get('SUBS_FREQUENCY'),
            'SUBS_END_DATE' => $request->get('SUBS_END_DATE'),
            'PROCESS_NOW' => $request->get('PROCESS_NOW'),
            'VERSION' => $request->get('VERSION'),
            'PROCESS_NOW_AMOUNT' => $request->get('PROCESS_NOW_AMOUNT'),
            'LOCALE' => $request->get('LOCALE'),
            'COUNTRY' => $request->get('COUNTRY'),
            'standard_category' => $request->get('standard_category'),
            'sub_countryid' => $request->get('sub_countryid'),
            'user' => $user->id,
            'subperiod' => $request->get('subperiod'),
            //'downupgrade' => $request->get('downupgrade'),
        );

        /*$insertSubscription = DB::table('dmmx_account_subscriptions')->insert(
             ['account_type' => $accountType,'account_email' => $accountEmail, 'account_name' => $accountName, 'account_users' => $accountUsers,'subscribed_category' => $accountCategory, 'subscription_country' => $accountCountry, 'account_balance'=> $accountBalance, 'account_status'=> $accountStatus, 'account_payment_status' => $accountPaymentStatus, 'created_at' => $current_time ]
          );*/

        //print_r($subdata);
        return view('requestemployer', compact('subdata', 'user'));


    }

//PAYMENT RESULTS
    public function payresult(Request $request, User $user)
    {
        return view('payresult');
        //echo "it got here";
    }

    public function payresultEmployer(Request $request, User $user)
    {
        return view('payresultemployer');
        //echo "it got here";
    }




    ////////////USER INVITATION//////////////

    /**
     * get invitation form and display
     */
    public function getInvite(User $user)
    {
        $user = Sentinel::getUser();
        //check if user is not on trial
        if (count($user->subscriptions)==0) {
            return Redirect::back()->with('error', 'Admins section is a premium feature, please upgrade to use this feature');
        }
        $countries = $this->countries;
        return view('invitation', compact('user', 'countries'));
    }

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     */
    public function invite(Request $request, User $user)
    {

        //check for the validity of the email
        $validateEmail = Mailgun::validator()->validate($request->email);
        if (!($validateEmail->is_valid)) {
            return Redirect::back()->with('error', 'Please enter a valid email address');
        }

        $user = Sentinel::getUser();

        if ($user->email == $request->email) {
            return Redirect::back()->with('error', 'You cannot add yourself as an admin');
        }
        //Insert data into the subscriptions table
        /*$current_time = date('Y-m-d H:i:s');
        $accountType = $request->get('account_type');
        $accountCountry = $request->get('country');
        $accountName = $request->get('account_name');
        $accountEmail = $user->email;
        $accountUsers = $request->get('account_users');
        $accountCategory = $request->get('category');
        $accountBalance = '0';
        $accountStatus = '1'; //This field should be a boolean
        $accountPaymentStatus = 'unpaid'; //This field should be a boolean as well

        $insertSubscription = DB::table('dmmx_account_subscriptions')->insert(
             ['account_type' => $accountType,'account_email' => $accountEmail, 'account_name' => $accountName, 'account_users' => $accountUsers,'subscribed_category' => $accountCategory, 'subscription_country' => $accountCountry, 'account_balance'=> $accountBalance, 'account_status'=> $accountStatus, 'account_payment_status' => $accountPaymentStatus, 'created_at' => $current_time ]
          );*/
        $getAdminsCredits = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->value('admins_avail');
        if ($getAdminsCredits == 0) {
            return Redirect::back()->with('error', 'You have exhausted your admins limit, please upgrade your package');
        }

        $subscriptionRow = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->get();

        //first check if the admin tokens are available

        //create admin row
        //check if the invitation has not been sent already
        $checkEmail = DB::table('dmmx_admins_table')->where([['email', $request->email], ['userid', $user->id]])->first();
        if (!$checkEmail) {
            $account_number = $this->generateAccNumber("A");
            $addAdmin = DB::table('dmmx_admins_table')->insert(
                ['userid' => $user->id, 'first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'status' => 'request sent', 'admin_group' => '-', 'subscriptionid' => $subscriptionRow[0]->id, 'created_at' => date('Y-m-d H:i:s'), 'acc_no' => $account_number]
            );
        } else {
            return Redirect::back()->with('error', 'Invitation sent already');
        }

        //if uadmin added
        if ($addAdmin) {
            //subtract one from the admins
            DB::table('dmmx_paysubscriptions')->where('id', $subscriptionRow[0]->id)->update(['admins_avail' => ($subscriptionRow[0]->admins_avail) - 1]);
            //send invitation email
            if(getenv('GAE_INSTANCE', true) === false) {
            Mail::to($request->email)->send(new AdminsMail($user, $request));
            } else {
                Mail::to($request->email)->send(new AdminsMail($user, $request));
            }

            //return with a success message
            return Redirect::back()->with('success', 'admin added');
        } else {
            // return with error message
            return Redirect::back()->with('error', 'admin could not be added');
        }


    }

    //Go to all reviews page
    public function getAllRatings()
    {
        $ratingsCounter = DB::table('dmmx_ratings')->count();
        return view('allratings', compact('ratingsCounter'));
    }

    ////////////USER INVITATION//////////////

    /**
     * get invitation form and display
     */
    public function getRatingForm()
    {
        $user = Sentinel::getUser();
        $allIdsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
        $idsWatchedArray = array();
        foreach ($allIdsWatched as $singleid) {
            array_push($idsWatchedArray, $singleid->employeeid);
        }
        return view('ratingcreate', compact('idsWatchedArray'));
    }

    public function getPrivateRatingForm()
    {
        $user = Sentinel::getUser();
        $allIdsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
        $idsWatchedArray = array();
        foreach ($allIdsWatched as $singleid) {
            array_push($idsWatchedArray, $singleid->employeeid);
        }
        return view('private-ratingscreate', compact('idsWatchedArray'));
    }

    public function submitSelfRating(Request $request, User $user)
    {
        $user = Sentinel::getUser();
        $yourID = $request->get('yourID');
        $taskTitle = $request->get('taskTitle');
        $taskDescribe = $request->get('taskDescribe');
        $starRating = $request->get('starRating');
        $createdOn = date('Y-m-d H:i:s');
        $incidentTime = $request->get('datetime3');
        $userId = $user->id;
        $userFirstName = $user->first_name;
        $userLastName = $user->last_name;

        $insertRating = DB::table('dmmx_self_ratings')->insert(
            ['userid' => $userId, 'employeeid' => $yourID, 'first_name' => $userFirstName, 'last_name' => $userLastName, 'task_title' => $taskTitle, 'task_description' => $taskDescribe, 'stars' => $starRating, 'incident_time' => $incidentTime, 'created_at' => $createdOn]
        );
        //$getRatingID = DB::table('dmmx_ratings')->where('created_at', $createdOn)->value('id');

        $insertActivity = DB::table('dmmx_recent_activities')->insert(
            ['creator_id' => $user->id, 'title' => 'Self Rating', 'creator_name' => $user->userFirstName . " " . $user->userLastName, 'activity_kind' => 'rating', 'summary' => substr($taskDescribe, 0, 20), 'link' => 'private-ratings/single/1', 'created_at' => $createdOn]
        );

        if ($insertRating) {
            return Redirect::back()->with('success', 'Rating was successfully created');
        } else {
            return Redirect::back()->with('error', 'Rating add failed, please try again');
        }

    }

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     */
    public function submitRating(Request $request, User $user)
    {
        $user = Sentinel::getUser();
        //Get and process the recieved data
        $employeeID = $request->get('employeeID');

        //Check if the employer has rights to rate this employee
        $idsWatched = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeeID], ['watchstatus', 'active']])->first();

        if ($idsWatched) {
            $user = Sentinel::getUser();
            $ratingTitle = $request->get('ratingTitle');
            $experienceDescribe = $request->get('experienceDescribe');
            $starRating = $request->get('starRating');
            $datetime3 = $request->get('datetime3');
            $ratedTerms = $request->get('ratedTerms');
            $createdOn = date('Y-m-d H:i:s');
            $ratedCategory = $request->get('ratedCategory');
            $companyName = 'Test company';
            //Get the name of the person being rated
            $employeeID = $request->get('employeeID');
            $ratedemployeeData = DB::table('dmmx_employees')->where('idnumber', $employeeID)->first();
            $ratedFirstName = $ratedemployeeData->first_name;
            $ratedLastName = $ratedemployeeData->last_name;
            //Get the name of the email of the employee
            $ratedEmail = $ratedemployeeData->email;

            $insertRating = DB::table('dmmx_ratings')->insert(
                ['rated_fullname' => $ratedFirstName . " " . $ratedLastName, 'contact_confirm' => $ratedTerms, 'rated_type' => '', 'rated_title' => $ratingTitle, 'experience_description' => $experienceDescribe, 'stars' => $starRating, 'company' => $companyName, 'rater_id' => $employeeID, 'incident_time' => $datetime3, 'rated_email' => $ratedEmail, 'created_at' => $createdOn]
            );
            //$getRatingID = DB::table('dmmx_ratings')->where('created_at', $createdOn)->value('id');

            $insertActivity = DB::table('dmmx_recent_activities')->insert(
                ['creator_id' => $user->id, 'title' => 'Rating created', 'creator_name' => $user->first_name . " " . $user->last_name, 'activity_kind' => 'rating', 'summary' => substr($experienceDescribe, 0, 20), 'link' => 'all-ratings/single/' . $ratedemployeeData->id, 'created_at' => $createdOn]
            );

            if ($insertRating) {
                return Redirect::back()->with('success', 'Rating was successfully created');
            } else {
                return Redirect::back()->with('error', 'Rating add failed, please try again');
            }
        } else {
            return Redirect::back()->with('error', 'The employee is not on your watch list, please go to dashboard and add this employee to your watch list');
        }


    }

    public function rating()
    {
        return view('ratingcreate');
    }

    public function dashboard()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

        $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();

        //if the user is supporting admin, grab the idswatched from the super admin account
        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $adminRow->userid)->get();
        }

        $subscriptionPackageDAta = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

        //if the user is supporting admin, grab the subscriptionPackageDAta from the super admin account
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $subscriptionPackageDAta = DB::table('dmmx_paysubscriptions')->where('userid', $adminRow->userid)->first();
        }

        $idsWatchedArray = array();
        foreach ($idsWatched as $singleid) {
            array_push($idsWatchedArray, $singleid->employeeid);
        }

        //Ratings to plot
        $ratings2Plot = DB::table('daily_employees_quantity')->where('userid', $user->id)->take(12)->orderBy('id', 'desc')->get();

        $employeesWatchedList = DB::table('dmmx_employees')->whereIn('idnumber', $idsWatchedArray)->get()->take(4);

        return view('dashboard', compact('user', 'employeesWatchedList', 'subscriptionPackageDAta', 'ratings2Plot', 'invoices'));
    }

    public function myemployees()
    {

        session_name("Checked_id_session");
        session_start();
        //print_r($_SESSION['checkedids']);
        //die;

        $ratingsCounter = DB::table('dmmx_ratings')->count();
        $user = Sentinel::getUser();
        /*$AllEmployeesData = DB::table('dmmx_employees')->get();
        foreach($AllEmployeesData as $employeesData){
            //get whatch status for the current employee and add it
            $employeesData->watchstatus = 'pending';
        }
        print_r($AllEmployeesData);
        die;*/
        $subscriptionPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();


        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        //if the user is supporting admin, grab the subscriptionPackageDAta from the super admin account
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $subscriptionPackage = DB::table('dmmx_paysubscriptions')->where('userid', $adminRow->userid)->first();
        }

        return view('myemployees', compact('ratingsCounter', 'subscriptionPackage'));
    }

    public function admins()
    {
        $user = Sentinel::getUser();
        //check if user is not on trial
        if (count($user->subscriptions)==0) {
            return Redirect::back()->with('error', 'Admins section is a premium feature, please upgrade to use this feature');
        }

        $ratingsCounter = DB::table('dmmx_ratings')->count(); //this hould be removed
        return view('admins', compact('ratingsCounter'));
    }

    public function contractgenerate()
    {
        //get all the id numbers from the database for the purpose of performing autosuggest
        $allIds = DB::table('dmmx_employees')->select('idnumber')->get();
        return view('contractgenerate', compact('allIds'));
    }

    public function getdatabyID()
    {
        //get all the id numbers from the database for the purpose of performing autosuggest
        $employeeInfo = DB::table('dmmx_employees')->where('idnumber', $_POST['employeeID'])->get();
        return response()->json($employeeInfo);
    }

    public function submitcontractgenerate(Request $request, User $user)
    {
        $user = Sentinel::getUser();
        $employeeCheck = DB::table('dmmx_employees')->where('email', '=', $request->email)->count();
        //||||everything below should happen if the user has got enough balance to perform||||\\
        //check if the user has got enough credits to perform this function
        $getEMployeesCredits = DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->value('employees_avail');
        if ($getEMployeesCredits == 0) {
            return Redirect::back()->with('error', 'You do not have enough employees credits to perform this action. Your employees credits is ' . $getEMployeesCredits);
        }

        //Insert the data into the table
        //Check if the user exists first
        $existsEmployee = DB::table('dmmx_employees')->where('idnumber', $request->employeeID)->first();
        if ($existsEmployee) {
            //return with a message saying employee with the ID already exists
            //return Redirect::back()->with('error', 'Someone with the same ID already exist in the system');
            $employeeData = DB::table('dmmx_employees')->where('idnumber', $request->employeeID)->first();
            //Check if the company is not already watching the employee
            $alreadyWatching = 0;
            $companiesWatching = unserialize($employeeData->watchingcompanies);
            /*foreach($companiesWatching as $companyWatching){
                if($companyWatching['id'] == $user->id){
                    $alreadyWatching = 1;
                }*/
            //Do company whatch check
            $user = Sentinel::getUser();
            $companyWatchCheck = DB::table('dmmx_employees_watch')->where([['employeeid', '=', $request->employeeID], ['companyid', '=', $user->id]])->first();
            if ($companyWatchCheck) {
                $alreadyWatching = 1;
            }
            //print_r($companyWatching);
            if ($alreadyWatching) {
                return Redirect::back()->with('error', 'You are already watching this employee, check your employees for the status of this employee');
            } else {
                $user = Sentinel::getUser();
                $checkIfInserted = DB::table('dmmx_employees_watch')->insert(['employeeid' => $request->employeeID, 'companyid' => $user->id, 'companyname' => '', 'watchstatus' => 'pending approval', 'created_at' => date('Y-m-d H:i:s')]);
                if ($checkIfInserted) {
                    //subtract 1 from employees available
                    //subtract one from the admins
                    DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail');
                    //send the employee notification email of the request
                }
                //create an activity
                $insertActivity = DB::table('dmmx_recent_activities')->insert(
                    ['creator_id' => $user->id, 'title' => 'Contract Generated', 'creator_name' => $user->first_name . " " . $user->last_name, 'activity_kind' => 'Contract Generation', 'summary' => 'Contract was generated, approval pending', 'link' => 'consentmanagement', 'created_at' => date('Y-m-d H:i:s')]
                );

                //DB::table('dmmx_employees')->where('id', $employeeData ->id)->update();
                return view('contractprint', compact('employeeData'));
            }
        } else {
            //Subtract one contract quantity form the contracts. If no contract, no subscription
            $insertEmployee = DB::table('dmmx_employees')->insert(
                ['idnumber' => $request->employeeID, 'email' => $request->employeeEmail, 'first_name' => $request->firstname, 'last_name' => $request->lastname, 'created_at' => date('Y-m-d H:i:s'), 'authoritiesverified' => 'no']
            );

            if ($insertEmployee) {
                //subtract 1 from employees available
                DB::table('dmmx_paysubscriptions')->where('id', $user->permissions2)->decrement('employees_avail');
                //send the employee notification email of the request

                $employeeData = DB::table('dmmx_employees')->where('idnumber', $request->employeeID)->first();
                $user = Sentinel::getUser();
                DB::table('dmmx_employees_watch')->insert(['employeeid' => $request->employeeID, 'companyid' => $user->id, 'companyname' => '', 'watchstatus' => 'pending approval', 'created_at' => date('Y-m-d H:i:s')]);
                //create an activity
                $insertActivity = DB::table('dmmx_recent_activities')->insert(
                    ['creator_id' => $user->id, 'title' => 'Contract Generated', 'creator_name' => $user->first_name . " " . $user->last_name, 'activity_kind' => 'Contract Generation', 'summary' => 'Contract was generated', 'link' => 'consentmanagement', 'created_at' => date('Y-m-d H:i:s')]
                );
                DB::table('dmmx_employees')->where('idnumber', $request->employeeID)->update(['watchingcompanies' => '']);
                return view('contractprint', compact('employeeData'));
            } else {
                //redirect with an error message (this should just go to contract print with the user's details)
                return Redirect::back()->with('error', 'Employee addition failed');
            }
        }
    }

    private $pdf;

    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

    public function contractprint(Request $request, User $user)
    {
        $user = Sentinel::getUser();
        //print the contract
        //echo "printing the contract";
        $html = view('contractpdf', compact('user', 'request'))->render();

        return $this->pdf
            ->load($html)
            ->show();
    }

    public function employeesdata(User $user)
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //Get IDs of people being watched by the company
        $user = Sentinel::getUser();

        //This should be a selection of only those columns the company requested to watch them
        $employeesWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();

        //if the user is supporting admin, grab the employeesWatched from the super admin account
        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $employeesWatched = DB::table('dmmx_employees_watch')->where('companyid', $adminRow->userid)->get();
        }


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
            if (count($checkIfAdmin) > 0) {
                $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                $employeeWatchRow = DB::table('dmmx_employees_watch')->where([['companyid', $adminRow->userid], ['employeeid', $employeesData->idnumber]])->first();
                $employeesData->watchstatus = $employeeWatchRow->watchstatus;
            } else {
                $employeeWatchRow = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['employeeid', $employeesData->idnumber]])->first();
                $employeesData->watchstatus = $employeeWatchRow->watchstatus;
            }

        }


        return Datatables::of($AllEmployeesData)
            ->add_column('checkbox', function ($employee) {
                //get the watch status for this employee
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

                if (count($checkIfAdmin) > 0) {
                    $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $adminRow->userid], ['employeeid', '=', $employee->idnumber]])->first();
                } else {
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                }

                if ($getStatus->watchstatus == 'Pending') {
                    $checkbox = '<input class="checkbox-select" type="checkbox" data-boxclass="0" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                }
                if ($getStatus->watchstatus == 'No start date') {
                    $checkbox = '<input class="checkbox-select" type="checkbox" data-boxclass="1" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                }
                if ($getStatus->watchstatus == 'Active') {
                    $checkbox = '<input class="checkbox-select" type="checkbox" data-boxclass="2" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                }
                if ($getStatus->watchstatus == 'Expired') {
                    $checkbox = '<input class="checkbox-select" type="checkbox" data-boxclass="3" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                }
                if ($getStatus->watchstatus == 'Past employee') {
                    $checkbox = '<input class="checkbox-select" type="checkbox" data-boxclass="4" data-checkboxid=' . $employee->id . ' class="striked " autocomplete="off" />';
                }
                return $checkbox; 
            })
            ->add_column('actions', function ($employee) {
                //get the watch status for this employee
                $user = Sentinel::getUser();
                $employees_class = new EmployeesRepository;
                $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

                if (count($checkIfAdmin) > 0) {
                    $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $adminRow->userid], ['employeeid', '=', $employee->idnumber]])->first();
                } else {
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                }


                if ($getStatus->watchstatus == 'Pending') {
                    $actions = '<a href=' . route('employees.contract', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This moves the prospect/employee to contract">Contract</i></a>';
                }
                if ($getStatus->watchstatus == 'No start date') {
                    if ($getStatus->consent_granted == 1) {
                        $actions = '<a data-toggle="modal" class="add_start_date" data-target="#add_start_date" href="#" data-employeeid=' . $employee->id . '>Add start date</a>' . ' | ' . '<a data-toggle="modal" href=' . route('employees.employee.view', $employee->id) . ' data-employeeid=' . $employee->id . '>Profile</a>' . ' | ' . '<a href= ' . route('viewcontract', $employee->id) . ' target="_blank" class="">View SLIP</a>' .' | ' .'<a href=' . route('delete-employee-slip', $employee->idnumber) . '>Delete</a>';
                    } else {
                        $actions = '<a data-toggle="modal" class="add_start_date" data-target="#add_start_date" href="#" data-employeeid=' . $employee->id . '>Add start date</a>' . ' | ' .'<a data-toggle="modal" class="consent_obtained" data-target="#consent_obtained" href="#" data-employeeid=' . $employee->id . '>Consent</a>' . ' | ' . '<a href= ' . route('viewcontract', $employee->id) . ' target="_blank" class="">View SLIP</a>';

                        //check if the employee is watched by one company
                        $countWatchingCompanies = $employees_class->countWatchingCompanies($employee->idnumber);
                        if($countWatchingCompanies == 1){
                          $actions .= ' | ' .'<a href=' . route('delete-employee-slip', $employee->idnumber) . '>Delete</a>';
                          $actions .= ' | ' .'<a href=' . route('edit-employee', $employee->idnumber) . '>Edit</a>';
                        }

                    }
                }
                if ($getStatus->watchstatus == 'Active') {
                    if ($getStatus->consent_granted == 1) {
                        $actions = '<a data-toggle="modal" class="add_end_date" data-target="#add_end_date" href="#" data-employeeid=' . $employee->id . '>Add end date</a>' . ' | ' . '<a data-toggle="modal" href=' . route('employees.employee.view', $employee->id) . ' data-employeeid=' . $employee->id . '>Profile</a>' . ' | ' . '<a href= ' . route('viewcontract', $employee->id) . ' target="_blank" class="">View SLIP</a>';
                    } else {
                        $actions = '<a data-toggle="modal" class="consent_obtained" data-target="#consent_obtained" href="#" data-employeeid=' . $employee->id . '>Consent</a>' .' | ' . '<a href= ' . route('viewcontract', $employee->id) . ' target="_blank" class="">View SLIP</a>';
                    }
                }
                if ($getStatus->watchstatus == 'Expired') {
                    if ($getStatus->consent_granted == 1) {
                        $actions = '<a href=' . route('employees.delete', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This deletes the prospect/employee">Delete</i></a>' . ' | ' . '<a data-toggle="modal" href=' . route('employees.employee.view', $employee->id) . ' data-employeeid=' . $employee->id . '>Profile</a>';
                    } else {
                        $actions = '<a data-toggle="modal" class="consent_obtained" data-target="#consent_obtained" href="#" data-employeeid=' . $employee->id . '>Consent</a>';
                    }
                }
                if ($getStatus->watchstatus == 'Past employee') {
                    $actions = '<a data-toggle="modal" href=' . route('employees.employee.view', $employee->id) . ' data-employeeid=' . $employee->id . '>Profile</a>' . ' | ' . '<a href=' . route('employees.delete', $employee->id) . '>Delete</a>';
                }

                return $actions;
            })
            ->add_column('watchstatus', function ($employee) {
                //Check the status associated with the company

                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();

                $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

                if (count($checkIfAdmin) > 0) {
                    $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $adminRow->userid], ['employeeid', '=', $employee->idnumber]])->first();
                } else {
                    $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                }

                $actions = $getStatus->watchstatus;
                //Translate the watch status 
                if($getStatus->watchstatus == "No start date"){
                    $actions = "SLIP";
                }
                /*if($getStatus->watchstatus == "Expired"){
                    $actions = "Inactive";
                }*/
                //}
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    public function generatescoresState($metric, $company_score){
           $actions = '';
           if($metric->item == "Tick box"){
                         if(isset($company_score->checked_unchecked) && $company_score->checked_unchecked){
                            $actions = '<input class="checkbox-select" type="checkbox" data-boxclass="1" data-checkboxid=' . $metric->id . ' class="striked " autocomplete="off" checked disabled/>';
                         }else{
                             $actions = '<input class="checkbox-select" type="checkbox" data-boxclass="1" data-checkboxid=' . $metric->id . ' class="striked " autocomplete="off" disabled/>';
                         }
                     }
                      if($metric->item == "Date" || $metric->item == "Text"){
                         if(isset($company_score->checked_unchecked)){
                            $actions = '<p>' .$company_score->checked_unchecked .'<p/>';
                         }else{
                             $actions = '';
                         }
                     }

                     if($metric->item == "Radiobutton"){
                         if($company_score->checked_unchecked){
                            $actions = '<p>' .$company_score->checked_unchecked .'<p/>';
                         }else{
                             $actions = '';
                         }
                     }

            return $actions;
    }

    public function commencementData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Commencement')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }

    public function employmentData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Employment')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }

    public function terminationData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Termination')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }

    public function timeData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Time')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }


    public function growthData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Growth')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }

    public function performanceData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Performance')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }

    public function traitsData()
    {
        $user = Sentinel::getUser();
        /*echo $user->reachedCritical();
        die;*/
        //get companies that scored the employee;

        $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();

        if (count($checkIfAdmin) > 0) {
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $userID = $adminRow->userid;
        } else {
            $userID = $user->id;
        }

        $user = DB::table('users')->where('id', $userID)->first();

            $employeeid = $_GET['employeeId'];
            $metrics = Metrics::where('metric_section', 'Traits')->where('display_field', '1');
            //companies that used the metric and their score
            foreach($metrics as $metric){
                $metric->attach('company_score', '1');
                //$company_scores = array();
            }

             return Datatables::of($metrics)
            ->add_column('actions', function ($metric) {
                //get the watch status for this employee
                $actions = '<a class="add_end_date" href="#">View Details</a>' .' <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Click to view the score details"></span>';
                return $actions;
            })
            //->foreach()
            ->add_column('company1', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[0])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[0]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company2', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[1])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[1]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company3', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[2])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[2]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company4', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[3])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[3]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company5', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset($companies_that_scored_employee[4])){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[4]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
             /*->add_column('company6', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[5]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[5]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })
            ->add_column('company7', function ($metric) {
                $companyids_that_scored_employee = Scores::where('employee_id', $_GET['employeeId'])->distinct()->pluck('scorer_id');
                $companies_that_scored_employee = User::whereIn('id', $companyids_that_scored_employee->toArray())->get();
                $actions = '';
                if(isset(($companies_that_scored_employee[6]))){
                   $company_score =  Scores::where('employee_id', $_GET['employeeId'])->where('scorer_id', $companies_that_scored_employee[6]->id)->where('metric_id', $metric->id)->first();
                    //get the data display depending on the metric type and the score state
                     $actions = $this->generatescoresState($metric, $company_score);
                 }

                return $actions;
            })*/
            ->rawColumns(['actions', 'company1', 'company2', 'company3', 'company4', 'company5', 'company6', 'company7'])
            ->make(true);


    }



    public function adminsdata()
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //Get IDs of people being watched by the company
        $user = Sentinel::getUser();

        //Get all the admins watched invited by the user
        $adminsInvited = DB::table('dmmx_admins_table')->where('userid', $user->id)->get();

        return Datatables::of($adminsInvited)
            ->add_column('actions', function ($admin) {

                return '<a href=' . route('admins.remove', $admin->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" data-toggle="tooltip" title="This removes the prospect/employee">Remove</i></a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function removeAdmin($adminId)
    {
        //get the user
        $user = Sentinel::getUser();
        $adminData = DB::table('dmmx_admins_table')->where('id', $adminId)->first();

        //check if the employee has accepted the request yet
        if ($adminData->first_name == "-") {
            //delete the admin from admins table only

            $addUsersHistory = DB::table('dmmx_admins_table_history')->insert(
                ['userid' => $adminData->id, 'email' => $adminData->userid, 'first_name' => $adminData->first_name, 'last_name' => $adminData->last_name, 'email' => $adminData->email, 'status' => $adminData->status, 'admin_group' => $adminData->admin_group, 'subscriptionid' => $adminData->subscriptionid, 'created_at' => $adminData->created_at, 'updated_at' => date('Y-m-d H:i:s')]);

            //delete the admin from admins table
            $deleteRequest = DB::table('dmmx_admins_table')->where('id', $adminData->id)->delete();


            return Redirect::back()->with('success', 'Successfully removed');
        }

        //change the admin's status from active to inactive
        DB::table('users')->where('email', $adminData->email)->update(['active' => 0]);


        $addUsersHistory = DB::table('dmmx_admins_table_history')->insert(
            ['userid' => $adminData->id, 'email' => $adminData->userid, 'first_name' => $adminData->first_name, 'last_name' => $adminData->last_name, 'email' => $adminData->email, 'status' => $adminData->status, 'admin_group' => $adminData->admin_group, 'subscriptionid' => $adminData->subscriptionid, 'created_at' => $adminData->created_at, 'updated_at' => date('Y-m-d H:i:s')]);

        //delete the admin from admins table
        $deleteRequest = DB::table('dmmx_admins_table')->where('id', $adminData->id)->delete();

        //delete the user associated with this admin
        $deleteUser = DB::table('users')->where('email', $adminData->email)->delete();

        if ($deleteRequest && $addUsersHistory) {
            //notify the user by email
            if(getenv('GAE_INSTANCE', true) === false) {
            Mail::to($adminData->email)->queue(new AdminsRemoveMail($user));
            } else {
                Mail::to($adminData->email)->send(new AdminsRemoveMail($user));
            }
            return Redirect::back()->with('success', 'Successfully removed');
        }

    }


    public function singleemployeedata()
    {
        $user = Sentinel::getUser();

        //This should be a selection of only those columns the company requested to watch them
        $employeeFullData = DB::table('dmmx_ratings')->where('rater_id', $_GET['employeeID'])->get();

        return Datatables::of($employeeFullData)
            ->add_column('actions', function ($employeeData) {
                $actions = '<a href="mailto:' . $employeeData->rated_email . '">Email Me</a> ';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function cancelWatchRequest()
    {
        return view('home');
    }

    public function consentmanagement()
    {
        $ratingsCounter = DB::table('dmmx_ratings')->count();
        return view('consentmanagement', compact('ratingsCounter'));
    }

    public function consentmanagementData(User $user)
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //Get IDs of people being watched by the company
        $user = Sentinel::getUser();

        //This should be a selection of only those columns the company requested to watch them and have status being "pending"
        $employeesWatched = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'pending approval']])->get();
        $employeesWatchedArray = array();
        foreach ($employeesWatched as $singleid) {
            array_push($employeesWatchedArray, $singleid->employeeid);
        }
        if ($employeesWatched) {
            $AllEmployeesData = DB::table('dmmx_employees')->whereIn('idnumber', $employeesWatchedArray)->get(['id', 'idnumber', 'email', 'permissions2', 'last_login', 'first_name', 'last_name', 'bio', 'gender', 'dob', 'pic', 'country', 'state', 'city', 'address', 'postal', 'authoritiesverified', 'lastknownaddresses', 'lastknowncontactnumbers', 'lastknownemployers', 'watchingcompanies', 'created_at', 'updated_at']);
        }

        return Datatables::of($AllEmployeesData)
            ->add_column('actions', function ($employee) {
                //get the watch status for this employee
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid', '=', $user->id], ['employeeid', '=', $employee->idnumber]])->first();
                if ($getStatus->watchstatus == 'pending approval') {
                    $actions = '<a href=' . route('employees.consentmanagement.approve', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Change Request Status to Active">Approved</i></a>';
                } else {
                    $user = Sentinel::getUser();
                    $actions = '';
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
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function consentmanagementApprove($employeeId)
    {
        //echo "consent approved";
        //get the employee's id number
        $user = Sentinel::getUser();
        $employeeDetails = DB::table('dmmx_employees')->where('id', $employeeId)->first();
        $updateWatchStatus = DB::table('dmmx_employees_watch')->where([['employeeid', $employeeDetails->idnumber], ['companyid', $user->id]])->update(['watchstatus' => 'active']);

        //create activity
        $insertActivity = DB::table('dmmx_recent_activities')->insert(
            ['creator_id' => $user->id, 'title' => 'Employee Watch Approved', 'creator_name' => $user->first_name . " " . $user->last_name, 'activity_kind' => 'Watch Approval', 'summary' => 'You can start rating the employee', 'link' => 'create-rating', 'created_at' => date('Y-m-d H:i:s')]
        );

        if ($updateWatchStatus) {
            return Redirect::back()->with('success', 'Employee Watch status has been updated to active');
        } else {
            return Redirect::back()->with('error', 'Employee watch status update failed');
        }
    }

    public function verifyaccount()
    {
        $ratingsCounter = DB::table('dmmx_ratings')->count();
        return view('verifyaccount', compact('ratingsCounter'));
    }

    public function verifyaccountData(User $user)
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //Get IDs of people being watched by the company
        $user = Sentinel::getUser();

        //This should be a selection of only those columns the company requested to watch them and have status being "pending"
        $employeesWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
        $employeesWatchedArray = array();
        foreach ($employeesWatched as $singleid) {
            array_push($employeesWatchedArray, $singleid->employeeid);
        }
        if ($employeesWatched) {
            $AllEmployeesData = DB::table('dmmx_employees')->where('authoritiesverified', 'no')->whereIn('idnumber', $employeesWatchedArray)->get(['id', 'idnumber', 'email', 'permissions2', 'last_login', 'first_name', 'last_name', 'bio', 'gender', 'dob', 'pic', 'country', 'state', 'city', 'address', 'postal', 'authoritiesverified', 'lastknownaddresses', 'lastknowncontactnumbers', 'lastknownemployers', 'watchingcompanies', 'created_at', 'updated_at']);
        }

        return Datatables::of($AllEmployeesData)
            ->add_column('actions', function ($employee) {
                if ($employee->authoritiesverified == 'no') {
                    $actions = '<a href=' . route('employees.employeesverification.verify', $employee->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Verify the employee">verify</i></a>';
                } else {
                    $actions = '';
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
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function verifyemployee($employeeID)
    {
        //echo "verify the employee";
        return Redirect::back()->with('error', 'The verification API is not yet hooked');
    }

    public function pricing($lang = null)
    {
        $util = new Util();
        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!Session::has('nav_section')) {
            Session::put('nav_section', 'business');
        }

        $countryPrices = Cache::remember('country_prices', 60, function () {
            return DB::table('dmmx_country_prices')->get();
        });

        $currencyInfo = Cache::remember('currency_info', 60, function () {
            return DB::table('currency')->get();
        });

        $packages = Cache::remember('packages', 60, function () {
            return DB::table('packages')->get();
        });

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            //die;

            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international

                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/pricing');
                }
                return $util->moddedRedirect($ip_locale . '/business/pricing');
            }

            return $util->moddedRedirect($ip_locale . '/staff');
        }

        return View::make('pricing', compact('packages', 'currencyInfo', 'countryPrices'));
    }

    public function loademployees()
    {
        $user = Sentinel::getUser();
        $subscriptionPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

        //check if compay is verified 
        $verification_docs_status = CompanyVerifyRepository::companyVerified($user->id); 
        
        return view('loademployees', compact('subscriptionPackage', 'verification_docs_status', 'user'));
    }

    public function getfeatures($package)
    {
        //return view('features');
        $activitiesCount = DB::table('dmmx_recent_activities')->count();
        $activities = DB::table('dmmx_recent_activities')->take(8)->get();
        $countryPrices = DB::table('dmmx_country_prices')->get();
        $currencyInfo = DB::table('currency')->get();
        $user = Sentinel::getUser();

        //checking if the user is an employee
        if (!empty($user)) {

            $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
            $subscriptionPackageDAta = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
            $idsWatchedArray = array();
            foreach ($idsWatched as $singleid) {
                array_push($idsWatchedArray, $singleid->employeeid);
            }

            //Ratings to plot
            $ratings2Plot = DB::table('dmmx_ratings')->whereIn('rater_id', $idsWatchedArray)->take(30)->get();

            $employeesWatchedList = DB::table('dmmx_employees')->whereIn('idnumber', $idsWatchedArray)->get(['id', 'idnumber', 'email', 'permissions2', 'last_login', 'first_name', 'last_name', 'bio', 'gender', 'dob', 'pic', 'country', 'state', 'city', 'address', 'postal', 'authoritiesverified', 'lastknownaddresses', 'lastknowncontactnumbers', 'lastknownemployers', 'watchingcompanies', 'created_at', 'updated_at'])->take(4);

            return view('features', compact('user', 'employeesWatchedList', 'subscriptionPackageDAta', 'ratings2Plot', 'package'));
        } else {
            return view('features', compact('activitiesCount', 'activities', 'countryPrices', 'currencyInfo', 'package'));
        }

    }

    //get user's ip address
    public function get_ip_address()
    {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if ($this->validate_ip($ip))
                        return $ip;
                }
            } else {
                if ($this->validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    public function validate_ip($ip)
    {
        if (strtolower($ip) === 'unknown')
            return false;

        // generate ipv4 network address
        $ip = ip2long($ip);

        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }

    public function GetIpLocale()
    {

        $ip2location = new GetIpLocale();

        $returned_locale = $ip2location->get_locale();

        return $returned_locale;

    }

    public function crawlerCheck()
    {
        $CrawlerDetect = new CrawlerDetect;
        $crawlerCheck = $CrawlerDetect->isCrawler();
        return $crawlerCheck;
    }

    public function indexBoth($lang = null, Request $request)
    {
        $util = new Util();

        // echo  App::getLocale();
        $ip_locale = $this->GetIpLocale();
        $autodetected_locale = Session::has('autodetected_locale');
        //check if session set
        if (!$autodetected_locale) {
            Session::put('autodetected_locale', 1);
        }

        if ($lang) {
            //if the language is a part of the links in the prefix, redirect to the link
            if (in_array($lang, ["home", "employees", "pricing", "support", "aboutus", "terms-and-conditions", "faq", "contacts", "branches", "privacy", "benefits", "news", "partner-with-us", "business/pay-package"])) {
                return $util->moddedRedirect($ip_locale . "/$lang");
            }

            //set the locale
            session(['custom_lang' => $lang]);
            App::setLocale($lang);

        } else {
            App::setLocale("en");
            session(['custom_lang' => '']);
        }

        $user = Sentinel::getUser();

        /*$emailA = 'dev14@dmm.co.za';
        $curlTest = $this->callURL('https://api.mailgun.net/v3/address/validate', $emailA);
        print_r($curlTest);*/
        /*$validateEmail = Mailgun::validator()->validate("philip@gmail.com");
        print_r($validateEmail);
        echo "validity is: " .$validateEmail->is_valid;
        die;*/

        //checking if the user is an employee
        /* if (!empty($user)) {

             $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();

             //if the user is supporting admin, grab the idswatched from the super admin account
             $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email], ['status', 'Active']])->get();
             if (count($checkIfAdmin) > 0) {
                 $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
                 $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $adminRow->userid)->get();
             }


             $idsWatchedArray = array();
             foreach ($idsWatched as $singleid) {
                 array_push($idsWatchedArray, $singleid->employeeid);
             }

             //redirect to the dashboard

             return Redirect::route('dashboard');
         } else {*/

        //get ip country based on ip address
        $ipaddress = $this->get_ip_address();


        if ($ipaddress !== "::1") {
            $records = IP2LocationLaravel::get($ipaddress);
            $locale = strtolower($records['countryCode']);
            if (!Session::has('locale')) {
                App::setLocale($locale);
            }
        }

        Session::put('nav_section', 'business');

        if (!$lang) {
            //return redirect('/' . $ip_locale);
            if (!$this->crawlerCheck()) {
                return $util->moddedRedirect($ip_locale . '/business');
            }
            return Response::view('indexboth')->header('Cache-control', 'max-age=86400');
        } else {//locale specified => locale specified
            //die( $ip_locale);
            // return redirect('/'. $lang);
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business');
                }
                return $util->moddedRedirect('en/business');
            }

            //check if robot or not
            if (!$this->crawlerCheck() && (!Session::has('home_redirected') || session('home_redirected') == 0)) {
                Session::put('home_redirected', 1);
                return $util->moddedRedirect($lang . '/business');
            } else {
                Session::put('home_redirected', 0);
                return Response::view('indexboth')->header('Cache-control', 'max-age=86400');
            }
        }
        //}
    }

    /**
     * @param $string
     * @return bool
     */
    public function partOfOurLocales($string)
    {
        return in_array($string, ["en", "au", "ca", "ie", "nz", "za", "uk", "us"]);
    }

    public function faq($lang = null)
    {
        $util = new Util();

        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }


        if (\Route::current()->getName() == 'business.faq') {
            Session::put('nav_section', 'business');
        } else {
            Session::put('nav_section', 'staff');
        }

        $nav_section = Session::get('nav_section');

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/faq');
                }
                return $util->moddedRedirect($ip_locale . '/business/faq');
            }
            return $util->moddedRedirect($ip_locale . '/business/faq');
        }
        return Response::view('faq', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function contacts($lang = null)
    {
        $util = new Util();
        $ip_locale = $this->GetIpLocale();
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            //die;

            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international

                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/contacts');
                }
                return $util->moddedRedirect($ip_locale . '/business/contacts');
            }

            return $util->moddedRedirect($ip_locale . '/business/contacts');
        }
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }
        return Response::view('contacts', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function signup()
    {
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }
        return Response::view('signup', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function support($lang = null)
    {
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }
        return Response::view('support', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function getTsandCs($lang = null)
    {
         $util = new Util();
        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (\Route::current()->getName() == 'business.terms-and-conditions') {
            Session::put('nav_section', 'business');
        } else {
            Session::put('nav_section', 'staff');
        }

        $nav_section = Session::get('nav_section');

         if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/terms-and-conditions');
                }
                return $util->moddedRedirect($ip_locale . '/business/terms-and-conditions');
            }
            return $util->moddedRedirect($ip_locale . '/business/terms-and-conditions');
        }

        return Response::view('termsandconditions', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function aboutus($lang = null)
    {
        $util = new Util();

        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/aboutus');
                }
                return $util->moddedRedirect($ip_locale . '/aboutus');
            }
            return $util->moddedRedirect($ip_locale . '/aboutus');
        }
        return Response::view('aboutus')->header('Cache-control', 'max-age=86400');
    }

    public function benefits($lang = null)
    {
        $util = new Util();

        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international
                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/benefits');
                }
                return $util->moddedRedirect($ip_locale . '/benefits');
            }
            return $util->moddedRedirect($ip_locale . '/benefits');
        }
        return Response::view('benefits')->header('Cache-control', 'max-age=86400');
    }

    public function branches($lang = null)
    {
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }
        return Response::view('branches', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function help($lang = null)
    {
        $util = new Util();
        $ip_locale = $this->GetIpLocale();
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            //die;

            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international

                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/help');
                }
                return $util->moddedRedirect($ip_locale . '/business/help');

            }

            return $util->moddedRedirect($ip_locale . '/business/help');
        }

        if (\Route::current()->getName() == 'business.help') {
            Session::put('nav_section', 'business');
        } else {
            Session::put('nav_section', 'staff');
        }

        $nav_section = Session::get('nav_section');

        return Response::view('help', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

    public function getContact($lang = null)
    {
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        return Response::view('contact')->header('Cache-control', 'max-age=86400');
    }

    public function emailVerified()
    {
        return Response::view('emailverified')->header('Cache-control', 'max-age=86400');
    }

    public function notverified(){
        return Response::view('notverified')->header('Cache-control', 'max-age=86400');
    }

    public function regenerateToken(){
        //check if user
        if(Sentinel::guest()){
            return Redirect::back()->with('error', 'Please login first to regenerate a verification token');
        }

        $user = Sentinel::getUser();

        UserVerification::generate($user);
        UserVerification::send($user, 'StaffLife Token Regenerate');

        return Response::view('tokenregenerated')->header('Cache-control', 'max-age=86400');
    }

    public function trialexpired(){
        return Response::view('trialexpired')->header('Cache-control', 'max-age=86400');
    }

    public function settings($locale=null){
        $user = Sentinel::getUser();
        $currencies = Currencies::all();
    
         if ($locale !== null) {
            //set the locale
            Setting::set('locale', $locale, $user->id);
            Setting::save($user->id);
        }
        App::setLocale(Setting::get('locale', 'en', $user->id));

        //get the currency in the settings 
        $currencySet = Setting::get('currency', 'USD', $user->id);
        $currencyInformation = Currencies::where('code',$currencySet)->first();

        return view('settings', compact('user', 'locale', 'currencies', 'currencyInformation'));
    }

    public function currencySet($currency){
        $user = Sentinel::getUser();
        Setting::set('currency', $currency, $user->id);
        Setting::save($user->id);
        return Redirect::back()->with('success', 'Currency changed to ' .$currency);
    }

    public function postPartner(Request $request){ 

       //if (App::environment('local') || $responseData->success) {
                // Data to be used on the email view
                $data = array(
                    'contact-name' => $request->get('contact-name'),
                    'contact-email' => $request->get('contact-email'),
                    'contact-phone' => $request->get('contact-phone'),
                    'contact-phone' => $request->get('contact-phone'),
                    'optionsRadiosInline' => $request->get('optionsRadiosInline'),
                    'contact-company-name' => $request->get('contact-company-name'),
                    'contact-website' => $request->get('contact-website'),
                    'contact-primary-service' => $request->get('contact-primary-service'),
                    'contact-country' => $request->get('contact-country'),
                    'contact-city' => $request->get('contact-city'),
                    'contact-msg' => $request->get('contact-msg'),
                );

                $validateEmail = Mailgun::validator()->validate($data['contact-email']);
                if (!($validateEmail->is_valid)) {
                    return Redirect::back()->with('error', 'Please enter a valid email address');
                }

                if(!isset($data['contact-name']) || strlen(trim($data['contact-name'])) == 0) {
                    return Redirect::back()->with('error', 'Please enter your name');
                }

                if(!isset($data['contact-msg']) || strlen(trim($data['contact-msg'])) == 0) {
                    return Redirect::back()->with('error', 'Please enter a message to send');
                }

                // Send the activation code through email
                Mail::send('emails.partner', compact('data'), function ($m) use ($data) {
                    $m->from($data['contact-email'], $data['contact-name']);
                    $m->to('info@stafflife.com', @trans('general.site_name'));
                    $m->subject('Received partnership mail from ' . $data['contact-name']);

                });

                //return multi regional thank you page
                return Response::view('thankyoupartner')->header('Cache-control', 'max-age=86400');
            /*} else {
                return Redirect::back()->with('error', 'Robot verification failed. Please try again.')->withInput();
            }*/
    }

    public function partnerWithUs($lang = null){
        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }
        $nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';
        if (!Session::has('nav_section')) {
            Session::put('nav_section', $nav_section);
        }
        return Response::view('partnerwithus', ['nav_section' => $nav_section])->header('Cache-control', 'max-age=86400');
    }

}
