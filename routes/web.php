<?php

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('account-verification/{user}','UserController@userVerify');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('vendors','VendorController');
    Route::get('vendor-view/{vendor}','VendorController@show');
    Route::get('get-system-users','UserController@getSystemUsers')->name('get-system-users');
    Route::get('user-delete/{user}','UserController@destroy');

    Route::resource('menu-items','MenuItemController');
    Route::resource('menus','MenuController');
    Route::get('menu-delete/{menu}','MenuController@destroy');
    Route::get('get-restaurant-menus','MenuController@getRestaurantMenus')->name('get-restaurant-menus');

    Route::resource('restaurants','RestaurantController');
    Route::get('get-restaurants','RestaurantController@adminGetRestaurants')->name('get-restaurants');
    Route::get('get-vendors','VendorController@getVendorsWeb')->name('get-vendors');
    Route::get('vendor-delete/{vendor}','VendorController@destroy');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


