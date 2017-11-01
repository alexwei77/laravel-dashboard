<?php
include_once 'web_builder.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('slug', '[a-z0-9- _]+');

include_once 'admin.php';

#FrontEndController
Route::get('employees', array('as' => 'employees', 'uses' => 'EmployeesController@employeesinfo'));
Route::group(['middleware' => 'enablessl'], function () {
    Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
    Route::get('employeelogin', array('as' => 'employeelogin','uses' => 'FrontEndController@employeeLogin'));
    Route::post('login','FrontEndController@postLogin');

    Route::post('employee-post-login', array('as' => 'employee-post-login','uses' => 'FrontEndController@employeePostLogin'));
    Route::get('register/{firstname?}/{lastname?}/{email?}', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
    Route::post('register','FrontEndController@postRegister');
    Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
    Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
    Route::post('forgot-password','FrontEndController@postForgotPassword');
    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
});

include_once 'account.php';

Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::post('payresult', 'FrontEndController@payresult'); ///category/{category}/contractsQuantity/{contractsQuantity}
    Route::post('payresult-employer', 'FrontEndController@payresultEmployer');
});

//send user invitation
Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('invite', array('as' => 'invite', 'uses' => 'FrontEndController@getInvite'));
    Route::put('invite', 'FrontEndController@invite');
});

