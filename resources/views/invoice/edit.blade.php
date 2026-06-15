@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-5 md:p-8 rounded-2xl shadow-lg border border-gray-100">
    <div class="mb-6 text-center">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Edit Invoice</h2>
        <p class="text-gray-500 text-xs md:text-sm mt-1">Update invoice details below.</p>
    </div>
    
    <form method="POST" action="{{ route('invoice.update', $invoice->id) }}" class="space-y-4 md:space-y-5">
        @csrf
        @method('PUT')
        
        {{-- Select Client --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Select Client</label>
            <div class="relative">
                <select name="client_id" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition appearance-none cursor-pointer" required>
                    <option value="">-- Choose Client --</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}" {{ $invoice->client_id == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Invoice Number --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Invoice Number</label>
            <input type="text" name="invoice_no" value="{{ $invoice->invoice_no }}"
                placeholder="Enter Invoice No (e.g. INV-101)"
                class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition"
                required>
        </div>

        {{-- ✅ Invoice Date - Custom Date Picker --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Invoice Date</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <input type="date" name="invoice_date" id="invoice_date"
                    value="{{ $invoice->invoice_date ? date('Y-m-d', strtotime($invoice->invoice_date)) : date('Y-m-d') }}"
                    class="w-full pl-10 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition cursor-pointer"
                    required>
            </div>
            {{-- Quick Date Buttons --}}
            <div class="flex gap-2 mt-2 flex-wrap">
                <button type="button" onclick="setDate('today')" class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">Today</button>
                <button type="button" onclick="setDate('yesterday')" class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Yesterday</button>
                <button type="button" onclick="setDate('tomorrow')" class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Tomorrow</button>
                <button type="button" onclick="setDate('week')" class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Next Week</button>
                <button type="button" onclick="setDate('month')" class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Next Month</button>
            </div>
        </div>

        {{-- Amount --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Service Amount (₹)</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500 font-medium">₹</span>
                <input type="number" name="amount" step="0.01" placeholder="0.00" 
                    value="{{ $invoice->amount }}"
                    class="w-full pl-8 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition" required>
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5 ml-1">Service Particulars</label>
            <textarea name="description" rows="3" placeholder="Describe the service (e.g. Social Media Marketing)" 
                class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white focus:outline-none transition" required>{{ $invoice->description }}</textarea>
        </div>

        {{-- Submit --}}
        <div class="pt-2">
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 shadow-lg shadow-green-100 transition duration-200 flex justify-center items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Invoice
            </button>
            <a href="{{ route('dashboard') }}" class="block text-center mt-4 text-sm text-gray-500 hover:text-gray-700 font-medium transition">
                Cancel and Go Back
            </a>
        </div>
    </form>
</div>

{{-- Date Picker Script --}}
<script>
    function setDate(type) {
        const dateInput = document.getElementById('invoice_date');
        const today = new Date();
        let newDate = new Date();

        switch(type) {
            case 'today':
                newDate = today;
                break;
            case 'yesterday':
                newDate.setDate(today.getDate() - 1);
                break;
            case 'tomorrow':
                newDate.setDate(today.getDate() + 1);
                break;
            case 'week':
                newDate.setDate(today.getDate() + 7);
                break;
            case 'month':
                newDate.setMonth(today.getMonth() + 1);
                break;
        }

        const year = newDate.getFullYear();
        const month = String(newDate.getMonth() + 1).padStart(2, '0');
        const day = String(newDate.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;
    }
</script>
@endsection