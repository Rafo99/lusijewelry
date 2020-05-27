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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/', 'PagesController@index')->name('home');

        Route::get('golden/{id}', 'CategoriesController@gold')
            ->where('id', '^[0-9]+$')
            ->name('golden.show');

        Route::get('engagement-rings', 'CategoriesController@engagementRings')
            ->name('engagementRings.show');

        Route::get('gifts', 'CategoriesController@gifts')
            ->name('gifts.show');

        Route::get('product/{id}', 'ProductsController@show')
            ->where('id', '^[0-9]+$')
            ->name('product.show');

        Route::get('order/{id}', 'OrdersController@showOrder')
            ->where('id', '^[0-9]+$')
            ->name('order.show');

        Route::post('order/{id}', 'OrdersController@makeOrder')
            ->name('order.make');

        Route::get('services/{id}', 'ServiceController@show')
            ->name('services.show');

        Route::get('contact', 'PagesController@contact')
            ->name('contact');

        Route::post('contact', 'PagesController@contacting')
            ->name('contacting');

        Route::get('about', 'PagesController@about')
            ->name('about');

        Route::get('location', 'PagesController@location')
            ->name('location');

//        Route::get('sales', 'PagesController@sales')
//            ->name('sales');

    });

// Cart
//Route::get('cart/total', 'CartController@total')->name('cart.total');
//Route::put('cart', 'CartController@add')->name('cart.add');
//Route::delete('cart/{id}', 'CartController@remove')->name('cart.remove');
//Route::get('cart/empty', 'CartController@empty')->name('cart.empty');
//Route::post('cart/order', 'CartController@order') ->name('order');


// Images And Thumbnails
Route::get('/image/{picture}', 'ProductsController@showImage')->name('show.image');
Route::get('/thumb/{picture}', 'ProductsController@showThumb')->name('show.thumb');


// Admin
Route::prefix('admin')->group(function () {
    //Auth
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {

    Route::get('/categories', 'Admin\CategoriesController@index')->name('admin.categories');
    Route::put('/categories', 'Admin\CategoriesController@store')->name('admin.categories.store');
    Route::get('/categories/add', 'Admin\CategoriesController@create')->name('admin.categories.create');
    Route::get('/categories/{id}', 'Admin\CategoriesController@show')->name('admin.categories.show');
    Route::post('/categories/{id}', 'Admin\CategoriesController@update')->name('admin.categories.update');
    Route::get('/categories/edit/{id}', 'Admin\CategoriesController@edit')->name('admin.categories.edit');
    Route::delete('/categories/{id}', 'Admin\CategoriesController@destroy')->name('admin.categories.destroy');

    Route::get('/products', 'Admin\ProductsController@index')->name('admin.products');
    Route::put('/products', 'Admin\ProductsController@store')->name('admin.products.store');
    Route::get('/products/add', 'Admin\ProductsController@create')->name('admin.products.create');
    Route::get('/products/{id}', 'Admin\ProductsController@show')->name('admin.products.show');
    Route::post('/products/{id}', 'Admin\ProductsController@update')->name('admin.products.update');
    Route::get('/products/edit/{id}', 'Admin\ProductsController@edit')->name('admin.products.edit');
    Route::delete('/products/{id}', 'Admin\ProductsController@destroy')->name('admin.products.destroy');

    Route::get('/orders', 'Admin\OrdersController@index')->name('admin.orders');
    Route::get('/preparation_orders', 'Admin\OrdersController@index_preparation')->name('admin.preparation.orders');
    Route::get('/orders/{id}', 'Admin\OrdersController@show')->name('admin.orders.show');
    Route::post('/orders/{id}', 'Admin\OrdersController@update')->name('admin.orders.update');
    Route::get('/orders/edit/{id}', 'Admin\OrdersController@edit')->name('admin.orders.edit');
    //Route::delete('/orders/{id}', 'Admin\OrdersController@delete')->name('admin.orders.destroy');
});

