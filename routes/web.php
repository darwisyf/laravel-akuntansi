<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/transaksi-list', [TransaksiController::class, 'index']);
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
    Route::get('/transaksi', function () {return view('transaksi');})->name('transaksi');
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class,'destroy']);
    Route::get('/transaksi-export-pdf', [TransaksiController::class,'exportPdf']);
});

Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');

require __DIR__.'/auth.php';
