<?php
/**
 * Created by PhpStorm.
 * User: BAGArt
 * Date: 28.07.17
 * Time: 12:09
 */

namespace App\Http\Controllers\Account;

use App\Http\Controllers\JoshController;
use App\Repositories\AdminRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PaySubscriptionRepository;
use Illuminate\Support\Facades\Storage as Storage;
use App\Repositories\UserRepository;
use App\User;
use Bogardo\Mailgun\Facades\Mailgun;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Redirect;
use Lang;
use Hash;
use Sentinel;
use Validator;

class MyAccountController extends JoshController
{
    /**
     * get user details and display
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $countries = $this->countries;
        //get account balance
        //if the user is supporting admin, grab the idswatched from the super admin account

        $adminRow = (new AdminRepository())
            ->getByUser($user);
        $isAdmin = !!$adminRow;

        //if the user is supporting admin, grab the subscriptionPackageDAta from the super admin account
        if ($adminRow) {
            $subscriptionPackageData = (new PaySubscriptionRepository)
                ->getByUserId($adminRow->userid);
            $mainCompany = (new UserRepository())->getById($adminRow->userid);
        } else {
            $subscriptionPackageData = (new PaySubscriptionRepository)
                ->getByUser($user);
            $mainCompany = [];//null?
        }
        $package = (new PackageRepository)->getById($subscriptionPackageData->packageid);

        $disk = Storage::disk('gcs');

        $url = $disk->url('/users/'.$user->pic);

        return view(
            'user_account',
            compact(
                'user',
                'countries',
                'subscriptionPackageData',
                'mainCompany',
                'isAdmin',
                'package',
                'url'
            )
        );
    }

    /**
     * update user details and display
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        /**
         * @var $user User|UserInterface
         */
        $user = Sentinel::getUser();

        if (
            $request->get('email')
            && $request->get('email') != $user->email
        ) {
            if (!Mailgun::validator()
                ->validate($request->get('email'))
                ->is_valid
            ) {
                return Redirect::back()
                    ->with('error', 'Please enter a valid email address');
            }

            if ((new UserRepository)
                ->getByEmail($request->get('email'))
            ) {
                return Redirect::back()
                    ->with('error', 'Email address already exists');
            }
            $user->email = $request->get('email');
        }
        $fields = $request->all();

        // Create a new validator instance from our validation rules
        $validator = Validator::make(
            $fields,
            ['pic' => 'mimes:jpg,jpeg,bmp,png|max:10000'],
            ['pic.mimes' => 'Please upload image types : jpg,jpeg,bmp,png !']
        );

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()
                ->withErrors($validator);
        }

        $fields = array_filter(array_intersect_key(
            $fields,
            array_flip([
                'companyname',
                'first_name',
                'last_name',
                'country',
                'state',
                'city',
                'address',
                'postal',
                'contact_number',
                'website',
            ])
        ));
        $user->fill($fields);

        /*
        $user->dob = $request->get('dob');
        $user->bio = $request->get('bio');
        $user->gender = $request->get('gender');
        */

        if ($request->get('password')) {
            $user->password = Hash::make(
                $request->get('password')
            );
        }

        // is new image uploaded?
        $file = $request->file('pic');
        if ($file) {
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

        if (!$user->save()) {
            return Redirect::route('my-account')
                ->withInput()
                ->with(
                    'error',
                    Lang::get('users/message.error.update')
                );
        }

        return Redirect::route('my-account')
            ->with(
                'success',
                Lang::get('users/message.success.update')
            );
    }
}