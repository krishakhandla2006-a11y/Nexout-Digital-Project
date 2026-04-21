@extends('layouts.app')

@section('content')
<div class="space-y-6 md:space-y-8">
    
    @if(session('success'))
    <div id="alert" class="p-4 bg-green-500 text-white rounded-xl shadow-lg flex justify-between items-center animate-pulse">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold text-sm md:text-base">{{ session('success') }}</span>
        </div>
        <button onclick="document.getElementById('alert').remove()" class="font-bold text-xl">&times;</button>
    </div>
    <script>
        setTimeout(() => { document.getElementById('alert').remove(); }, 3000);
    </script>
    @endif

    <div class="px-2 md:px-0">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Dashboard Overview</h2>
        <p class="text-gray-500 text-xs md:text-sm">Clean, minimal and professional admin summary for Nexout Digital.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        <a href="/clients" class="group block transition transform hover:scale-105">
            <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center h-full group-hover:shadow-md transition-shadow">
                <div class="p-3 bg-blue-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs md:text-sm text-gray-500 font-medium">Total Clients</p>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800">{{ $total_clients ?? '0' }}</h3>
                </div>
            </div>
        </a>

        <a href="/dashboard" class="group block transition transform hover:scale-105">
            <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center h-full group-hover:shadow-md transition-shadow">
                <div class="p-3 bg-green-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-xs md:text-sm text-gray-500 font-medium">Total Invoices</p>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800">{{ $total_invoices ?? '0' }}</h3>
                </div>
            </div>
        </a>

        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center hover:shadow-md cursor-default transition-shadow">
            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs md:text-sm text-gray-500 font-medium">Revenue</p>
                <h3 class="text-lg md:text-2xl font-bold text-gray-800">₹{{ number_format($total_revenue ?? 0, 0) }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-gray-100 flex items-center hover:shadow-md cursor-default transition-shadow">
            <div class="p-3 bg-red-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs md:text-sm text-gray-500 font-medium">Pending</p>
                <h3 class="text-xl md:text-2xl font-bold text-gray-800">{{ $pending_count ?? '0' }}</h3>
            </div>
        </div>
    </div>

    {{-- Recent Invoices Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 md:p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-700 text-sm md:text-base">Recent Invoices</h3>
            <a href="/invoice/create" class="text-xs md:text-sm text-blue-600 font-semibold hover:underline">Create New +</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px] md:min-w-full">
                <thead class="bg-gray-50 text-gray-600 text-xs md:text-sm uppercase">
                    <tr>
                        <th class="p-4 font-semibold">Invoice No</th> {{-- ID na badle Invoice No --}}
                        <th class="p-4 font-semibold">Date</th>
                        <th class="p-4 font-semibold">Client</th>
                        <th class="p-4 font-semibold">Amount</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700 text-sm">
                    @forelse($recent_invoices as $inv)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-bold text-blue-600">#{{ $inv->invoice_no }}</td> {{-- # sathe invoice no --}}
                        <td class="p-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($inv->created_at)->format('d M, Y') }}
                        </td>
                        <td class="p-4 font-medium text-gray-900">{{ $inv->client->name }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800">₹{{ number_format($inv->total, 2) }}</div>
                            <div class="text-[10px] text-gray-400 italic">Rupees Only</div> {{-- Rupees Only added --}}
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-full text-[10px] md:text-xs font-bold {{ $inv->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ strtoupper($inv->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-center text-gray-400">
                            <a href="/invoice/pdf/{{ $inv->id }}" class="hover:text-blue-600 transition-colors inline-block p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">No recent invoices found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection