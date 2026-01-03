<?php


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/show/{id}', 'UserController@show')->name('users.show');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.destroy');


    Route::get('/laundry-types', 'LaundryTypeController@index')->name('laundry-types.index');
    Route::get('/laundry-types/create', 'LaundryTypeController@create')->name('laundry-types.create');
    Route::post('/laundry-types/store', 'LaundryTypeController@store')->name('laundry-types.store');
    Route::get('/laundry-types/edit/{id}', 'LaundryTypeController@edit')->name('laundry-types.edit');
    Route::post('/laundry-types/update/{id}', 'LaundryTypeController@update')->name('laundry-types.update');
    Route::get('/laundry-types/delete/{id}', 'LaundryTypeController@destroy')->name('laundry-types.destroy');

    Route::get('/laundry-packages', 'LaundryPackageController@index')->name('laundry-packages.index');
    Route::get('/laundry-packages/create', 'LaundryPackageController@create')->name('laundry-packages.create');
    Route::post('/laundry-packages/store', 'LaundryPackageController@store')->name('laundry-packages.store');
    Route::get('/laundry-packages/edit/{id}', 'LaundryPackageController@edit')->name('laundry-packages.edit');
    Route::post('/laundry-packages/update/{id}', 'LaundryPackageController@update')->name('laundry-packages.update');
    Route::get('/laundry-packages/delete/{id}', 'LaundryPackageController@destroy')->name('laundry-packages.destroy');

    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/create', 'OrderController@create')->name('orders.create');
    Route::post('/orders/store', 'OrderController@store')->name('orders.store');
    Route::get('/orders/show/{id}', 'OrderController@show')->name('orders.show');
    Route::post('/orders/{id}/status', 'OrderController@updateStatus')
        ->name('orders.updateStatus');


    Route::get('/orders/{id}/payment', 'PaymentController@create')->name('payments.create');
    Route::post('/orders/{id}/payment', 'PaymentController@store')->name('payments.store');

    Route::get('/orders/{id}/invoice', 'InvoiceController@show')->name('invoices.show');
    Route::post('/orders/{id}/invoice/generate', 'InvoiceController@generate')->name('invoices.generate');

    Route::get('/reports/orders', 'ReportController@orders')->name('reports.orders');
    Route::get('/reports/payments', 'ReportController@payments')->name('reports.payments');
    Route::get('/reports/invoices', 'ReportController@invoices')->name('reports.invoices');
});
// AUTH
// LOGIN (HANYA UNTUK BELUM LOGIN)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'AuthController@showLogin')->name('login');
    Route::post('/login', 'AuthController@login')->name('login.post');

    Route::get('/registrasi', 'RegistrasiController@index')->name('registrasi');
});
Route::post('/logout', 'AuthController@logout')->name('logout');
