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
use App\Http\Controllers\SavvingsController;
use App\Http\Controllers\DpsPlanController;
use App\Http\Controllers\DpsAccountController;
use App\Http\Controllers\DpsPaymentController;
use App\Http\Controllers\DpsMaturityController;
use App\Http\Controllers\DpsReportController;
use App\Http\Controllers\DpsDueController;
use App\Http\Controllers\DpsReceiptController;
use App\Http\Controllers\FundAccountController;
use App\Http\Controllers\FundTransactionController;
use App\Http\Controllers\IncomeExpenseController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\DailyCollectionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\RoleController;


Route::get('/test-permission', function(){

    return "Permission Working";

})->middleware('permission:dashboard.view');

Route::middleware(['auth','role:Super Admin'])->group(function(){

    Route::resource('roles',RoleController::class);

    Route::resource('users',UserController::class);

});


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

     Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // company 
    Route::resource('company', CompanyController::class)->middleware('permission:company.view');
    // branch route 
    Route::resource('branch', BranchController::class)->middleware('permission:branch.view');;
    // area route
    Route::resource('area', AreaController::class) ->middleware('permission:area.view');;
    // center route
    Route::resource('center', CenterController::class)->middleware('permission:center.view');;
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
    // daily report 
    Route::get('reports/daily-collection', [LoanPaymentController::class, 'dailyCollection'])->name('report.daily.collection');

    // savvings route ( name ta change)
    Route::resource('savvings', SavvingsController::class);
    Route::get('savvings/{id}/receipt', [SavvingsController::class,'receipt'])->name('savvings.receipt');
    Route::get( 'savvings/ledger/{member_id}', [SavvingsController::class,'ledger'])->name('savvings.ledger');
    Route::post('savvings/withdraw', [SavvingsController::class,'withdraw'])->name('savvings.withdraw');
    Route::get( 'savvings/withdraw-request', [SavvingsController::class,'withdrawRequest'])->name('savvings.withdraw.request');
    Route::put( 'savvings/withdraw-approve/{id}', [SavvingsController::class,'withdrawApprove'])->name('savvings.withdraw.approve');
 
    Route::put('savvings/withdraw-reject/{id}', [SavvingsController::class,'withdrawReject'])->name('savvings.withdraw.reject');
    Route::get( 'summary',[SavvingsController::class, 'summary1'])->name('savvings.summary');
    Route::get('member-summary', [SavvingsController::class, 'memberSummary1'])->name('savvings.member.summary');
    Route::get(  'savvings/member-ledger/{member_id}', [SavvingsController::class,'memberLedger'])->name('savvings.member.ledger');



    //     Route::get('/so', function () {
    //     return view('modules.payment.index');
    // });
    Route::get('savingrequests', [SavvingsController::class,'withreq'])->name('savvings.withdraw.withreqs');


    // DPS Route
    Route::resource( 'dps-plans', DpsPlanController::class);
    Route::resource( 'dps-accounts', DpsAccountController::class);
    Route::resource( 'dps-payments',  DpsPaymentController::class);
    Route::resource( 'dps-maturities', DpsMaturityController::class);
    Route::get( 'dps-reports',  [DpsReportController::class,'index'])->name('dps-reports.index');


    // Acount Fund 
    Route::resource('fund-accounts', FundAccountController::class);
    Route::get('fund-ledgers', [FundTransactionController::class,'index'])->name('fund.ledger1');
    Route::resource( 'fund-transactions', FundTransactionController::class);

    Route::get('/fund-ledger', [FundTransactionController::class, 'ledger'])->name('ledgers.account');


 // income expanse route
Route::resource( 'income-expenses', IncomeExpenseController::class);


// cash book route
Route::get( 'cash-book', [CashBookController::class,'index'])->name('cash-book.index');



// daily collection route
    Route::get( 'daily-collection', [DailyCollectionController::class,'index'])->name('daily-collection.index');

    Route::get( 'reports/dashboard', [ReportController::class,'dashboard'])->name('reports.dashboard');

Route::get('dps-receipt/{id}', [DpsReceiptController::class,'show'])->name('dps-receipt.show');
Route::get( 'dps-due', [DpsDueController::class,'index'])->name('dps-due.index');});

require __DIR__.'/auth.php';

