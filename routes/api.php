<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('roles','MobileAuthenticator@getRoles');

Route::post('login','MobileAuthenticator@login');
Route::post('register','MobileAuthenticator@register');

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('profile-update/{user}','ProfileController@updateUserMobile');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
