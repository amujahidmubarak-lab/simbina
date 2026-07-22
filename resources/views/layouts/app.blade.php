<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Simbina') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-primary-500 selection:text-white" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden bg-slate-50">
            
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Content Area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                <!-- Topbar -->
                @include('layouts.topbar')

                <!-- Main Content -->
                <main class="p-4 sm:p-6 lg:p-10 w-full max-w-screen-2xl mx-auto">
                    <!-- Premium Glassmorphism Background Elements -->
                    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-primary-50/50 to-transparent -z-10 pointer-events-none"></div>
                    
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
