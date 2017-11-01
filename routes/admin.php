<?php
use Illuminate\Support\Facades\Route;


Route::group(array('prefix' => 'admin'), function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });
    Route::get('500', function () {
        return View::make('admin/500');
    });



    Route::post('secureImage', array('as' => 'secureImage','uses' => 'JoshController@secureImage'));

    # Lock screen
    Route::get('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@lockscreen'));
    Route::post('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@postLockscreen'));

    # All basic routes defined here
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');
    Route::get('signup', array('as' => 'admin.signup', 'uses' => 'AuthController@getSignup'));
    Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
    Route::get('forgot-password', array('as' => 'admin.forgot-password-get', 'uses' => 'AuthController@getForgotPassword'));
    Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
    Route::get('login2', function () {
        return View::make('admin/login2');
    });

    # Register2
    Route::get('register2', function () {
        return View::make('admin/register2');
    });
    Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(['prefix' => 'admin', 'middleware' => ['web','admin'], 'as' => 'admin.'], function () {
    # Dashboard / Index
    Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));

    //packages
    Route::group(array('prefix' => 'packages'), function () {
        Route::post('packages', 'SubscriptionsController@postPackages');
        Route::get('packages', array('as' => 'packages','uses' => 'SubscriptionsController@getPackages'));
    });

    // GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('data',['as' => 'users.data', 'uses' =>'UsersController@data']);
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{user}/delete', array('as' => 'users.delete', 'uses' => 'UsersController@destroy'));
        Route::get('{user}/confirm-delete', array('as' => 'users.confirm-delete', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{user}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{user}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('{user}/passwordreset', array('as' => 'passwordreset', 'uses' => 'UsersController@passwordreset'));
    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

    # Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'groups.create', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{group}/edit', array('as' => 'groups.edit', 'uses' => 'GroupsController@edit'));
        Route::post('{group}/edit', 'GroupsController@update');
        Route::get('{group}/delete', array('as' => 'groups.delete', 'uses' => 'GroupsController@destroy'));
        Route::get('{group}/confirm-delete', array('as' => 'groups.confirm-delete', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{group}/restore', array('as' => 'groups.restore', 'uses' => 'GroupsController@getRestore'));
    });

    # Subscriptions Management
    Route::group(array('prefix' => 'subscriptions'), function () {
        Route::get('allsubscriptions','SubscriptionsController@allsubscriptions');
        Route::get('pricesadd', 'SubscriptionsController@pricesadd');
        Route::post('pricesadd', 'SubscriptionsController@submitprices');
        Route::get('allcountries', 'SubscriptionsController@countriesshow');
        Route::get('data',['as' => 'countries.data', 'uses' =>'SubscriptionsController@data']); //This is required for action to work
        Route::get('data1',['as' => 'subscriptions.data', 'uses' =>'SubscriptionsController@data1']); //This is required for action to work
        Route::get('countries/{country}', array('as' => 'countries.show', 'uses' => 'SubscriptionsController@show'));
        Route::get('subscriptions/{subscription}', array('as' => 'subscription.show', 'uses' => 'SubscriptionsController@showSubscription')); //show single subscription
        Route::get('countries/{country}/edit', array('as' => 'countries.edit', 'uses' => 'SubscriptionsController@edit'));
        Route::get('subscriptions/{subscription}/edit', array('as' => 'subscription.edit', 'uses' => 'SubscriptionsController@edit1'));
        Route::post('countries/{country}/edit', 'SubscriptionsController@submitedit');
        Route::post('subscriptions/{subscription}/edit', 'SubscriptionsController@submitSubscriptionEdit');
        Route::get('countries/{country}/confirm-delete', array('as' => 'countries.confirm-delete', 'uses' => 'SubscriptionsController@getModalDelete'));
        Route::get('subscriptions/{subscription}/confirm-delete', array('as' => 'subscriptions.confirm-delete', 'uses' => 'SubscriptionsController@getModalDelete1'));
        Route::get('countries/{country}/delete', array('as' => 'subscriptions.delete', 'uses' => 'SubscriptionsController@destroy'));
        Route::get('subscriptions/{subscription}/delete', array('as' => 'singlesubscription.delete', 'uses' => 'SubscriptionsController@destroy1'));

        //Route::get('/country/edit', 'SubscriptionsController@submitcountryedit');
        //Route::post('countries/{country}/edit', array('as' => 'countries.update', 'uses' => 'SubscriptionsController@submitcountryedit'));
        //Route::post('countries/{country}/edit/submit', 'SubscriptionsController@submitcountryedit');
        //Route::post('countries/7/edit','SubscriptionsController@submitcountryedit');
        //Route::post('countries/{country}/submit', ['as' => 'countries.submit', 'uses' =>'SubscriptionsController@submitcountryedit']);

        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'groups.create', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{group}/edit', array('as' => 'groups.edit', 'uses' => 'GroupsController@edit'));
        Route::post('{group}/edit', 'GroupsController@update');
        Route::get('{group}/delete', array('as' => 'groups.delete', 'uses' => 'GroupsController@destroy'));
        Route::get('{group}/confirm-delete', array('as' => 'groups.confirm-delete', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{group}/restore', array('as' => 'groups.restore', 'uses' => 'GroupsController@getRestore'));

    });

    # Subscriptions Management
    Route::group(array('prefix' => 'metrics'), function () {
        //scoring metrics
        Route::get('metricadd', 'EmployeesController@metricadd');
        Route::post('metricadd', 'EmployeesController@metricstore');
    });

    # Subscriptions Management
    Route::group(array('prefix' => 'vouchers'), function () {
        //scoring metrics
        Route::get('create-voucher', 'VouchersController@getCreateVouchers');
        Route::post('create-voucher', 'VouchersController@postCreatedVoucher');
    });


    /*routes for blog*/
    Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
        Route::get('create', array('as' => 'blog.create', 'uses' => 'BlogController@create'));
        Route::post('create', 'BlogController@store');
        Route::get('{blog}/edit', array('as' => 'blog.edit', 'uses' => 'BlogController@edit'));
        Route::post('{blog}/edit', 'BlogController@update');
        Route::get('{blog}/delete', array('as' => 'blog.delete', 'uses' => 'BlogController@destroy'));
        Route::get('{blog}/confirm-delete', array('as' => 'blog.confirm-delete', 'uses' => 'BlogController@getModalDelete'));
        Route::get('{blog}/restore', array('as' => 'blog.restore', 'uses' => 'BlogController@restore'));
        Route::get('{blog}/show', array('as' => 'blog.show', 'uses' => 'BlogController@show'));
        Route::post('{blog}/storecomment', 'BlogController@storeComment');
    });

    /*routes for blog category*/
    Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'blogcategory.create', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogCategory}/edit', array('as' => 'blogcategory.edit', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogCategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogCategory}/delete', array('as' => 'blogcategory.delete', 'uses' => 'BlogCategoryController@destroy'));
        Route::get('{blogCategory}/confirm-delete', array('as' => 'blogcategory.confirm-delete', 'uses' => 'BlogCategoryController@getModalDelete'));
        Route::get('{blogCategory}/restore', array('as' => 'blogcategory.restore', 'uses' => 'BlogCategoryController@getRestore'));
    });

    /*routes for file*/
    Route::group(array('prefix' => 'file'), function () {
        Route::post('create', 'FileController@store');
        Route::post('createmulti', 'FileController@postFilesCreate');
        Route::delete('delete', 'FileController@delete');
    });

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

    /* laravel example routes */
    # datatables
    Route::get('datatables', 'DataTablesController@index');
    Route::get('datatables/data', array('as' => 'datatables.data', 'uses' => 'DataTablesController@data'));

    # editable datatables
    Route::get('editable_datatables', 'EditableDataTablesController@index');
    Route::get('editable_datatables/data', array('as' => 'editable_datatables.data', 'uses' => 'EditableDataTablesController@data'));
    Route::post('editable_datatables/create','EditableDataTablesController@store');
    Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update');
    Route::get('editable_datatables/{id}/delete', array('as' => 'admin.editable_datatables.delete', 'uses' => 'EditableDataTablesController@destroy'));

    # custom datatables
    Route::get('custom_datatables', 'CustomDataTablesController@index');
    Route::get('custom_datatables/sliderData', array('as' => 'admin.custom_datatables.sliderData', 'uses' => 'CustomDataTablesController@sliderData'));
    Route::get('custom_datatables/radioData', array('as' => 'admin.custom_datatables.radioData', 'uses' => 'CustomDataTablesController@radioData'));
    Route::get('custom_datatables/selectData', array('as' => 'admin.custom_datatables.selectData', 'uses' => 'CustomDataTablesController@selectData'));
    Route::get('custom_datatables/buttonData', array('as' => 'admin.custom_datatables.buttonData', 'uses' => 'CustomDataTablesController@buttonData'));
    Route::get('custom_datatables/totalData', array('as' => 'admin.custom_datatables.totalData', 'uses' => 'CustomDataTablesController@totalData'));

    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


    # Remaining pages will be called from below controller method
    # in real world scenario, you may be required to define all routes manually

    Route::get('{name?}', 'JoshController@showView');

    Route::resource('books', 'BooksController');
    Route::get('books/{id}/delete', array('as' => 'books.delete', 'uses' => 'BooksController@getDelete'));
    Route::get('books/{id}/confirm-delete', array('as' => 'books.confirm-delete', 'uses' => 'BooksController@getModalDelete'));

     Route::get('packages/list',['as' => 'packages.data', 'uses' =>'SubscriptionsController@packages']);
     Route::get('packages/{packageid}/edit',['as' => 'packages.edit', 'uses' =>'SubscriptionsController@editPackages']);
     //Route::get('{package}/edit-package', array('as' => 'packages.edit', 'uses' => 'SubscriptionsController@editPackages'));
    //members/users
    Route::get('members/{userid}/edit/users', array('as' => 'members.edit.users', 'uses' => 'Members\MembersController@users'));
    Route::get('members/edit/users/get_users', array('as' => 'members.edit.users.get_users', 'uses' => 'Members\MembersController@get_users'));

    Route::get('members/{userid}/edit/admins', array('as' => 'members.edit.admins', 'uses' => 'Members\MembersController@admins'));
    Route::get('members/edit/users/admins', array('as' => 'members.edit.users.get_admins', 'uses' => 'Members\MembersController@get_admins'));

    Route::get('members/{userid}/edit/billing', array('as' => 'members.edit.billing', 'uses' => 'Members\MembersController@billing'));
    Route::post('members/{userid}/edit/post_billing_note', array('as' => 'members.edit.post_billing_note', 'uses' => 'Members\MembersController@post_billing_note'));

    Route::get('members/{userid}/view/stats', array('as' => 'members.view.stats', 'uses' => 'Members\MembersController@statsView'));
    Route::post('members/{userid}/edit/company', array('as' => 'members.edit.company', 'uses' => 'Members\MembersController@companyEdit'));
    Route::get('members/{userid}/view/company', array('as' => 'members.view.company', 'uses' => 'Members\MembersController@companyView'));

    Route::get('members/{userid}/view/settings', array('as' => 'members.view.settings', 'uses' => 'Members\MembersController@settingsView'));
    Route::post('members/{userid}/edit/settings', array('as' => 'members.edit.settings', 'uses' => 'Members\MembersController@settingsEdit'));
});

