<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'index'])->name('banhang.index');
Route::get('/type/{id}', [PageController::class, 'getLoaiSp']);

Route::get('/add-to-cart/{id}', [PageController::class, 'addToCart'])->name('banhang.addtocart');
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');

Route::get('/checkout', [PageController::class, 'getCheckout'])->name('banhang.checkout');
Route::post('/checkout', [PageController::class, 'postCheckout'])->name('banhang.checkout');

Route::get('login', [PageController::class, 'getLogin'])->name('banhang.login');
Route::post('login', [PageController::class, 'postLogin'])->name('banhang.login');

Route::get('signup', [PageController::class, 'getSignup'])->name('banhang.signup');
Route::post('signup', [PageController::class, 'postSignup'])->name('banhang.signup');

Route::get('logout', [PageController::class, 'postLogout'])->name('logout');

Route::get('/admin/login', [UserController::class, 'getLogin'])->name('admin.category.login');
Route::post('/admin/login', [UserController::class, 'postLogin'])->name('admin.category.login');
// Route::get('/admin/logout',[UserController::class,'getLogout'])->name('admin.category.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

    Route::group(['prefix' => 'category'], function () {
        // admin/category/danhsach
        Route::get('/cate-list', [CategoryController::class, 'getCateList'])->name('admin.cate-list');
        // Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
        // Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
        // Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
        // Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
        // Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
    });

    //viết tiếp các route khác cho crud products, users,.... thì viết tiếp

    // Route::group(['prefix'=>'bill'],function(){
    //     // admin/bill/{status}
    //     Route::get('{status}',[BillController::class,'getBillList'])->name('admin.getBillList');

    //     //by laravel request
    //     Route::get('{id}/{status}',[BillController::class,'updateBillStatus'])->name('admin.updateBillStatus');
    //     //by ajax request
    //     Route::post('updateBillStatusAjax',[BillController::class,'updateBillStatusAjax'])->name('admin.updateBillStatusAjax');

    //     Route::post('{id}',[BillController::class,'cancelBill'])->name('admin.cancelBill');
    // });

});
Route::get('/vnpay-index', function () {
    return view('/vnpay/vnpay-index');
});
// //Route xử lý nút Xác nhận thanh toán trên trang checkout.blade.php
Route::post('/vnpay/create_payment', [PageController::class, 'createPayment'])->name('postCreatePayment');
// //Route để gán cho key "vnp_ReturnUrl" ở bước 6
Route::get('/vnpay/vnpay_return', [PageController::class, 'vnpayReturn'])->name('vnpayReturn');
