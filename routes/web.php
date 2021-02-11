<?php

use Illuminate\Support\Facades\Route;

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

//auth routes for normal user
Auth::routes(['verify' => false, 'register' => false]);

//admin auth routes
// Route::prefix('web_admin')->namespace('Auth')->group(function () {
//     Route::get('/login', 'AdminLoginController@showLoginForm')->name('login');
//     Route::post('/logout', 'AdminLoginController@logout')->name('logout');
//     Route::post('/login', 'AdminLoginController@login')->name('login.submit');
//     Route::post('/password/reset', 'AdminResetPasswordController@reset')->name('password.update');
//     Route::post('/password/forget/password', 'AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     Route::get('/password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
//     Route::get('/password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('password.reset');
// });

//protected admin routes
Route::middleware(['auth:admin', 'is_active'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    //profile pages
    Route::get('/update-profile', 'StaffController@update_profile')->name('update_profile');
    Route::post('/save-profile', 'StaffController@save_profile')->name('save_profile');
    Route::post('/change-password', 'StaffController@change_password')->name('change_password');

    //Staffs routes
    Route::get('/staff', 'StaffController@index')->name('staff');
    Route::get('/staff/add', 'StaffController@add')->name('staff.add');
    Route::get('/staff/edit/{user_id}', 'StaffController@edit')->name('staff.edit');
    Route::post('/staff/save', 'StaffController@save')->name('staff.save');
    Route::post('/staff/update_password', 'StaffController@update_password')->name('staff.update_password');
    Route::get('/staff/update-status/{user_id}', 'StaffController@updateStatus')->name('staff.update_status');
    Route::get('/staff/delete/{user_id}', 'StaffController@delete')->name('staff.delete');

    //notification routes
    Route::get('/notification', 'NotificaitonController@index')->name('notifications');
    Route::get('/notification/get_all_notifications', 'NotificaitonController@get_all_notificaitons')->name('notification.all');
    Route::get('/notification/mark_all_read', 'NotificaitonController@mark_all_read')->name('notifications.all_read');
    Route::get('/notification/mark_as_read/{id}', 'NotificaitonController@mark_single_notification_read')->name('notifications.mark_as_read');
    Route::get('/notification/delete_all', 'NotificaitonController@delete_notifications')->name('notifications.delete_all');
});