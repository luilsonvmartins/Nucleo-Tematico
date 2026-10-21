<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// ----- Site público -----
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/animais', [AnimalController::class, 'index'])->name('animais.index');
Route::get('/animais/{animal}', [AnimalController::class, 'show'])->name('animais.show');

Route::get('/doar', [DonationController::class, 'create'])->name('doacoes.create');
Route::post('/doar', [DonationController::class, 'store'])->name('doacoes.store');

Route::get('/denunciar', [ReportController::class, 'create'])->name('denuncias.create');
Route::post('/denunciar', [ReportController::class, 'store'])->name('denuncias.store');

// ----- Login do painel -----
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----- Painel administrativo -----
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('animais', Admin\AnimalController::class)
        ->parameters(['animais' => 'animal'])
        ->except(['show']);

    Route::get('doacoes', [Admin\DonationController::class, 'index'])->name('doacoes.index');
    Route::patch('doacoes/{donation}', [Admin\DonationController::class, 'update'])->name('doacoes.update');
    Route::delete('doacoes/{donation}', [Admin\DonationController::class, 'destroy'])->name('doacoes.destroy');

    Route::get('denuncias', [Admin\ReportController::class, 'index'])->name('denuncias.index');
    Route::get('denuncias/{report}', [Admin\ReportController::class, 'show'])->name('denuncias.show');
    Route::patch('denuncias/{report}', [Admin\ReportController::class, 'update'])->name('denuncias.update');
    Route::delete('denuncias/{report}', [Admin\ReportController::class, 'destroy'])->name('denuncias.destroy');
});
