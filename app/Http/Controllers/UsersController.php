<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\PackageRepository;
use App\Repositories\PaySubscriptionRepository;
use App\User;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Datatables;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Repositories\CompanyVerifyRepository;
use Illuminate\Support\Facades\Storage as Storage;
use App\Models\PaySubscription;
use App\Models\CompanyVerify;
use App\Models\Package;
use App\Models\Admin;
use App\Models\EmployeesWatch;
use App\Models\Scores;


class UsersController extends JoshController
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */
    public function index()
    {
        // Grab all the users
        //$users = User::All();
        $countries = $this->countries;
        $packages1 = Package::all();
        $packages = array();
        foreach($packages1 as $package){
            if($package->name == "Elite extra" || $package->name == "Elite extra admins" || $package->name == "test-plan"){
               
            }else{
              array_push($packages, $package);
            }
        }

        // Show the page
        return view('admin.users.index', compact('countries', 'packages'));
    }

    /*
     * Pass data through ajax call
     */
    public function data()
    {
        $users = (new User)
            ->orderBy('created_at', 'desc')
            ->get();

        //check if superadmin, admin or employee
        foreach ($users as $unituser) {
            //check if superadmin
            $super_admin_check = DB::table('dmmx_paysubscriptions')
                ->where('userid', $unituser->id)
                ->count();
            if ($super_admin_check > 0) {
                $unituser->level = "Super Admin";
            } elseif ($super_admin_check == 0) {
                //check if supporting admin 
                $supporting_admin_check = DB::table('dmmx_admins_table')
                    ->where('email', $unituser->email)
                    ->count();
                if ($supporting_admin_check > 0) {
                    $unituser->level = "Supporting HR";
                } else {
                    $unituser->level = "Employee";
                }
            }

            //get the package name and package period 
            if (!empty($unituser->permissions2)) {
                //get the pay_subscriptions row
                $paysubscription_row = DB::table('dmmx_paysubscriptions')
                    ->where('userid', $unituser->id)
                    ->first();

                $unituser->admins_avail = $paysubscription_row->admins_avail;
                $unituser->employees_avail = $paysubscription_row->employees_avail;
//                $unituser->acc = $paysubscription_row->acc;


                $package_purchased = DB::table('packages')
                    ->where('id', $paysubscription_row->packageid)
                    ->first();
                if (empty($package_purchased->id)) {
                    $unituser->package = "";
                    $unituser->period = "";
                    $unituser->admins = 0;
                    $unituser->employees = 0;
                }
                $unituser->package = $package_purchased->name;
                if ($paysubscription_row->sub_type) {
                    $unituser->period = "Yearly";
                    $unituser->amount = ($package_purchased->price) * 12;
                } else {
                    $unituser->period = "Monthly";
                    $unituser->amount = ($package_purchased->monthly_price);
                }
                //get the payment status 
                if ($paysubscription_row->pay_status) {
                    $unituser->pay_status = '$' . $unituser->amount;
                } else {
                    $unituser->pay_status = "Not Paid";
                }
            } else {
                $unituser->package = "";
                $unituser->period = "";
                $unituser->amount = 00;
                $unituser->pay_status = "";
                $unituser->admins_avail = '';
                $unituser->employees_avail = '';
                $unituser->acc = '';
            }

            $unituser->country = $this->countries[$unituser->country];
            if ($unituser->country == "Select Country") {
                $unituser->country = "Not given";
            }
        }


        return Datatables::of($users)
            ->edit_column('created_at', function (User $user) {
                //return $user->created_at->diffForHumans();
                return (new Carbon($user->created_at))->formatLocalized('%Y-%m-%d');
            })
            ->edit_column('verified_html', function (User $user) {
                return $user->verified
                    ? '<input type=checkbox disabled checked />'
                    : '<input type=checkbox disabled />';

            })
            ->add_column('status', function ($user) {
                return Activation::completed($user)
                    ? 'Activated'
                    : 'Pending';
            })
            ->add_column('actions', function ($user) {
                $actions = '<a href=' . route('admin.users.show', $user->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href=' . route('admin.members.view.company',
                        $user->id) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';

//                if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
//                    $actions .= '<a href=' . route('admin.users.confirm-delete', $user->id) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
//                }
                return $actions;
            })
            ->rawColumns(['actions', 'verified_html'])
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.users.create', compact('groups', 'countries'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(UserRequest $request)
    {
        //upload image
        if ($file = $request->file('picture')) {
            // $fileName = $file->getClientOriginalName();

            $rules = array(
                'picture' => 'image|mimes:jpg,jpeg,bmp,png',
            );

            $validator = Validator::make($request->only('picture'), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withInput()->withErrors($validator);
            }

            $folderName = '/users/';

            $disk = Storage::disk('gcs');

            $extension = $file->getClientOriginalExtension() ?: 'png';

            $safeName = hash('md5', str_replace('.', '', uniqid('', true))) . '.' . $extension;

            // check if a file exists
            if($disk->exists($folderName . $safeName)) {
                $disk->delete($folderName . $safeName);
            }

            // create a file
            $disk->put($folderName . $safeName, file_get_contents($file->path()));

            $disk->setVisibility($folderName . $safeName, 'public');

            $request['pic'] = $safeName;
        }

        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

        try {
            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'group', 'activate', 'pic_file'),
                $activate);

            //add user to 'User' group
            $role = Sentinel::findRoleById($request->get('group'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if (!$request->get('activate')) {
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

            // Redirect to the home page with success menu
            return Redirect::route('admin.users.index')->with('success', Lang::get('users/message.success.create'));

        } catch (LoginRequiredException $e) {
            $error = Lang::get('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = Lang::get('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = Lang::get('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user = null)
    {
        // Get this user groups
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();

        // Get a list of all the available groups
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);
        $countries = $this->countries;
        //$regions = $countries = [];
        //foreach (\Countries::all() as $country) {
        //    $countries[] = [
         //       'name' => $country->name->common,
          //      'cca2' => $country->cca2,
          //      'region' => $country->region,
          //      'cca3' => $country->cca3,
          //  ];
          //  $regions[$country->region ? $country->region : 'Other'] = true;
        //}
        //$regions = array_keys($regions);
        //sort($regions);

        //check if company is verified
        $verification_docs_status = CompanyVerifyRepository::companyVerified($user->id, true);

        // die(var_dump($verification_docs_status));

        $disk = Storage::disk('gcs');

        $url = $disk->url('/users/'.$user->pic);

        $paySubscription = (new PaySubscriptionRepository())
            ->getByUserId($user->id);
        $package = $paySubscription->package;
        $packages = (new PackageRepository())->all();
        // Show the page

        $user->load('admins');
        $user->load('employees');

        $userid = $user->id;

        return view(
            'admin.users.edit',
            compact(
                'user',
                'roles',
                'userRoles',
                'adminList',
                'countries',
                'status',
                'paySubscription',
                'packages',
                'package',
                'url',
                'userid',
                'verification_docs_status'
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
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update(User $user, UserRequest $request)
    {
        if ($request->has('pic_file')) {
            $rules = array(
                'pic_file' => 'image|mimes:jpg,jpeg,bmp,png',
            );

            $validator = Validator::make($request->only('pic_file'), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withInput()->withErrors($validator);
            }
        }
        try {
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->dob = $request->get('dob');
            $user->bio = $request->get('bio');
            $user->gender = $request->get('gender');
            $user->country = $request->get('country');
            $user->state = $request->get('state');
            $user->city = $request->get('city');
            $user->address = $request->get('address');
            $user->postal = $request->get('postal');

            if ($password = $request->has('password')) {
                $user->password = Hash::make($request->password);
            }


            // is new image uploaded?
            if ($file = $request->file('pic_file')) {

                $folderName = '/users/';

                $disk = Storage::disk('gcs');

                $extension = $file->getClientOriginalExtension() ?: 'png';

                $safeName = hash('md5', $user->email) . '.' . $extension;

                // check if a file exists
                if($disk->exists($folderName . $safeName)) {
                    $disk->delete($folderName . $safeName);
                }

                // create a file
                $disk->put($folderName . $safeName, file_get_contents($file->path()));

                $disk->setVisibility($folderName . $safeName, 'public');

                //save new file path into db
                $user->pic = $safeName;

            }

            //save record
            $user->save();

            // Get the current user groups
            $userRoles = $user->roles()->pluck('id')->all();

            // Get the selected groups
            $selectedRoles = $request->get('groups', array());

            // Groups comparison between the groups the user currently
            // have and the groups the user wish to have.
            $rolesToAdd = array_diff($selectedRoles, $userRoles);
            $rolesToRemove = array_diff($userRoles, $selectedRoles);

            // Assign the user to groups
            foreach ($rolesToAdd as $roleId) {
                $role = Sentinel::findRoleById($roleId);

                $role->users()->attach($user);
            }

            // Remove the user from groups
            foreach ($rolesToRemove as $roleId) {
                $role = Sentinel::findRoleById($roleId);

                $role->users()->detach($user);
            }

            // Activate / De-activate user
            $status = $activation = Activation::completed($user);
            if ($request->get('activate') != $status) {
                if ($request->get('activate')) {
                    $activation = Activation::exists($user);
                    if ($activation) {
                        Activation::complete($user, $activation->code);
                    }
                } else {
                    //remove existing activation record
                    Activation::remove($user);
                    //add new record
                    Activation::create($user);

                    //send activation mail
                    $data = array(
                        'user' => $user,
                        'activationUrl' => URL::route('activate', $user->id, Activation::exists($user)->code),
                    );

                    // Send the activation code through email
                    Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                        $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                        $m->subject('Welcome ' . $user->first_name);
                    });

                }
            }

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');

                // Redirect to the user page
                return Redirect::route('admin.users.edit', $user)->with('success', $success);
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

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_users', compact('users'));
    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = Lang::get('users/message.error.delete');

                return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.users.delete', ['id' => $user->id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = Lang::get('admin/users/message.error.delete');

                // Redirect to the user management page
                return Redirect::route('admin.users.index')->with('error', $error);
            }

            // Delete the user
            //to allow soft deleted, we are performing query on users model instead of Sentinel model
            //$user->delete();
            User::destroy($id);

            // Prepare the success message
            $success = Lang::get('users/message.success.delete');

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('admin/users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id = null)
    {
        try {
            // Get user information
            $user = User::withTrashed()->find($id);

            // Restore the user
            $user->restore();

            $this->reverseSoftDeleteUser($id);

            // create activation record for user and send mail with activation link
            $data = array(
                'user' => $user,
                'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
            );

            // Send the activation code through email
            Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Dear ' . $user->first_name . '! Active your account');
            });


            // Prepare the success message
            $success = Lang::get('users/message.success.restored');

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('error', $error);
        }
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            // Get the user information
            $user = Sentinel::findUserById($id);

            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }

            $disk = Storage::disk('gcs');

            $url = $disk->url('/users/'.$user->pic);

        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }

        // Show the page
        return view('admin.users.show', compact('user', 'url'));

    }

    public function passwordreset($id, Request $request)
    {
        $user = Sentinel::findUserById($id);
        $password = $request->get('password');

        if (isset($password) && strlen($password) > 0) {
            $user->password = Hash::make($password);
            $user->save();
        } else {
            return Redirect::back()->withInput()->with('error',
                Lang::get('admin/users/message.user_password_required'));
        }
    }

    public function lockscreen($id)
    {
        $user = Sentinel::findUserById($id);
        return view('admin.lockscreen', compact('user'));
    }

    public function postLockscreen(Request $request)
    {
        $password = Sentinel::getUser()->password;
        if (Hash::check($request->password, $password)) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
