<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Staff; // ✅ Staff મોડલ ઉમેર્યું છે
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // ૧. ડેશબોર્ડનો ડેટા બતાવવા માટે
    public function index() 
    {
        $data = [
            'total_clients'   => Client::count(),
            'total_invoices'  => Invoice::count(),
            'total_revenue'   => Invoice::where('status', 'paid')->sum('total'),
            'pending_count'   => Invoice::where('status', 'pending')->count(),
            'recent_invoices' => Invoice::with('client')->latest()->take(5)->get(),
            
            // HR Staff નું કાઉન્ટ અહીં એડ કર્યું છે 👇
            'hr_staff_count'  => Staff::count(), 
        ];

        return view('dashboard', $data);
    }

    // ૨. લોગિન પ્રોસેસ કરવા માટે
    public function handleLogin(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'ઈમેલ અથવા પાસવર્ડ ખોટો છે!']);
    }

    // ૩. લોગઆઉટ કરવા માટે
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}