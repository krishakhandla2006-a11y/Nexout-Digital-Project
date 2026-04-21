@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-5 md:p-8 rounded-2xl shadow-lg border border-gray-100">
    <div class="mb-6 text-center">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Generate New Invoice</h2>
        <p class="text-gray-500 text-xs md:text-sm mt-1">Fill in the details to create a professional invoice.</p>
    </div>
    
    <form method="POST" action="/invoice/store" class="space-y-4 md:space-y-5">
        @csrf
        
        {{-- Select Client --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Select Client</label>
            <div class="relative">
                <select name="client_id" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition appearance-none cursor-pointer" required>
                    <option value="">-- Choose Client --</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- ✅ Invoice Number (NEW ADDED) --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Invoice Number</label>
            <input type="text" name="invoice_no" 
                placeholder="Enter Invoice No (e.g. INV-101)"
                class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition"
                required>
        </div>

        {{-- Amount --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Service Amount (₹)</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500 font-medium">₹</span>
                <input type="number" name="amount" step="0.01" placeholder="0.00" 
                    class="w-full pl-8 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition" required>
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Service Particulars</label>
            <textarea name="description" rows="3" placeholder="Describe the service (e.g. Social Media Marketing)" 
                class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition" required>Social Media Marketing</textarea>
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition duration-200 flex justify-center items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Create Invoice
            </button>
            <a href="/dashboard" class="block text-center mt-4 text-sm text-gray-500 hover:text-gray-700 font-medium transition">
                Cancel and Go Back
            </a>
        </div>
    </form>
</div>
@endsection