//create rating
Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('create-rating', array('as' => 'create-rating', 'uses' => 'FrontEndController@getRatingForm'));
    Route::get('private-ratingscreate', array('as' => 'private-ratingscreate', 'uses' => 'FrontEndController@getPrivateRatingForm'));
    Route::post('create-rating', 'FrontEndController@submitRating');
    Route::post('private-ratingscreate', 'FrontEndController@submitSelfRating');
    //get selfRating data1
    Route::get('getPrivate-RatingsData', array('as' => 'getPrivate-RatingsData', 'uses' => 'RatingsController@privateData'));
    Route::get('rating', 'FrontEndController@rating');
    Route::get('ratings',['as' => 'Ratings.data', 'uses' =>'RatingsController@ratings']);
});


Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('rating/{ratingID}', 'FrontEndController@rating');
});


Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::group(['middleware' => ['isVerified']], function () {
        Route::group(['middleware' => ['freeTrialEnded']], function () {
            Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'FrontEndController@dashboard'));
            Route::get('myemployees', array('as' => 'myemployees', 'uses' => 'FrontEndController@myemployees'));
            Route::get('admins', array('as' => 'admins', 'uses' => 'FrontEndController@admins'));
            Route::get('employeesdata', array('as' => 'employeesdata', 'uses' => 'FrontEndController@employeesdata'));
            Route::get('commencementdata', array('as' => 'commencementdata', 'uses' => 'FrontEndController@commencementData'));
            Route::get('employmentData', array('as' => 'employmentData', 'uses' => 'FrontEndController@employmentData'));
            Route::get('terminationData', array('as' => 'terminationData', 'uses' => 'FrontEndController@terminationData'));
            Route::get('timeData', array('as' => 'timeData', 'uses' => 'FrontEndController@timeData'));
            Route::get('growthData', array('as' => 'growthData', 'uses' => 'FrontEndController@growthData'));
            Route::get('performanceData', array('as' => 'performanceData', 'uses' => 'FrontEndController@performanceData'));
            Route::get('traitsData', array('as' => 'traitsData', 'uses' => 'FrontEndController@traitsData'));
            Route::get('adminsdata', array('as' => 'adminsdata', 'uses' => 'FrontEndController@adminsdata'));
            Route::get('admins/remove/{adminId}', array('as' => 'admins.remove', 'uses' => 'FrontEndController@removeAdmin'));
            Route::get('singleemployeedata/{employeeID?}', array('as' => 'singleemployeedata', 'uses' => 'FrontEndController@singleemployeedata'));
            Route::post('ajaxemployee/{employeeID?}', array('as' => 'ajaxemployee', 'uses' => 'FrontEndController@getdatabyID'));
            Route::get('contractgenerate', array('as' => 'contractgenerate', 'uses' => 'FrontEndController@contractgenerate'));
            Route::post('contractgenerate','FrontEndController@submitcontractgenerate');

            Route::get('loademployees', array('as' => 'loademployees', 'uses' => 'FrontEndController@loademployees'));
            Route::post('loademployees', 'loadEmployeesController@loademployeesSubmit');

            //tasks section
            Route::post('task/create', 'loadEmployeesController@store');
            Route::get('task/data', 'loadEmployeesController@data');
            Route::post('task/{task}/edit', 'loadEmployeesController@update');
            Route::post('task/{task}/delete', 'loadEmployeesController@delete');
            Route::get('add-to-pending', array('as' => 'add-to-pending', 'uses' => 'loadEmployeesController@addToPending'));
            Route::get('move-to-contract', array('as' => 'move-to-contract', 'uses' => 'loadEmployeesController@moveToContract'));
            Route::post('add-start-date/{employeeid}', array('as' => 'add-start-date', 'uses' => 'EmployeesController@addstart'));
            Route::get('start-date-all', array('as' => 'start-date-all', 'uses' => 'FrontEndController@getStartDateAll'));
            Route::post('start-date-all','EmployeesController@addstartAll');
            Route::get('start-date-selected', array('as' => 'start-date-selected', 'uses' => 'FrontEndController@getStartDateSelected'));
            Route::post('start-date-selected','EmployeesController@addstartSelected');

            Route::get('end-date-all', array('as' => 'end-date-all', 'uses' => 'FrontEndController@getaddendDateAll'));
            Route::post('end-date-all','EmployeesController@addendDateAll');
            Route::get('end-date-selected', array('as' => 'end-date-selected', 'uses' => 'FrontEndController@getaddendDateSelected'));
            Route::post('end-date-selected','EmployeesController@addendDateSelected');
            Route::post('past-all', array('as' => 'past-all', 'uses' =>'EmployeesController@pastAll'));
            Route::post('past-selected', array('as' => 'past-selected', 'uses' =>'EmployeesController@pastSelected'));

            Route::get('back-pending-all', array('as' => 'back-pending-all', 'uses' => 'EmployeesController@backPendingAll'));
            Route::get('back-pending-selected', array('as' => 'back-pending-selected', 'uses' => 'EmployeesController@backPendingSelected'));

            Route::post('add-end-date/{employeeid}', array('as' => 'add-end-date', 'uses' =>'EmployeesController@addend'));
            Route::get('move-all-to-contract', array('as' => 'move-all-to-contract', 'uses' => 'EmployeesController@moveAllToContract'));
            Route::get('move-selected-to-contract', array('as' => 'move-selected-to-contract', 'uses' => 'EmployeesController@moveSelectedToContract'));

            Route::get('checkedids', 'EmployeesController@checkedids');
            Route::get('checkedAll', 'EmployeesController@checkedAll');
            Route::post('consent_obtained/{employeeID?}', array('as' => 'consent_obtained', 'uses' =>'EmployeesController@consentGranted'));

            Route::get('delete-all-employees', array('as' => 'delete-all-employees', 'uses' => 'EmployeesController@deleteAll'));
            Route::get('delete-selected-employees', array('as' => 'delete-all-employees', 'uses' => 'EmployeesController@deleteSelected'));

            Route::post('contractprint', array('as' => 'contractprint', 'uses' => 'FrontEndController@contractprint'));
            Route::get('cancel-watch/{employeeID}', array('as' => 'employees.employee.cancel', 'uses' => 'FrontEndController@cancelWatchRequest'));
            Route::get('consentmanagement', array('as' => 'consentmanagement', 'uses' => 'FrontEndController@consentmanagement'));
            Route::get('consentmanagementData', array('as' => 'consentmanagementData', 'uses' => 'FrontEndController@consentmanagementData'));
            Route::get('consentmanagementApprove/{employeeId}', array('as' => 'employees.consentmanagement.approve', 'uses' => 'FrontEndController@consentmanagementApprove'));
            Route::get('verifyaccount', array('as' => 'verifyaccount', 'uses' => 'FrontEndController@verifyaccount'));
            Route::get('consentmanagementData', array('as' => 'consentmanagementData', 'uses' => 'FrontEndController@consentmanagementData'));
            Route::get('verifyaccountData', array('as' => 'verifyaccountData', 'uses' => 'FrontEndController@verifyaccountData'));
            Route::get('employeesverification/{employeeId}', array('as' => 'employees.employeesverification.verify', 'uses' => 'FrontEndController@verifyemployee'));

            Route::get('upgrade-downgrade', array('as' => 'upgrade-downgrade', 'uses' => 'SubscriptionsController@getUpgradeDowngrade'));

            //downgradeupgrade
            Route::get('upgradedowngrade', array('as' => 'upgradedowngrade', 'uses' => 'SubscriptionsController@upgradedowngrade'));

            //Route::get('upgradedowngradesubmit', 'SubscriptionsController@upgradedowngradesubmit');
            Route::post('upgradedowngradesubmit', 'SubscriptionsController@upgradedowngradesubmit');
            Route::post('cancel-subscription', array('as' => 'cancel-subscription', 'uses' => 'SubscriptionsController@cancelSubscriptions'));

            //helpcenter
            Route::get('helpcenter/history', array('as' => 'helpcenter.history', 'uses' => 'HelpCenter@history'));
            Route::get('helpcenter/compose', array('as' => 'helpcenter.compose', 'uses' => 'HelpCenter@compose'));
            Route::get('helpcenter/view_message', array('as' => 'helpcenter.compose', 'uses' => 'HelpCenter@view_message'));
            Route::post('send-message', array('as' => 'send-message', 'uses' =>'HelpCenter@sendMessage'));

            //save stripe card token
            Route::post('save-card-token', array('as' => 'save-card-token', 'uses' => 'SubscriptionsController@saveStripeToken'));
            //settings 
            Route::get('settings/{locale?}', array('as' => 'settings', 'uses' => 'FrontEndController@settings'));
            Route::get('currency-set/{currency}', array('as' => 'currency-set', 'uses' => 'FrontEndController@currencySet'));

            //Delete employee 
            Route::get('delete-employee/{employeeid}', array('as' => 'delete-employee', 'uses' => 'EmployeesController@deleteEmployee'));
            Route::get('delete-employee-slip/{employeeid}', array('as' => 'delete-employee-slip', 'uses' => 'EmployeesController@deleteEmployeeSlip'));
            Route::get('edit-employee/{employeeid}', array('as' => 'edit-employee', 'uses' => 'EmployeesController@editEmployee'));
            Route::post('edit-employee-submit', array('as' => 'edit-employee-submit', 'uses' => 'EmployeesController@postEditEmployee'));

            //redeem vouchers
             Route::get('redeem-voucher', array('as' => 'redeem-voucher', 'uses' => 'VouchersController@redeemVoucher'));
             Route::post('redeem-voucher', array('as' => 'redeem-voucher', 'uses' => 'VouchersController@postRedeemVoucher'));

        });

        //pay package
        Route::get('pay-package', array('as' => 'pay-package', 'uses' => 'SubscriptionsController@payPackage'));

        //pay package submit
        Route::post('pay-package-submit', array('as' => 'pay-package-submit', 'uses' => 'SubscriptionsController@payPackageReturn'));
    });//end of email verified middleware

});

