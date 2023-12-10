<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;


use Illuminate\Http\Request;

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


route::get('/',[HomeController::class,'index']);
route::get('/blog_list',[HomeController::class,'blog_list']);
route::get('/about',[HomeController::class,'about']);
route::get('/testimonial',[HomeController::class,'testimonial']);
route::get('/contact',[HomeController::class,'contact']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    route::get('/redirect',[HomeController::class,'redirect']); 

    route::get('/products',[HomeController::class,'products']);

    route::get('/categories',[HomeController::class,'categories']);
    //admin

    route::get('/view_category',[AdminController::class,'view_category']);
    
    route::post('/add_category',[AdminController::class,'add_category']);

    route::get('/delete_category/{id}',[AdminController::class,'delete_category']);

    route::get('/view_product',[AdminController::class,'view_product']);

    route::post('/add_product',[AdminController::class,'add_product']);

    route::get('/show_product',[AdminController::class,'show_product']);
    
    route::get('/delete_product/{id}',[AdminController::class,'delete_product']);

    route::get('/update_product/{id}',[AdminController::class,'update_product']);
    
    route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

    route::get('/order',[AdminController::class,'order']);

    route::get('/delivered/{id}',[AdminController::class,'delivered']);
    
    route::get('/send_email/{id}',[AdminController::class,'send_email']);

    route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);

    route::get('/search',[AdminController::class,'searchdata']);


    //home
    route::get('/product_details/{id}',[HomeController::class,'product_details']);

    route::get('/products_cat/{id}',[HomeController::class,'products_cat']);

    route::post('/add_cart/{id}',[HomeController::class,'add_cart']);

    route::get('/show_cart',[HomeController::class,'show_cart']);

    route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);

    route::get('/cash_order',[HomeController::class,'cash_order']);

    route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);

    route::post('/stripe/{totalprice}',[HomeController::class, 'stripePost'])->name('stripe.post');

    route::get('/show_order',[HomeController::class,'show_order']);

    route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);

    route::get('/product_search',[HomeController::class,'product_search']);

    route::get('/product_search2',[HomeController::class,'product_search2']);

});