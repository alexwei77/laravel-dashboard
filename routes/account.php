<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['user', 'enablessl']], function () {
    # My account display and update details
    Route::group(['middleware' => ['freeTrialEnded']], function () {
    Route::get('my-account', ['as' => 'my-account', 'uses' => 'Account\MyAccountController@index']);
    Route::put('my-account', ['uses' => 'Account\MyAccountController@update']);
    });
});
