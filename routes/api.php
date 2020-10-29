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
Route::post('save-favourite','FavouriteController@store');
Route::get('get-user-favourites/{user}','FavouriteController@getUserFavourites');
Route::get('get-menu-category-items/{menuItemCategory}','MenuItemCategoryController@getMenuItems');
Route::get('get-payfast-details/{restaurant}','RestaurantController@getPayfastDetails');
Route::post('notify-url','PaymentController@payfastNotification');
Route::get('thank-you','PaymentController@thankYou');
Route::get('cancel','PaymentController@cancel');

Route::post('login','MobileAuthenticator@login');
Route::post('register','MobileAuthenticator@register');
Route::post('password-update','UserController@updatePassword');
Route::get('roles','MobileAuthenticator@getRoles');
Route::post('update-profile/{user}','UserController@updateProfile');
Route::post('save-customer-order','OrderController@store');
Route::post('get-customer-orders/{user}','OrderController@getCustomerOrders');
Route::get('get-item-categories','MenuItemCategoryController@getItemCategoriesApi');

Route::get('get-vendors','VendorController@getVendors');
Route::get('get-vendors-with-restaurants','VendorController@getVendorsWithRestaurants');
Route::get('get-restaurants','RestaurantController@getRestaurants');
Route::get('get-restaurant/{restaurant}','RestaurantController@getRestaurant');
Route::get('get-menu-items/{menu}','MenuController@getMenuItems');
Route::get('get-menus/{restaurant}','MenuController@getMenuItemsAll');
Route::get('get-menu/{menu}','MenuController@getSpecificMenu');
Route::post('store-restaurant','RestaurantController@storeAPI');
Route::post('update-restaurant/{restaurant)','RestaurantController@updateApi');

Route::post('store-menu-item','MenuItemController@storeAPI');
Route::post('update-menu-item/{menuItem}','MenuItemController@updateAPI');

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('profile-update/{user}','ProfileController@updateUserMobile');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
