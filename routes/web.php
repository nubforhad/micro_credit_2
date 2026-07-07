<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BranchController; 
use App\Http\Controllers\AreaController; 
use App\Http\Controllers\CenterController; 
use App\Http\Controllers\MemberController; 
use App\Http\Controllers\SavingController; 
use App\Http\Controllers\LoanController; 
use App\Http\Controllers\LoanProductController; 
use App\Http\Controllers\LoanInstallmentController; 
use App\Http\Controllers\LoanPaymentController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    // company 
    Route::resource('company', CompanyController::class);
    // branch route 
    Route::resource('branch', BranchController::class);
    // area route
    Route::resource('area', AreaController::class);
    // center route
    Route::resource('center', CenterController::class);
    // member route
    Route::resource('member', MemberController::class);
        Route::get('member/{id}/ledger', [MemberController::class,'ledger'])->name('member.ledger');
    // savings route
    Route::resource('saving', SavingController::class);
    Route::resource('loan', LoanController::class);
    // loan approve route
    Route::put('/loan/{id}/approve', [LoanController::class,'approve']) ->name('loan.approve');
    // loan product 
    Route::resource('loan-product', LoanProductController::class);
    // loan installment 
    Route::get('/installment', [LoanInstallmentController::class, 'index'])->name('installment.index');
    Route::post('/installment/pay/{id}', [LoanInstallmentController::class, 'pay'])->name('installment.pay');
    Route::get('/installment/search', [LoanInstallmentController::class, 'searchPage'])->name('installment.search');

    Route::get('/installment/search/result', [LoanInstallmentController::class, 'searchResult'])->name('installment.search.result');
    // overdue route 
    Route::get('/overdue', [LoanInstallmentController::class, 'overdue'])->name('installment.overdue');
    Route::put('/loan/close/{id}', [LoanController::class, 'close'])->name('loan.close');

    // loan payment history route
    Route::get('payment-history', [LoanPaymentController::class, 'index'])->name('loan.payment.index');
    Route::get('payment-history/{id}', [LoanPaymentController::class, 'show'])->name('loan.payment.show');
    Route::get('payment-history/{id}/print', [LoanPaymentController::class, 'print'])->name('loan.payment.print');
    //     Route::get('/so', function () {
    //     return view('modules.payment.index');
    // });


});

require __DIR__.'/auth.php';


 