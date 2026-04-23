<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;

// ================= LOGIN =================

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {

    $fixedPassword = "252006";

    if ($request->password === $fixedPassword) {
        session(['user' => $request->email]);
        return redirect('/dashboard');
    } else {
        return back()->with('error', 'Wrong Password');
    }
});

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/login');
});

// ================= PROTECTED =================

// 👉 manual check inside route

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return app(DashboardController::class)->index();
})->name('dashboard');

// Clients
Route::resource('clients', ClientController::class);

// Invoice
Route::get('/invoice/create', [InvoiceController::class, 'create']);
Route::post('/invoice/store', [InvoiceController::class, 'store']);
Route::get('/invoice/paid/{id}', [InvoiceController::class, 'paid']);
Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'download']);

// Profile
Route::get('/profile', function () {
    if (!session()->has('user')) {
        return redirect('/login');
    }
    return app(ProfileController::class)->edit();
})->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');