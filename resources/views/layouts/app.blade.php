<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Nexout Digital - Billing</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // મોબાઈલ મેનૂ ખોલવા અને બંધ કરવા માટેનું ફંક્શન
            function toggleMenu() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('-translate-x-full');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex h-screen overflow-hidden relative">
            
            <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex-shrink-0 flex flex-col">
                <div class="p-6 text-2xl font-bold border-b border-slate-700 flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-blue-400 mr-2">N</span> NEXOUT
                    </div>
                    <button onclick="toggleMenu()" class="md:hidden text-gray-400 hover:text-white">
                        ✕
                    </button>
                </div>
                <nav class="mt-6 flex-1">
                    <a href="/dashboard" class="flex items-center py-3 px-6 hover:bg-slate-800 transition {{ request()->is('dashboard') ? 'bg-slate-800 border-l-4 border-blue-500 text-white' : 'text-gray-400' }}">
                        Dashboard
                    </a>
                    <a href="/clients" class="flex items-center py-3 px-6 hover:bg-slate-800 transition {{ request()->is('clients*') ? 'bg-slate-800 border-l-4 border-blue-500 text-white' : 'text-gray-400' }}">
                        Clients
                    </a>
                    <a href="/invoice/create" class="flex items-center py-3 px-6 hover:bg-slate-800 transition {{ request()->is('invoice/create') ? 'bg-slate-800 border-l-4 border-blue-500 text-white' : 'text-gray-400' }}">
                        Create Invoice
                    </a>
                </nav>
            </div>

            <div class="flex-1 flex flex-col overflow-y-auto w-full">
                <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-gray-200">
                    <div class="flex items-center">
                        <button onclick="toggleMenu()" class="mr-4 text-gray-600 md:hidden focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                        <h2 class="text-lg md:text-xl font-semibold text-gray-700 uppercase tracking-wide truncate">Nexout Digital</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-xs md:sm text-gray-500 font-medium italic">Hello, {{ Auth::user()->name ?? 'Admin' }}</span>
                    </div>
                </header>

                <main class="p-4 md:p-8">
                    @yield('content')
                    
                    @if(isset($slot))
                        {{ $slot }}
                    @endif
                </main>
            </div>

        </div>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true
            });
        </script>
        @endif

        @stack('scripts')
    </body>
</html>