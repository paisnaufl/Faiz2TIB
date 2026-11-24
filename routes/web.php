<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');

Route::group(['middleware'=>['checkislogin']],function(){
    Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    Route::resource('pelanggan', PelangganController::class);

    Route::resource('portofolio', PortofolioController::class);

    Route::resource('user', UserController::class);

    Route::get('/', [HomeController::class,'index']);

    Route::post('question/store', [QuestionController::class, 'store'])
            ->name('question.store');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['checkrole:Super Admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

    Route::middleware(['checkrole:Super Admin,mitra'])->group(function () {
        Route::resource('pelanggan', PelangganController::class);
    });
});

