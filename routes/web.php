<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BranchController; 
use App\Http\Controllers\AreaController; 
use App\Http\Controllers\CenterController; 
use App\Http\Controllers\MemberController; 

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
});

require __DIR__.'/auth.php';


 