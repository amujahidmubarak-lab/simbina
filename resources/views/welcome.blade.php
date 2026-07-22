<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Simbina') }} - Ekosistem Pembinaan Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 selection:bg-primary-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-slate-900">
                        Simbina<span class="text-primary-600">.</span>
                    </span>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="#fitur" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Fitur</a>
                    <a href="#tentang" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">Tentang Program</a>
                    <a href="#faq" class="text-sm font-medium text-slate-600 hover:text-primary-600 transition-colors">FAQ</a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors bg-primary-50 px-4 py-2 rounded-full">Masuk Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors hidden sm:block">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 transition-all hover:scale-105 shadow-md hover:shadow-xl">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-primary-200/50 blur-[120px]"></div>
            <div class="absolute top-[30%] right-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-200/40 blur-[100px]"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-[60%] h-[60%] rounded-full bg-emerald-100/40 blur-[120px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/80 border border-slate-200 backdrop-blur-md mb-8 shadow-sm">
                <span class="flex w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-700 tracking-wide uppercase">Sistem Informasi Kontrakan Pembinaan</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-black text-slate-900 tracking-tight mb-8 leading-[1.05]">
                Ekosistem Pembinaan <br class="hidden md:block">
                <span class="relative inline-block mt-2">
                    <span class="relative z-10 bg-clip-text text-transparent bg-gradient-to-r from-primary-600 via-indigo-600 to-purple-600">Lebih Terstruktur</span>
                    <svg class="absolute w-full h-4 -bottom-1 left-0 z-0 text-primary-200/60" viewBox="0 0 200 9" fill="currentColor"><path d="M2.08 7.331c44.821-4.707 90.758-6.191 136.195-2.593 17.514 1.385 35.105 3.328 52.417 6.471.21.037.408.016.592-.061.275-.116.48-.35.539-.636.06-.285-.03-.585-.237-.783-.138-.131-.33-.213-.54-.239C143.905-.333 96.067-.282 48.498 7.391c-15.688 2.528-31.42 5.656-46.907 9.873-.257.069-.472.25-.56.495-.088.245-.043.518.118.723.161.205.41.32.673.303.086-.005.172-.023.258-.054z"></path></svg>
                </span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-600 mb-12 leading-relaxed">
                Kelola asrama, pantau mutaba'ah harian, distribusikan materi, dan jadwalkan kegiatan dalam satu platform cerdas yang dirancang untuk produktivitas pembinaan.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-bold text-white bg-slate-900 hover:bg-slate-800 transition-all hover:shadow-xl hover:-translate-y-1">
                        Mulai Bergabung
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                @endif
                <a href="#fitur" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-bold text-slate-700 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all shadow-sm hover:shadow">
                    Pelajari Fitur Kami
                </a>
            </div>
            
            <!-- Dashboard Preview Image Mockup -->
            <div class="mt-24 relative max-w-6xl mx-auto">
                <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent z-10 h-full w-full pointer-events-none"></div>
                <div class="rounded-t-[2.5rem] border-t border-l border-r border-slate-200/80 shadow-2xl bg-white/50 backdrop-blur-md p-3 sm:p-5 mx-4 sm:mx-10 overflow-hidden">
                    <div class="rounded-t-[2rem] overflow-hidden border border-slate-100 bg-slate-50 relative">
                        <!-- Mockup Header -->
                        <div class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                            </div>
                            <div class="w-48 h-6 bg-slate-100 rounded-full"></div>
                        </div>
                        <!-- Mockup Content -->
                        <div class="grid grid-cols-5 aspect-[16/8] opacity-90">
                            <!-- Sidebar mockup -->
                            <div class="hidden sm:block col-span-1 bg-white border-r border-slate-200 p-6 space-y-6">
                                <div class="flex items-center gap-3 mb-10">
                                    <div class="w-8 h-8 rounded-lg bg-primary-600"></div>
                                    <div class="w-20 h-5 bg-slate-200 rounded"></div>
                                </div>
                                <div class="space-y-4">
                                    <div class="w-full h-10 bg-primary-50 rounded-xl"></div>
                                    <div class="w-3/4 h-10 bg-slate-100 rounded-xl"></div>
                                    <div class="w-5/6 h-10 bg-slate-100 rounded-xl"></div>
                                    <div class="w-4/5 h-10 bg-slate-100 rounded-xl"></div>
                                </div>
                            </div>
                            <!-- Content mockup -->
                            <div class="col-span-5 sm:col-span-4 p-8 space-y-8 bg-slate-50/50">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="w-64 h-8 bg-slate-300 rounded-lg mb-2"></div>
                                        <div class="w-40 h-4 bg-slate-200 rounded-md"></div>
                                    </div>
                                    <div class="w-10 h-10 bg-slate-200 rounded-full"></div>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-6">
                                    <div class="h-32 bg-white border border-slate-200 shadow-sm rounded-2xl p-5 flex flex-col justify-end">
                                        <div class="w-12 h-12 rounded-full bg-blue-100 mb-auto"></div>
                                        <div class="w-16 h-6 bg-slate-800 rounded mb-2"></div>
                                        <div class="w-24 h-3 bg-slate-300 rounded"></div>
                                    </div>
                                    <div class="h-32 bg-white border border-slate-200 shadow-sm rounded-2xl p-5 flex flex-col justify-end">
                                        <div class="w-12 h-12 rounded-full bg-amber-100 mb-auto"></div>
                                        <div class="w-16 h-6 bg-slate-800 rounded mb-2"></div>
                                        <div class="w-24 h-3 bg-slate-300 rounded"></div>
                                    </div>
                                    <div class="h-32 bg-white border border-slate-200 shadow-sm rounded-2xl p-5 flex flex-col justify-end">
                                        <div class="w-12 h-12 rounded-full bg-emerald-100 mb-auto"></div>
                                        <div class="w-16 h-6 bg-slate-800 rounded mb-2"></div>
                                        <div class="w-24 h-3 bg-slate-300 rounded"></div>
                                    </div>
                                    <div class="h-32 bg-white border border-slate-200 shadow-sm rounded-2xl p-5 flex flex-col justify-end">
                                        <div class="w-12 h-12 rounded-full bg-indigo-100 mb-auto"></div>
                                        <div class="w-16 h-6 bg-slate-800 rounded mb-2"></div>
                                        <div class="w-24 h-3 bg-slate-300 rounded"></div>
                                    </div>
                                </div>
                                <div class="flex gap-6">
                                    <div class="w-2/3 h-64 bg-white border border-slate-200 shadow-sm rounded-2xl p-6">
                                        <div class="w-48 h-6 bg-slate-200 rounded mb-6"></div>
                                        <div class="space-y-4">
                                            <div class="w-full h-12 bg-slate-50 rounded-xl"></div>
                                            <div class="w-full h-12 bg-slate-50 rounded-xl"></div>
                                            <div class="w-full h-12 bg-slate-50 rounded-xl"></div>
                                        </div>
                                    </div>
                                    <div class="w-1/3 h-64 bg-white border border-slate-200 shadow-sm rounded-2xl p-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Cloud -->
    <section class="py-10 border-y border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-widest mb-8">Dipercaya oleh berbagai lembaga pembinaan</p>
            <div class="flex flex-wrap justify-center gap-10 md:gap-20 opacity-40 grayscale">
                <!-- Dummy Logos using generic shapes -->
                <div class="flex items-center gap-2 font-black text-2xl"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg> ACME Corp</div>
                <div class="flex items-center gap-2 font-black text-2xl"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle></svg> GLOBEX</div>
                <div class="flex items-center gap-2 font-black text-2xl"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="4"></rect></svg> SOYLENT</div>
                <div class="flex items-center gap-2 font-black text-2xl"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> INGEN</div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-6">
                        Tentang Program
                    </div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight">Digitalisasi untuk Hasil Pembinaan yang Optimal</h2>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        Kami percaya bahwa manajemen yang baik adalah kunci kesuksesan program pembinaan. Simbina dirancang untuk menjembatani antara pengurus (admin) dan anggota, menghilangkan _paperwork_ manual, dan fokus pada peningkatan spiritual serta keahlian anggota.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Transparansi Data</h4>
                                <p class="text-sm text-slate-500">Anggota bisa melihat performanya, Admin memiliki rekap data secara real-time.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Komunikasi Terpusat</h4>
                                <p class="text-sm text-slate-500">Tidak ada lagi pengumuman atau materi yang tertumpuk di grup chat.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-600 to-indigo-600 rounded-3xl transform rotate-3 scale-105 opacity-20"></div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Team collaborating" class="rounded-3xl shadow-2xl relative z-10 object-cover aspect-[4/3]">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-32 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-sm font-bold text-primary-600 tracking-widest uppercase mb-4">Modul Lengkap</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6">Dirancang untuk skalabilitas</h3>
                <p class="text-slate-600 text-lg">Setiap fitur dibangun dengan cermat untuk memastikan program pembinaan berjalan mulus, terlepas dari jumlah asrama atau anggota yang Anda kelola.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 hover:border-primary-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold text-slate-900 mb-4">Mutaba'ah Digital</h4>
                    <p class="text-slate-600 leading-relaxed">Member dapat mengisi evaluasi amal harian dan mingguan secara mobile-friendly. Admin mendapat rekap data instan tanpa harus rekap ulang di Excel.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold text-slate-900 mb-4">Manajemen Kontrakan</h4>
                    <p class="text-slate-600 leading-relaxed">Sistem mendata seluruh asrama secara detail. Plotting anggota baru sangat mudah, lengkap dengan bar kapasitas yang memperingatkan jika asrama penuh.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-[2rem] p-10 border border-slate-100 hover:border-emerald-200 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold text-slate-900 mb-4">Agenda & Broadcast</h4>
                    <p class="text-slate-600 leading-relaxed">Admin dapat menjadwalkan kajian rutin, menandai pengumuman penting (Prio), serta melampirkan modul atau jurnal referensi untuk diunduh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works (Alur) -->
    <section class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Bagaimana cara kerjanya?</h2>
                <p class="text-slate-400">Tiga langkah mudah untuk memulai perjalanan Anda di platform ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Line connecting steps (desktop only) -->
                <div class="hidden md:block absolute top-12 left-[15%] w-[70%] h-0.5 bg-gradient-to-r from-primary-500/0 via-primary-500/50 to-primary-500/0"></div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-slate-800 rounded-3xl border border-slate-700 flex items-center justify-center mb-6 shadow-2xl relative z-10">
                        <span class="text-3xl font-black text-primary-400">1</span>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Buat Akun (Register)</h4>
                    <p class="text-slate-400 text-sm">Daftarkan diri Anda dengan email aktif. Akun Anda awalnya akan berstatus 'Pending'.</p>
                </div>
                
                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-slate-800 rounded-3xl border border-slate-700 flex items-center justify-center mb-6 shadow-2xl relative z-10">
                        <span class="text-3xl font-black text-primary-400">2</span>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Approval Admin</h4>
                    <p class="text-slate-400 text-sm">Pengurus akan memverifikasi dan memberikan persetujuan (Approve) pada akun Anda.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-primary-600 rounded-3xl border border-primary-500 flex items-center justify-center mb-6 shadow-2xl shadow-primary-500/50 relative z-10">
                        <span class="text-3xl font-black text-white">3</span>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Akses Penuh</h4>
                    <p class="text-slate-300 text-sm">Selamat! Anda bisa mulai mengisi mutaba'ah, melihat jadwal, dan mengunduh materi kajian.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pertanyaan yang Sering Diajukan</h2>
            </div>
            
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Kenapa setelah daftar saya tidak bisa masuk dashboard?</h4>
                    <p class="text-slate-600">Sistem ini bersifat tertutup (private). Setiap pendaftaran baru harus melalui tahap _Approval_ oleh Admin untuk menjaga keamanan data komunitas.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Apakah ada batasan jumlah kontrakan yang bisa ditambahkan?</h4>
                    <p class="text-slate-600">Tidak ada batasan. Admin dapat menambah kontrakan sebanyak-banyaknya beserta kapasitas penghuni (kuota) masing-masing.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Bagaimana cara melaporkan error?</h4>
                    <p class="text-slate-600">Anda dapat menghubungi Administrator sistem secara langsung untuk perbaikan teknis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-900 to-slate-900 z-0"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Siap untuk memulai?</h2>
            <p class="text-xl text-primary-200 mb-10">Bergabunglah dengan ekosistem kami dan rasakan kemudahannya.</p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 rounded-full text-lg font-bold text-slate-900 bg-white hover:bg-slate-100 transition-all hover:scale-105 shadow-xl">
                    Buat Akun Sekarang
                </a>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-16 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-indigo-500 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="font-bold text-2xl text-white">Simbina.</span>
                    </div>
                    <p class="text-slate-500 max-w-sm">Sistem Informasi Kontrakan Pembinaan. Solusi modern untuk mendigitalisasi program evaluasi amal dan asrama.</p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Tautan Utama</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#tentang" class="hover:text-primary-400 transition-colors">Tentang Program</a></li>
                        <li><a href="#fitur" class="hover:text-primary-400 transition-colors">Fitur Kami</a></li>
                        <li><a href="#faq" class="hover:text-primary-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Legalitas</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
                <p>&copy; {{ date('Y') }} Simbina App. Hak Cipta Dilindungi.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Instagram</a>
                    <a href="#" class="hover:text-white transition-colors">Twitter</a>
                    <a href="#" class="hover:text-white transition-colors">GitHub</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