//Navigate to all ratings page
Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('all-ratings', array('as' => 'all-ratings', 'uses' => 'RatingsController@ratings'));
    Route::get('all-ratings/single/{employeeID}', array('as' => 'allratings.rating.show', 'uses' => 'RatingsController@singleRating'));
    Route::get('requests/cancel/{employeeID}', array('as' => 'allratings.rating.cancel', 'uses' => 'RatingsController@cancelWatchRequest'));
    Route::get('data',['as' => 'ratings.data', 'uses' =>'RatingsController@data']); //This is required for action to work

    //generalPrivateProfile
    Route::get('private-ratings', array('as' => 'private-ratings', 'uses' => 'RatingsController@generalPrivateRatings'));
});

//Employees table
Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('employees/contract/{employeeID}', array('as' => 'employees.contract', 'uses' => 'EmployeesController@contract'));
    Route::get('employees/delete/{employeeID}', array('as' => 'employees.delete', 'uses' => 'EmployeesController@delete'));

    Route::get('view-employee/{employeeID}', array('as' => 'employees.employee.view', 'uses' => 'EmployeesController@singleemployee'));

    Route::get('view-ratings/{companyID?}/{employeeID?}', array('as' => 'view-ratings', 'uses' => 'EmployeesController@viewratings'));

    Route::get('rate-employee/{employeeID}', array('as' => 'rate-employee', 'uses' => 'EmployeesController@rateemployee'));

    //submit score
    Route::post('submitscore','EmployeesController@submitscore');
    //get scores data
    Route::get('scoresData', array('as' => 'scoresData', 'uses' => 'EmployeesController@scoresData'));
    //view contract
    Route::get('viewcontract/{employeeID}', array('as' => 'viewcontract', 'uses' =>'EmployeesController@viewcontract'));

    //verify employer
    Route::group(['middleware' => ['freeTrialEnded']], function () {
    Route::get('verify-company', array('as' => 'verify-company', 'uses' =>'EmployerController@verifyCompany'));
    Route::post('verify-company', 'EmployerController@submitCompanyDocs');
    });

    //view company docs
    Route::get('view-registration', array('as' => 'view-registration', 'uses' =>'EmployerController@viewRegistration'));
    Route::get('view-directorid', array('as' => 'view-directorid', 'uses' =>'EmployerController@viewDirectorId'));
    Route::get('view-utilitybill', array('as' => 'view-utilitybill', 'uses' =>'EmployerController@viewUtility'));

});

