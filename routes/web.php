<?php

use Illuminate\Support\Facades\Auth;
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

//protected admin routes
Route::middleware(['auth', 'is_active'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    //profile pages
    Route::get('/update-profile', 'StaffController@update_profile')->name('update_profile');
    Route::post('/save-profile', 'StaffController@save_profile')->name('save_profile');
    Route::post('/change-password', 'StaffController@change_password')->name('change_password');

    //Staffs routes
    // Route::get('/staff', 'StaffController@index')->name('staff');
    // Route::get('/staff/add', 'StaffController@add')->name('staff.add');
    // Route::get('/staff/edit/{user_id}', 'StaffController@edit')->name('staff.edit');
    // Route::post('/staff/save', 'StaffController@save')->name('staff.save');
    // Route::post('/staff/update_password', 'StaffController@update_password')->name('staff.update_password');
    // Route::get('/staff/update-status/{user_id}', 'StaffController@updateStatus')->name('staff.update_status');
    // Route::get('/staff/delete/{user_id}', 'StaffController@delete')->name('staff.delete');

    
    //users
    Route::get('/add/user','UserController@index')->name('user.add');
    Route::get('/all/users','UserController@all_users')->name('users.show');
    Route::get('/user/save','UserController@save')->name('user.save');
    Route::get('/user/updaet','UserController@index')->name('user.update');
    //Route::get('/users/search','UserController@search')->name('');
    Route::get('/serch','UserController@search')->name('users.search');

    //acls
    Route::get('/all/acl/users','AclController@index')->name('acl.users.show');
    Route::get('/users/add/acl','AclController@save_user')->name('acl.users.save');
    Route::get('/users/update-acl','AclController@update_user')->name('acl.users.update');
    Route::get('/users/search','AclController@search')->name('acl.users.search');

    //DBS
    route::get('/all/dbs','dbscontroller@index')->name('dbs.show');
    route::get('/add-dbs','dbscontroller@save_dbs')->name('dbs.save');
    route::get('/dbs/search','dbscontroller@search')->name('dbs.search');

    //Ippool
    route::get('/all/ippool','ippoolcontroller@index')->name('ippool.show');
    route::get('/add-ippool','ippoolcontroller@save_ippool')->name('ippool.save');
    route::get('/ippool/search','ippoolcontroller@search')->name('ippool.search');

    
});