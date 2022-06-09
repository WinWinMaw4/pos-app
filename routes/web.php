<?php

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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\IncomeControler;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/pos',PosController::class);


Route::middleware('auth')->group(function(){
    Route::resource('/category',CategoryController::class);
    Route::get('/category-type-detail/{categoryId}',[CategoryController::class,'categoryTypeDetail'])->name('categoryTypeDetail');
    Route::resource('/item',ItemController::class);
    Route::post('/store-voucher',[VoucherController::class,'storeVoucher']);
    Route::get('/income',[IncomeControler::class,'toDayInCome'])->name('toDayInCome');
    Route::get('/all-income-list',[IncomeControler::class,'allInComeVouchers'])->name('allInComeVouchers');

    Route::get('/daily-income',[IncomeControler::class,'dailyInCome'])->name('dailyInCome');
    Route::post('/income/total-today',[IncomeControler::class,'totalToday'])->name('totalToday');
    Route::get('/voucher-detail/{voucherId}',[VoucherController::class,'voucherDetail'])->name('voucherDetail');
    Route::get('/daily-voucher-list/{voucherDate}',[VoucherController::class,'voucherListDaily'])->name('voucherListDaily');

    Route::get('/dashboard',[HomeController::class,'dashboardView'])->name('dashboardView');
});

