@extends('layouts.app')

@section('content')
{{-- Header Section --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 px-2 md:px-0">
    <h2 class="text-xl md:text-2xl font-bold text-gray-800 tracking-tight">Clients List</h2>
    <a href="{{ route('clients.create') }}" class="w-full md:w-auto bg-blue-600 text-white px-5 py-3 md:py-2.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition duration-200 font-semibold text-sm flex items-center justify-center">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Add Client
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
<div id="alert" class="mx-2 md:mx-0 mb-4 p-4 bg-green-500 text-white rounded-xl shadow-lg flex justify-between items-center animate-pulse">
    <div class="flex items-center">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-bold text-sm md:text-base">{{ session('success') }}</span>
    </div>
    <button onclick="document.getElementById('alert').remove()" class="font-bold text-xl">&times;</button>
</div>
<script>
    setTimeout(() => {
        const alertBox = document.getElementById('alert');
        if (alertBox) alertBox.remove();
    }, 3000);
</script>
@endif

{{-- Error Message --}}
@if(session('error'))
<div id="alert-error" class="mx-2 md:mx-0 mb-4 p-4 bg-red-500 text-white rounded-xl shadow-lg flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"></path></svg>
        <span class="font-bold text-sm md:text-base">{{ session('error') }}</span>
    </div>
    <button onclick="document.getElementById('alert-error').remove()" class="font-bold text-xl">&times;</button>
</div>
<script>
    setTimeout(() => {
        const alertBoxError = document.getElementById('alert-error');
        if (alertBoxError) alertBoxError.remove();
    }, 5000);
</script>
@endif

{{-- Table Container --}}
<div class="mx-2 md:mx-0 bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[500px] md:min-w-full">
            <thead class="bg-slate-50 border-b border-gray-100 text-gray-500">
                <tr>
                    <th class="p-4 font-bold uppercase text-xs tracking-wider">Client Name</th>
                    <th class="p-4 font-bold uppercase text-xs tracking-wider">Phone</th>
                    <th class="p-4 font-bold uppercase text-xs tracking-wider text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($clients as $c)
                <tr class="hover:bg-blue-50/30 transition duration-150">
                    <td class="p-4">
                        <div class="text-gray-800 font-semibold text-sm md:text-base">{{ $c->name }}</div>
                    </td>
                    <td class="p-4 text-gray-600 font-medium text-sm md:text-base">
                        {{ $c->phone }}
                    </td>
                    <td class="p-4">
                        <div class="flex items-center justify-center space-x-2 md:space-x-3">

                            {{-- Edit Button --}}
                            <a href="{{ route('clients.edit', $c->id) }}" title="Edit Client" class="p-2.5 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors bg-blue-50 md:bg-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('clients.destroy', $c->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this client?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Client" class="p-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors bg-red-50 md:bg-transparent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($clients->isEmpty())
    <div class="p-8 text-center text-gray-400 italic">No clients found.</div>
    @endif
</div>
@endsection