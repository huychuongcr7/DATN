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
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Auth::routes(['reset' => false, 'register' => false]);

    Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

        Route::resource('customers', 'Admin\CustomerController');
    });

});

