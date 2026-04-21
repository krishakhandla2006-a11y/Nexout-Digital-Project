<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;

// ૧. સાઈટ ખોલતા જ પહેલા Login પેજ આવશે
Route::get('/', function () {
    return redirect()->route('login');
});

// ૨. આ બધા પેજ હવે 'auth' (લોગિન) વગર નહીં ખુલે
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clients
    Route::resource('clients', ClientController::class);

    // Invoice
    Route::get('/invoice/create', [InvoiceController::class, 'create']);
    Route::post('/invoice/store', [InvoiceController::class, 'store']);
    Route::get('/invoice/paid/{id}', [InvoiceController::class, 'paid']);
    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'download']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Laravel ના ડિફોલ્ટ Auth રૂટ્સ (Login/Register માટે)
require __DIR__.'/auth.php';