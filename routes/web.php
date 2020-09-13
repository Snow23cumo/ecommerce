<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// Admin Section
// Categories
Route::get('admin/categories','Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category','Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('delete/category/{id}','Admin\Category\CategoryController@deletecategory');
Route::get('edit/category/{id}','Admin\Category\CategoryController@editcategory');
Route::post('update/category/{id}','Admin\Category\CategoryController@updatecategory');

// Brand
Route::get('admin/brands','Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand','Admin\Category\BrandController@storebrand')->name('store.brand');
Route::get('delete/brand/{id}','Admin\Category\BrandController@deletebrand');
Route::get('edit/brand/{id}','Admin\Category\BrandController@editbrand');
Route::post('update/brand/{id}','Admin\Category\BrandController@updatebrand');

// Subcategories
Route::get('admin/sub/category','Admin\Category\SubCategoryController@subcategories')->name('subcategories');
Route::post('admin/store/subcat','Admin\Category\SubCategoryController@storesubcat')->name('store.subcategory');
Route::get('delete/subcategory/{id}','Admin\Category\SubCategoryController@deletesubcat');
Route::get('edit/subcategory/{id}','Admin\Category\SubCategoryController@editsubcat');
Route::post('update/subcategory/{id}','Admin\Category\SubCategoryController@updatesubcat');

// Coupon
Route::get('admin/sub/coupon','Admin\Category\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon','Admin\Category\CouponController@storecoupon')->name('store.coupon');
Route::get('delete/coupon/{id}','Admin\Category\CouponController@deletecoupon');
Route::get('edit/coupon/{id}','Admin\Category\CouponController@editcoupon');
Route::post('update/coupon/{id}','Admin\Category\CouponController@updatecoupon');

// For Show Sub Category with ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@getSubcat');
// Product All Route
Route::get('admin/product/all','Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add','Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product','Admin\ProductController@store')->name('store.product');

Route::get('inactive/product/{id}','Admin\ProductController@inactive');
Route::get('active/product/{id}','Admin\ProductController@active');

Route::get('delete/product/{id}','Admin\ProductController@deleteproduct');
Route::get('view/product/{id}','Admin\ProductController@viewproduct');
Route::get('edit/product/{id}','Admin\ProductController@editproduct');

Route::post('update/product/withoutphoto/{id}', 'Admin\ProductController@UpdateProductWithoutPhoto');
Route::post('update/product/photo/{id}', 'Admin\ProductController@UpdateProductPhoto');

// Blog Admin All
Route::get('blog/category/list','Admin\PostController@blogcatlist')->name('add.blog.categorylist');
Route::post('admin/store/blog','Admin\PostController@blogcatstore')->name('store.blog.category');
Route::get('delete/blogcategory/{id}','Admin\PostController@deleteblogcategory');
Route::get('edit/blogcategory/{id}','Admin\PostController@editblogcategory');
Route::post('update/blogcategory/{id}', 'Admin\PostController@updateblogcategory');
// Post
Route::get('admin/add/post','Admin\PostController@create')->name('add.blogpost');
Route::get('admin/list/post','Admin\PostController@index')->name('all.blogpost');
Route::post('admin/store/post','Admin\PostController@store')->name('store.post');
Route::get('delete/post/{id}','Admin\PostController@delete');
Route::get('admin/edit/post/{id}','Admin\PostController@edit');
Route::post('update/post/{id}', 'Admin\PostController@update');


// Newslater
Route::get('admin/newslater','Admin\Category\CouponController@newslater')->name('admin.newslater');
Route::get('delete/sub/{id}','Admin\Category\CouponController@deletesub');
// Fronted All routes
Route::post('store/newslater','FrontController@storenewslater')->name('store.newslater');

// ADD Wishlist
Route::get('add/wishlist/{id}','WishlistController@addwishlist');