//Translations
Route::group(['middleware' => ['user', 'enablessl']], function () {
    Route::get('translations', array('as' => 'translations', 'uses' => 'translationsController@translations'));
});

Route::group(['middleware' => ['enablessl']], function () {
    Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
# contact form
//Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));
});

// Route::get('faq', array('as' => 'faq', 'uses' => 'FrontEndController@faq'));

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

#frontend views
//home for logged in user
/*Route::group(array('middleware' => 'user'), function () {
Route::get('/', array('as' => 'home', function () {
    $activitiesCount = DB::table('dmmx_recent_activities')->count();
    $activities = DB::table('dmmx_recent_activities')->take(8)->get();
    $countryPrices = DB::table('dmmx_country_prices')->get();
    $currencyInfo = DB::table('currency')->get();
    $user = Sentinel::getUser();
    //checking if the user is an employee
    $employeeCheck = DB::table('dmmx_employees')->where('email', $user->email)->count();
    //echo $_SERVER['SERVER_NAME'];
    return View::make('index' , compact('activitiesCount','activities', 'countryPrices', 'currencyInfo', 'user', 'employeeCheck'));
}));
});*/


//Home for not logged in user
/*Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{*/

//FOR INTERNATIONAL URLS//
Route::get('/business/pricing', array('as' => 'pricing', 'uses' => 'FrontEndController@pricing'));
Route::get('/business', array('as' => 'home', 'uses' => 'FrontEndController@indexBoth'));
Route::get('staff', array('as' => 'staff', 'uses' => 'EmployeesController@employeesinfo'));
Route::get('aboutus', array('as' => 'aboutus', 'uses' => 'FrontEndController@aboutus'));
Route::get('benefits', array('as' => 'benefits', 'uses' => 'FrontEndController@benefits'));

