<?php

use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class , 'index'])->name('banhang.index');
Route::get('/type/{id}', [PageController::class , 'getLoaiSp']);

Route::get('/add-to-cart/{id}', [PageController::class , 'addToCart'])->name('banhang.addtocart');
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');

Route::get('/checkout', [PageController::class , 'getCheckout'])->name('banhang.checkout');
Route::post('/checkout', [PageController::class , 'postCheckout'])->name('banhang.checkout');

Route::get('login', [PageController::class , 'getLogin'])->name('banhang.login');
Route::post('login', [PageController::class , 'postLogin'])->name('banhang.login');

Route::get('signup', [PageController::class , 'getSignup'])->name('banhang.signup');
Route::post('signup', [PageController::class , 'postSignup'])->name('banhang.signup');



Route::get('logout', [PageController::class , 'postLogout'])->name('logout');