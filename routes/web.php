<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\CustomerController as ControllersCustomerController;

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

Route::group(['prefix' => ''], function(){
    Route::get('',[HomeController::class,'index'])->name('cus.index');
    Route::post('search',[HomeController::class,'search'])->name('cus.search');
    Route::get('shop',[HomeController::class,'shop'])->name('cus.shop');
    Route::get('shop/category/{id}-{slug}',[HomeController::class,'shop_cat'])->name('cus.category');
    Route::get('about',[HomeController::class,'about'])->name('cus.about');
    Route::get('contact',[HomeController::class,'contact'])->name('cus.contact');
    Route::get('blog',[HomeController::class,'blog'])->name('cus.blog');
    Route::get('detail/{product}',[HomeController::class,'detail'])->name('cus.detail');
    Route::post('detail/{product}',[HomeController::class,'comment']);
    Route::get('login',[ControllersCustomerController::class,'login'])->name('cus.login');
    Route::post('login',[ControllersCustomerController::class,'sign_in']);
    Route::get('register',[ControllersCustomerController::class,'register'])->name('cus.register');
    Route::post('register',[ControllersCustomerController::class,'post_register']);
    // forgot password
    Route::get('reset-password',[ControllersCustomerController::class,'form_check_email'])->name('password.reset');
    Route::post('reset-password',[ControllersCustomerController::class,'submit_form_check_email']);
    Route::get('confirm/{token}',[ControllersCustomerController::class,'confirm_email'])->name('email.confirm');
    Route::post('confirm/{token}',[ControllersCustomerController::class,'submit_password']);
    // profile
    Route::get('profile',[ControllersCustomerController::class,'profile'])->name('cus.profile')->middleware('cus');
    Route::get('/password',[ControllersCustomerController::class,'form_password'])->name('cus.form-password')->middleware('cus');
    Route::get('/logout',[ControllersCustomerController::class,'logout'])->name('cus.logout')->middleware('cus');
    Route::put('/update/{customer}',[ControllersCustomerController::class,'update'])->name('cus.update')->middleware('cus');
    Route::put('/upload/{customer}',[ControllersCustomerController::class,'upload_avatar'])->name('cus.upload')->middleware('cus');
    Route::put('/password/{customer}',[ControllersCustomerController::class,'update_password'])->name('cus.password')->middleware('cus');
    Route::get('pdf/{order}',[ControllersCustomerController::class,'pdf'])->name('pdf');
});

Route::group(['prefix' => 'wishlist'],function(){
    Route::get('',[ControllersCustomerController::class,'wishlist'])->name('cus.wishlist')->middleware('cus');
    Route::get('add/{product}',[WishListController::class,'add'])->name('wishlist.add');
    Route::get('remove/{product}',[WishListController::class,'remove'])->name('wishlist.remove');
});

Route::group(['prefix' => 'cart'],function(){
    Route::get('',[CartController::class,'index'])->name('cart.index');
    Route::get('add/{product}',[CartController::class,'add'])->name('cart.add');
    Route::get('delete/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::get('clear',[CartController::class,'clear'])->name('cart.clear');
    Route::get('update/{id}',[CartController::class,'update'])->name('cart.update');
    Route::post('updateAjax',[CartController::class,'updateAjax'])->name('cart.updateAjax');
});


Route::group(['prefix' => 'checkout'],function(){
    Route::get('',[CheckoutController::class,'index'])->name('cus.checkout')->middleware('cus');
    Route::post('',[CheckoutController::class,'checkout'])->name('checkout')->middleware('cus');
});
// admin login route
Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'checkLogin']);

Route::group(['prefix' => 'admin','middleware' => 'auth'] , function(){
    // logout admin.
    Route::get('logout',[AdminController::class,'logout'])->name('admin.logout');
    // main admin page route
    Route::get('',[AdminController::class,'index'])->name('admin.index');
    // Category trash
    Route::get('/category/trash',[CategoryController::class,'trash'])->name('category.trash');
    Route::get('/category/restore/{id}',[CategoryController::class,'restoreTrash'])->name('category.restore');
    Route::get('/category/remove/{id}',[CategoryController::class,'forceDelete'])->name('category.remove');
    // Product Trash
    Route::get('/product/trash',[ProductController::class,'trash'])->name('product.trash');
    Route::get('/product/restore/{id}',[ProductController::class,'restoreTrash'])->name('product.restore');
    Route::get('/product/remove/{id}',[ProductController::class,'forceDelete'])->name('product.remove');
    // Customer trash
    Route::get('/customer/trash',[CustomerController::class,'trash'])->name('customer.trash');
    Route::get('/customer/restore/{id}',[CustomerController::class,'restoreTrash'])->name('customer.restore');
    Route::get('/customer/remove/{id}',[CustomerController::class,'forceDelete'])->name('customer.remove');
    // Order trash
    Route::get('/order/trash',[OrderController::class,'trash'])->name('order.trash');
    Route::get('/order/restore/{id}',[OrderController::class,'restoreTrash'])->name('order.restore');
    Route::get('/order/remove/{id}',[OrderController::class,'forceDelete'])->name('order.remove');
    Route::get('order/status/{order}',[OrderController::class,'status'])->name('order.status');

    Route::resources([
        'account' => 'AccountController',
        'category' => 'CategoryController',
        'product' => 'ProductController',
        'customer' => 'CustomerController',
        'order' => 'OrderController'
    ]);

    Route::get('/account/{account}',[AccountController::class,'remove'])->name('account.remove');
});
