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
        Route::post('customers/{id}/stop_customers', 'Admin\CustomerController@stop')->name('customers.stop_customers');
        Route::post('customers/{id}/active_customers', 'Admin\CustomerController@active')->name('customers.active_customers');
        Route::get('customers/{id}/payment', 'Admin\CustomerController@getPayment')->name('customers.payment');
        Route::put('customers/{id}/put_payment', 'Admin\CustomerController@putPayment')->name('customers.put_payment');

        Route::resource('products', 'Admin\ProductController');
        Route::get('export', 'Admin\ProductController@export')->name('products.export');
        Route::post('import', 'Admin\ProductController@import')->name('products.import');
        Route::post('products/{id}/stop_products', 'Admin\ProductController@stop')->name('products.stop');
        Route::post('products/{id}/active_products', 'Admin\ProductController@active')->name('products.active');

        Route::resource('suppliers', 'Admin\SupplierController');
        Route::post('suppliers/{id}/stop_suppliers', 'Admin\SupplierController@stop')->name('suppliers.stop_suppliers');
        Route::post('suppliers/{id}/active_suppliers', 'Admin\SupplierController@active')->name('suppliers.active_suppliers');
        Route::get('suppliers/{id}/payment', 'Admin\SupplierController@getPayment')->name('suppliers.payment');
        Route::put('suppliers/{id}/put_payment', 'Admin\SupplierController@putPayment')->name('suppliers.put_payment');

        Route::resource('import_orders', 'Admin\ImportOrderController');

        Route::resource('bills', 'Admin\BillController');
    });

});