//thank you
Route::post('thank-you', array('as' => 'thank-you','uses' => 'FrontEndController@postContact'));
Route::get('/staff/branches', array('as' => 'staff.branches','uses' => 'FrontEndController@branches'));
Route::get('/business/branches', array('as' => 'business.branches','uses' => 'FrontEndController@branches'));
Route::get('/staff/contacts', array('as' => 'staff.contacts','uses' => 'FrontEndController@contacts'));
Route::get('/business/contacts', array('as' => 'business.contacts','uses' => 'FrontEndController@contacts'));
Route::get('/staff/faq', array('as' => 'staff.faq','uses' => 'FrontEndController@faq'));
Route::get('/business/faq', array('as' => 'business.faq','uses' => 'FrontEndController@faq'));
Route::get('/staff/help', array('as' => 'staff.help','uses' => 'FrontEndController@help'));
Route::get('/business/help', array('as' => 'business.help','uses' => 'FrontEndController@help'));

//Terms and conditions
Route::get('/business/terms-and-conditions', array('as' => 'business.terms-and-conditions','uses' => 'FrontEndController@getTsandCs'));
Route::get('/staff/terms-and-conditions', array('as' => 'staff.terms-and-conditions','uses' => 'FrontEndController@getTsandCs'));

//user subscription page
Route::group(['middleware' => ['enablessl']], function () {
    //Route::get('subscribe/{package?}', array('as' => 'subscribe', 'uses' => 'FrontEndController@getSubscribe'));
    Route::get('/business/subscribe/{package?}/{yearly?}', array('as' => '/business/subscribe', 'uses' => 'FrontEndController@getSubscribePublic'));
    Route::put('/business/subscribe', 'FrontEndController@subscribe');
    //Route::put('subscribe', 'FrontEndController@subscribeEmployer');

    //pay package
     Route::get('business/pay-package', array('as' => 'pay-package', 'uses' => 'SubscriptionsController@payPackage'));
     //pay package submit
     Route::post('business/pay-package-submit', array('as' => 'pay-package-submit', 'uses' => 'SubscriptionsController@payPackageReturn'));
});

Route::get('privacy', array('as' => 'privacy', 'uses' => 'FrontEndController@getPrivacy'));
Route::get('email-verification', array('as' => 'email-verification', 'uses' => 'FrontEndController@emailVerified'));
Route::get('slip-verification/{employeeid}', array('as' => 'slip-verification', 'uses' => 'EmployeesController@employeeSLIPVerification'));

Route::get('not-verified', array('as' => 'notverified', 'uses' => 'FrontEndController@notverified'));

//regenerate token (This should be visible to logged in users only)
Route::get('token-regenerate', array('as' => 'token-regenerate', 'uses' => 'FrontEndController@regenerateToken'));
Route::get('trial-expired', array('as' => 'trial-expired', 'uses' => 'FrontEndController@trialexpired'));

Route::get('partner-with-us', array('as' => 'partner-with-us','uses' => 'FrontEndController@partnerWithUs'));

