<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Assalamu'alaikum, {{ Auth::user()->name }} 👋</h1>
        <p class="text-sm text-slate-500 mt-1">Selamat datang di sistem informasi pembinaan.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Pengumuman Teratas -->
            @if($recentPengumumans->count() > 0)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                        <h2 class="font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                            Pengumuman Terbaru
                        </h2>
                        <a href="{{ route('member.pengumumans.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($recentPengumumans as $p)
                            <div class="p-5 hover:bg-slate-50 transition-colors {{ $p->is_important ? 'bg-red-50/30' : '' }}">
                                <div class="flex items-start justify-between gap-4 mb-1">
                                    <h3 class="font-bold text-slate-900 leading-tight">
                                        <a href="{{ route('member.pengumumans.show', $p) }}" class="hover:text-primary-600">{{ $p->judul }}</a>
                                    </h3>
                                    @if($p->is_important)
                                        <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-800 uppercase">Penting</span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-500 mb-2">{{ $p->created_at->diffForHumans() }}</div>
                                <p class="text-sm text-slate-600 line-clamp-2">{{ $p->konten }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Jadwal Kegiatan -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Agenda Kegiatan Mendatang
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($upcomingKegiatans as $keg)
                            <div class="flex gap-4 p-4 rounded-xl border border-slate-200 hover:border-primary-300 transition-colors">
                                <div class="w-14 h-14 shrink-0 rounded-lg bg-primary-50 border border-primary-100 flex flex-col items-center justify-center text-primary-700">
                                    <span class="text-xs font-semibold uppercase">{{ $keg->tanggal_waktu->format('M') }}</span>
                                    <span class="text-lg font-bold leading-none">{{ $keg->tanggal_waktu->format('d') }}</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-slate-900 leading-tight">{{ $keg->judul }}</h3>
                                    <div class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $keg->tanggal_waktu->format('H:i') }} WIB
                                    </div>
                                    <div class="text-sm text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ $keg->tempat }}
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">{{ $keg->tipe }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-500 bg-slate-50 rounded-lg border border-slate-200 border-dashed">
                                Tidak ada agenda kegiatan dalam waktu dekat.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Kolom Kanan (Widget) -->
        <div class="space-y-6">
            
            <!-- Status Mutaba'ah Hari Ini -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Mutaba'ah Hari Ini
                    </h2>
                </div>
                <div class="p-6 text-center">
                    @if($myAmalToday)
                        <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="font-bold text-slate-900">Alhamdulillah!</h3>
                        <p class="text-sm text-slate-500 mt-1 mb-4">Anda telah mengisi mutaba'ah untuk hari ini.</p>
                        <a href="{{ route('member.amal.index') }}" class="inline-block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Lihat Detail Amal</a>
                    @else
                        <div class="w-20 h-20 mx-auto rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-slate-900">Belum Mengisi Mutaba'ah</h3>
                        <p class="text-sm text-slate-500 mt-1 mb-4">Yuk luangkan waktu sejenak untuk evaluasi amal harian Anda.</p>
                        <a href="{{ route('member.amal.index') }}" class="inline-block w-full text-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Isi Mutaba'ah Sekarang</a>
                    @endif
                </div>
            </div>

            <!-- Akses Cepat -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="font-bold text-slate-800">Akses Cepat</h2>
                </div>
                <div class="p-4 grid grid-cols-2 gap-3">
                    <a href="{{ route('member.materis.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 hover:border-primary-300 hover:bg-primary-50 transition-all text-center group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-primary-600 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-primary-700">Materi Kajian</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 hover:border-primary-300 hover:bg-primary-50 transition-all text-center group">
                        <svg class="w-8 h-8 text-slate-400 group-hover:text-primary-600 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-primary-700">Profil Saya</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
