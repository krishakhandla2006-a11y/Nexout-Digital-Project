@extends('layouts.app')

@section('content')
{{-- Header Section: Mobile ma padding optimize kari che --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4 px-2 md:px-0">
    <h2 class="text-xl md:text-2xl font-bold text-gray-800 tracking-tight">Clients List</h2>
    <a href="/clients/create" class="w-full md:w-auto bg-blue-600 text-white px-5 py-3 md:py-2.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition duration-200 font-semibold text-sm flex items-center justify-center">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Add Client
    </a>
</div>

{{-- Table Container: overflow-x-auto thi mobile ma scroll thase ane border-radius dekhase --}}
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
                        {{-- Mobile ma name thodu motu dekhay ae mate --}}
                        <div class="text-gray-800 font-semibold text-sm md:text-base">{{ $c->name }}</div>
                    </td>
                    <td class="p-4 text-gray-600 font-medium text-sm md:text-base">
                        {{ $c->phone }}
                    </td>
                    <td class="p-4">
                        <div class="flex items-center justify-center space-x-2 md:space-x-3">
                            <a href="/clients/{{ $c->id }}/edit" class="p-2.5 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors bg-blue-50 md:bg-transparent" title="Edit Client">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            <form action="/clients/{{ $c->id }}" method="POST" id="delete-form-{{ $c->id }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $c->id }})" class="p-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors bg-red-50 md:bg-transparent">
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