Route::group(['prefix' => '{lang?}'], function () {

    Route::get('/', array('as' => 'home', 'uses' => 'FrontEndController@indexBoth'));
    Route::get('/business', array('as' => 'home', 'uses' => 'FrontEndController@indexBoth'));
    Route::get('staff', array('as' => 'staff', 'uses' => 'EmployeesController@employeesinfo'));
//pricing 
    Route::get('/business/pricing', array('as' => 'pricing', 'uses' => 'FrontEndController@pricing'));
    Route::get('support', array('as' => 'support', 'uses' => 'FrontEndController@support'));
    Route::get('aboutus', array('as' => 'aboutus', 'uses' => 'FrontEndController@aboutus'));
    Route::get('benefits', array('as' => 'benefits', 'uses' => 'FrontEndController@benefits'));
    Route::get('privacy', array('as' => 'privacy', 'uses' => 'FrontEndController@getPrivacy'));

//Terms and conditions
    Route::get('/business/terms-and-conditions', array('as' => 'business.terms-and-conditions','uses' => 'FrontEndController@getTsandCs'));
    Route::get('/staff/terms-and-conditions', array('as' => 'staff.terms-and-conditions','uses' => 'FrontEndController@getTsandCs'));

//thank you 
    Route::post('thank-you', array('as' => 'thank-you','uses' => 'FrontEndController@postContact'));
    Route::get('thank-you', array('as' => 'thank-you','uses' => 'FrontEndController@getThankYou'));

 //partner-with-us 
 Route::get('partner-with-us', array('as' => 'partner-with-us','uses' => 'FrontEndController@partnerWithUs'));
 Route::post('partner-thank-you', array('as' => 'thank-you','uses' => 'FrontEndController@postPartner'));
 Route::get('partner-thank-you', array('as' => 'thank-you','uses' => 'FrontEndController@getThankYou'));

    Route::get('/staff/branches', array('as' => 'staff.branches','uses' => 'FrontEndController@branches'));
    Route::get('/business/branches', array('as' => 'business.branches','uses' => 'FrontEndController@branches'));
    Route::get('/staff/contacts', array('as' => 'staff.contacts','uses' => 'FrontEndController@contacts'));
    Route::get('/business/contacts', array('as' => 'business.contacts','uses' => 'FrontEndController@contacts'));
    Route::get('/staff/faq', array('as' => 'staff.faq','uses' => 'FrontEndController@faq'));
    Route::get('/business/faq', array('as' => 'business.faq','uses' => 'FrontEndController@faq'));
    Route::get('/staff/help', array('as' => 'staff.help','uses' => 'FrontEndController@help'));
    Route::get('/business/help', array('as' => 'business.help','uses' => 'FrontEndController@help'));


//user subscription page 
    Route::group(['middleware' => ['enablessl']], function () {
        //Route::get('subscribe/{package?}', array('as' => 'subscribe', 'uses' => 'FrontEndController@getSubscribe'));
        Route::get('/business/subscribe/{package?}/{yearly?}', array('as' => '/business/subscribe', 'uses' => 'FrontEndController@getSubscribePublic'));
        Route::put('/business/subscribe', 'FrontEndController@subscribe');
        //Route::put('subscribe', 'FrontEndController@subscribeEmployer');

        //pay package
     Route::get('business/pay-package', array('as' => 'pay-package', 'uses' => 'SubscriptionsController@payPackage'));
     //pay package submit
     Route::post('business/pay-package-submit', array('as' => 'pay-package-submit', 'uses' => 'SubscriptionsController@payPackageReturn'));
    });

Route::get('news', array('as' => 'news', 'uses' => 'FrontendBlogController@index'));
//Route::get('news/{slug}/tag', 'FrontendBlogController@getBlogTag');
Route::get('newsitem/{slug?}',array('as' => 'newsitem/{slug?}', 'uses' => 'FrontendBlogController@getBlog'));
Route::post('newsitem/{blog}/comment', 'FrontendBlogController@storeComment');

});


Route::get('{name?}', 'JoshController@showFrontEndView');

Route::get('features/{package}', array('as' => 'features', 'uses' => 'FrontEndController@getfeatures'));
# End of frontend views
//Route::get('faq', array('as' => 'faq', 'uses' => 'FrontendBlogController@faq'));

/*Route::post('/sendmail', function (\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
     $mailer->to($request->input('mail'))
            ->send(new \App\Mail\MyMail($request->input('title')));
     return redirect()->back();
})->name('sendmail');*/

/*use Vsch\TranslationManager\Translator;

 Route::group(['middleware' => 'web', 'prefix' => 'translations'], function () {
     Translator::routes();
 });*/


