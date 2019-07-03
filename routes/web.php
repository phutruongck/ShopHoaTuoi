<?php

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('client.home');

Route::get('/login', 'AccountController@showLoginForm')->name('login');
Route::get('/register', 'AccountController@showRegisterForm')->name('register');

Route::post('/register', 'AccountController@submitRegister');
Route::post('/login', 'AccountController@submitLogin');

Route::get('/show-all-product', 'ProductController@showAllProduct')->name('show-all-product');
Route::get('/all-product', 'ProductController@allProduct')->name('all-product');

// Cart Controller
Route::group(['middleware' => ['web']], function () {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/add-to-cart/{id}', 'CartController@getAddToCart')->name('add-to-cart');
    Route::get('/get-cart', 'CartController@getCart')->name('get-cart');
    Route::get('/sub-to-cart/{id}&qty={qty}', 'CartController@getSubToCart')->name('sub-to-cart');

    Route::get('/payment', 'PaymentController@index')->name('payment');
    Route::post('/submit-payment', 'PaymentController@submitPayment')->name('submit-payment');
    Route::get('/completed-payment', 'PaymentController@completedPayment')->name('completed-payment');
});

Route::get('/show-six-product', 'ProductController@showSixProduct')->name('show-six-product');
Route::get('/show-popular-product', 'ProductController@showPopularProduct')->name('show-popular-product');

Route::get('/product-category/{id}', 'ProductCategoryController@index');
Route::post('/show-product-category', 'ProductCategoryController@showOnceProductCategory')->name('show-product-category');
Route::post('/show-four-product', 'ProductController@showFourProduct')->name('show-four-product');

Route::get('/get-product-category', 'ProductCategoryController@getProductCategory')->name('get-product-category');

Route::get('/get-province', 'ProvinceController@getProvince')->name('get-province');

Route::get('/product-detail/{id}', 'ProductController@index');
Route::post('/show-product-detail', 'ProductController@showOnceProduct')->name('show-product-detail');

Route::group(['prefix' => 'auth',  'middleware' => 'auth'], function()
{
    Route::get('/get-data-user', 'UserController@getDataUser')->name('get-data-user');
    Route::get('/info-payment', 'UserController@infoPayment')->name('info-payment');
    Route::get('/get-info-payment', 'UserController@getInfoPayment')->name('get-info-payment');

    Route::post('/update-payment', 'UserController@updatePayment')->name('update-payment');

    Route::get('/order', 'UserController@getOrder')->name('order');
    Route::get('/get-list-order', 'UserController@getListOrder')->name('get-list-order');

    Route::get('/change-password', 'UserController@changePassword')->name('change-password');
    Route::post('/submit-change-password', 'UserController@submitChangePassword')->name('submit-change-password');

    Route::get('/logout', 'AccountController@submitLogout')->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function()
{
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::get('/get-data-user', 'AdminController@getDataUser')->name('get-data-user');

    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/get-list-user', 'AdminController@getListUser')->name('get-list-user');
    Route::get('/get-once-user', 'AdminController@getOnceUser')->name('get-once-user');

    Route::post('/delete-user', 'AdminController@deleteUser')->name('delete-user');

    Route::get('/edit-user/{id}', 'AdminController@editUser');
    Route::post('/update-user', 'AdminController@updateUser')->name('update-user');

    Route::get('/products', 'Admin\ProductController@index')->name('products');
    Route::get('/get-list-product', 'Admin\ProductController@getListProduct')->name('get-list-product');
    Route::post('/delete-product', 'Admin\ProductController@deleteProduct')->name('delete-product');
    Route::get('/edit-product/{id}', 'Admin\ProductController@editProduct');

    Route::get('/get-once-product', 'Admin\ProductController@getOnceProduct')->name('get-once-product');
    Route::post('/update-product', 'Admin\ProductController@updateProduct')->name('update-product');

    Route::get('/create-once-product', 'Admin\ProductController@createOnceProduct')->name('create-once-product');
    Route::post('/submit-create-once-product', 'Admin\ProductController@submitCreateOnceProduct')->name('submit-create-once-product');

    Route::get('/product-categories', 'Admin\ProductCategoryController@index')->name('product-categories');
    Route::get('/get-list-product-category', 'Admin\ProductCategoryController@getListProductCategory')->name('get-list-product-category');

    Route::get('/create-once-product-category', 'Admin\ProductCategoryController@createOnceProductCategory')->name('create-once-product-category');
    Route::post('/submit-create-once-product-category', 'Admin\ProductCategoryController@submitCreateOnceProductCategory')->name('submit-create-once-product-category');
    Route::get('/get-once-product-category', 'Admin\ProductCategoryController@getOnceProductCategory')->name('get-once-product-category');

    Route::post('/delete-product-category', 'Admin\ProductCategoryController@deleteProductCategory')->name('delete-product-category');
    Route::get('/edit-product-category/{id}', 'Admin\ProductCategoryController@editProductCategory');

    Route::post('/update-product-category', 'Admin\ProductCategoryController@updateProductCategory')->name('update-product-category');

    Route::get('/orders', 'Admin\OrderController@index')->name('orders');
    Route::get('/get-list-order', 'Admin\OrderController@getListOrder')->name('get-list-order');

    Route::get('/customers', 'Admin\CustomerController@index')->name('customers');
    Route::get('/get-list-customer', 'Admin\CustomerController@getListCustomer')->name('get-list-customer');
});
