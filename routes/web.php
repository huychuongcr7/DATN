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
            Route::group(['middleware' => 'can:admin'], function () {
                Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

                Route::resource('customers', 'CustomerController');
                Route::put('customers/{id}/stop_customers', 'CustomerController@stop')->name('customers.stop_customers');
                Route::put('customers/{id}/active_customers', 'CustomerController@active')->name('customers.active_customers');
                Route::get('customers/{id}/payment', 'CustomerController@getPayment')->name('customers.payment');
                Route::put('customers/{id}/put_payment', 'CustomerController@putPayment')->name('customers.put_payment');

                Route::resource('products', 'ProductController');
                Route::get('export', 'ProductController@export')->name('products.export');
                Route::post('import', 'ProductController@import')->name('products.import');
                Route::post('products/{id}/stop_products', 'ProductController@stop')->name('products.stop');
                Route::post('products/{id}/active_products', 'ProductController@active')->name('products.active');
                Route::get('products/{id}/export_import', 'ProductController@exportImportHistory')->name('products.export_import');

                Route::resource('suppliers', 'SupplierController');
                Route::post('suppliers/{id}/stop_suppliers', 'SupplierController@stop')->name('suppliers.stop_suppliers');
                Route::post('suppliers/{id}/active_suppliers', 'SupplierController@active')->name('suppliers.active_suppliers');
                Route::get('suppliers/{id}/payment', 'SupplierController@getPayment')->name('suppliers.payment');
                Route::put('suppliers/{id}/put_payment', 'SupplierController@putPayment')->name('suppliers.put_payment');

                Route::resource('import_orders', 'ImportOrderController');

                Route::resource('bills', 'BillController');
                Route::put('bills/{id}/confirm', 'BillController@confirm')->name('bills.confirm');
                Route::post('bills/assigned', 'BillController@assigned')->name('bills.assigned');
                Route::put('bills/{id}/complete', 'BillController@complete')->name('bills.complete');
                Route::put('bills/{id}/cancel', 'BillController@cancel')->name('bills.cancel');

                Route::resource('posts', 'PostController');
                Route::post('posts/change_status', 'PostController@changeStatus');

                Route::resource('contacts', 'ContactController');
                Route::put('contacts/{id}/feedback', 'ContactController@feedback')->name('contacts.feedback');

                Route::resource('notifications', 'NotificationController')->only(['index', 'show']);

                Route::get('charts/product', 'ChartController@chartProduct')->name('charts.product');
                Route::get('charts/customer', 'ChartController@chartCustomer')->name('charts.customer');
                Route::get('charts/supplier', 'ChartController@chartSupplier')->name('charts.supplier');
                Route::get('charts/finance', 'ChartController@chartFinance')->name('charts.finance');

                Route::resource('check_inventories', 'CheckInventoryController');
                Route::put('check_inventories/{id}/balance', 'CheckInventoryController@balance')->name('check_inventories.balance');

                Route::resource('users', 'UserController');
                Route::put('users/{id}/stop_users', 'UserController@stop')->name('users.stop_users');
                Route::put('users/{id}/active_users', 'UserController@active')->name('users.active_users');

                Route::resource('categories', 'CategoryController');
            });
        });

    });
});
Route::namespace('Stocker')->group(function () {
    Route::group(['prefix' => 'stocker'], function () {
        Route::group(['middleware' => 'auth', 'as' => 'stocker.'], function () {
            Route::group(['middleware' => 'can:stocker'], function () {
                Route::resource('bills', 'BillController');
                Route::put('bills/{id}/export', 'BillController@export')->name('bills.export');

                Route::resource('import_orders', 'ImportOrderController');

                Route::resource('check_inventories', 'CheckInventoryController');
                Route::put('check_inventories/{id}/balance', 'CheckInventoryController@balance')->name('check_inventories.balance');

                Route::resource('products', 'ProductController');
                Route::get('export', 'ProductController@export')->name('products.export');
                Route::post('import', 'ProductController@import')->name('products.import');
                Route::post('products/{id}/stop_products', 'ProductController@stop')->name('products.stop');
                Route::post('products/{id}/active_products', 'ProductController@active')->name('products.active');
                Route::get('products/{id}/export_import', 'ProductController@exportImportHistory')->name('products.export_import');

                Route::resource('notifications', 'NotificationController')->only(['index', 'show']);
            });
        });
    });
});
Route::namespace('Shipper')->group(function () {
    Route::group(['prefix' => 'shipper'], function () {
        Route::group(['middleware' => 'auth', 'as' => 'shipper.'], function () {
            Route::group(['middleware' => 'can:shipper'], function () {
                Route::resource('bills', 'BillController');
                Route::put('bills/{id}/delivery', 'BillController@delivery')->name('bills.delivery');
                Route::put('bills/{id}/delivered', 'BillController@delivered')->name('bills.delivered');

                Route::resource('notifications', 'NotificationController')->only(['index', 'show']);

            });
        });
    });
});

Route::namespace('Customer')->group(function () {
    Route::get('', 'HomeController@index')->name('welcome');
    Route::resource('products', 'ProductController');
    Route::get('/products/search/name', 'ProductController@searchByName');
    Route::get('/products/search/product_code', 'ProductController@searchByProductCode');
    Route::resource('posts', 'PostController');
    Route::get('contacts', 'ContactController@create')->name('contacts.create');
    Route::post('contacts', 'ContactController@store')->name('contacts.store');
    Route::group(['prefix' => '/customer'], function () {
        Route::get('/login', 'LoginController@showLoginForm');
        Route::post('/login', 'LoginController@login')->name('customer.login');
        Route::post('/logout', 'LoginController@logout')->name('customer.logout');
        Route::group(['middleware' => ['auth:customer']], function () {
            Route::resource('customers', 'CustomerController')->only(['index', 'update']);
            Route::get('customers/{id}/get_reset', 'CustomerController@getReset')->name('customers.get_reset');
            Route::put('customers/{id}/put_reset', 'CustomerController@putReset')->name('customers.put_reset');
            Route::get('customers/bills', 'CustomerController@getBill')->name('customers.get_bill');
            Route::post('customers/bills', 'CustomerController@storeBill')->name('customers.store_bill');
            Route::delete('customers/bills', 'CustomerController@cancelBill')->name('customers.cancelBill');
            Route::get('customers/bills/create', 'CustomerController@createBill')->name('customers.create_bill');
            Route::resource('customers/carts', 'CartController')->only(['index', 'store', 'destroy', 'update']);
            Route::post('rates', 'ProductController@storeRate')->name('rates.store');
        });
    });
});
