<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
    {
        $data = [
            'total_clients'   => Client::count(),
            'total_invoices'  => Invoice::count(),
            'total_revenue'   => Invoice::where('status', 'paid')->sum('total'),
            'pending_count'   => Invoice::where('status', 'pending')->count(),
            'recent_invoices' => Invoice::with('client')->latest()->take(5)->get(),
        ];

        return view('dashboard', $data);
    }

    public function handleLogin(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'ઈમેલ અથવા પાસવર્ડ ખોટો છે!']);
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}