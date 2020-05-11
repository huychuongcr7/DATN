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

Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', function () {
            return redirect()->route('login');
        });
        Auth::routes(['reset' => false, 'register' => false]);

        Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

            Route::resource('customers', 'CustomerController');
            Route::post('customers/{id}/stop_customers', 'CustomerController@stop')->name('customers.stop_customers');
            Route::post('customers/{id}/active_customers', 'CustomerController@active')->name('customers.active_customers');
            Route::get('customers/{id}/payment', 'CustomerController@getPayment')->name('customers.payment');
            Route::put('customers/{id}/put_payment', 'CustomerController@putPayment')->name('customers.put_payment');

            Route::resource('products', 'ProductController');
            Route::get('export', 'ProductController@export')->name('products.export');
            Route::post('import', 'ProductController@import')->name('products.import');
            Route::post('products/{id}/stop_products', 'ProductController@stop')->name('products.stop');
            Route::post('products/{id}/active_products', 'ProductController@active')->name('products.active');

            Route::resource('suppliers', 'SupplierController');
            Route::post('suppliers/{id}/stop_suppliers', 'SupplierController@stop')->name('suppliers.stop_suppliers');
            Route::post('suppliers/{id}/active_suppliers', 'SupplierController@active')->name('suppliers.active_suppliers');
            Route::get('suppliers/{id}/payment', 'SupplierController@getPayment')->name('suppliers.payment');
            Route::put('suppliers/{id}/put_payment', 'SupplierController@putPayment')->name('suppliers.put_payment');

            Route::resource('import_orders', 'ImportOrderController');

            Route::resource('bills', 'BillController');
        });

    });
});

Route::namespace('Customer')->group(function () {
    Route::group(['prefix' => '/customer'], function() {
        Route::get('/login', 'LoginController@showLoginForm');
        Route::post('/login', 'LoginController@login')->name('customer.login');
        Route::post('/logout','LoginController@logout')->name('customer.logout');
        Route::group(['middleware' => ['auth:customer']], function () {
            Route::get('/', 'CustomerController@index')->name('customer.dashboard');
        });
    });
});

Route::get('/', 'Customer\HomeController@index')->name('welcome');
