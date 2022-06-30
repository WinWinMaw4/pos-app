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
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/pos',PosController::class);


Route::middleware('auth')->group(function(){
    Route::get('/search',[HomeController::class,'search'])->name('search');
    Route::resource('/category',CategoryController::class);
    Route::get('/category-type-detail/{categoryId}',[CategoryController::class,'categoryTypeDetail'])->name('categoryTypeDetail');
    Route::resource('/item',ItemController::class);
    Route::get('/popular-item',[ItemController::class,'popularItem'])->name('popularItem');
    Route::post('/store-voucher',[VoucherController::class,'storeVoucher']);
    Route::get('/income',[IncomeController::class,'toDayInCome'])->name('toDayInCome');
    Route::get('/all-income-list',[IncomeController::class,'allInComeVouchers'])->name('allInComeVouchers');

    Route::get('/daily-income',[IncomeController::class,'dailyInCome'])->name('dailyInCome');
    Route::get('/monthly-income',[IncomeController::class,'monthlyInCome'])->name('monthlyInCome');

    Route::post('/income/total-today',[IncomeController::class,'totalToday'])->name('totalToday');
    Route::post('/income/total-monthly',[IncomeController::class,'totalMonthly'])->name('totalMonthly');

    Route::get('/voucher-detail/{voucherId}',[VoucherController::class,'voucherDetail'])->name('voucherDetail');
    Route::get('/daily-voucher-list/{voucherDate}',[VoucherController::class,'voucherListDaily'])->name('voucherListDaily');

    Route::get('/dashboard',[HomeController::class,'dashboardView'])->name('dashboardView');

//
//    Route::get('/report',function (){
////        return view('reportPDF.todayInComePdf');
////        $pdf = App::make('dompdf.wrapper');
////        return $pdf->stream();
//
//        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reportPDF.todayInComePdf');
//        return $pdf->download(date('d-m-y').'_InCome.pdf');
//
//    });

    Route::get('/report-pdf',[ReportController::class,'toDayInComePDFView']);
    Route::get('download-pdf', [ReportController::class, 'downloadPDF'])->name('download-pdf');

});

