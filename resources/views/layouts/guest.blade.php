<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Simbina') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:500,600,700,800" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-white selection:bg-primary-500 selection:text-white">
        
        <div class="min-h-screen flex">
            <!-- Left Side: Branding / Image (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-slate-950 overflow-hidden items-center justify-center">
                <!-- Abstract Background -->
                <div class="absolute inset-0 z-0 opacity-60">
                    <div class="absolute -top-20 -left-20 w-[120%] h-[120%] bg-gradient-to-br from-primary-800/40 via-indigo-900/40 to-slate-950 blur-[100px] rounded-full mix-blend-screen"></div>
                    <div class="absolute bottom-0 right-0 w-[80%] h-[80%] bg-gradient-to-tl from-emerald-800/20 to-transparent blur-[120px] rounded-full mix-blend-screen"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 w-full max-w-lg p-12 text-white">
                    <a href="/" class="inline-flex w-16 h-16 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 items-center justify-center mb-8 hover:bg-white/10 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </a>
                    <h1 class="text-4xl lg:text-5xl font-extrabold mb-6 leading-tight tracking-tight">
                        Membangun Karakter,<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-indigo-400">Mengukir Prestasi.</span>
                    </h1>
                    <p class="text-lg text-slate-400 leading-relaxed mb-10">Platform sistem informasi pembinaan komprehensif untuk mendigitalisasi dan mempermudah evaluasi amal harian serta manajemen asrama.</p>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs">👤</div>
                            <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-700 flex items-center justify-center text-xs">🧑</div>
                            <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-600 flex items-center justify-center text-xs">👨</div>
                        </div>
                        <div class="text-sm font-medium text-slate-400">Bergabung dengan +100<br>anggota lainnya.</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form Content -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 lg:px-20 xl:px-32 relative">
                <!-- Mobile Logo -->
                <a href="/" class="lg:hidden absolute top-6 left-6 flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-600 to-indigo-600 flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-xl text-slate-900 tracking-tight group-hover:text-primary-600 transition-colors">Simbina</span>
                </a>

                <div class="w-full max-w-md mx-auto mt-12 lg:mt-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
    </body>
</html>
