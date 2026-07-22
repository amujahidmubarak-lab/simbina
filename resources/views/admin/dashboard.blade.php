<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard Admin</h1>
        <p class="text-sm text-slate-500 mt-1">Ringkasan sistem informasi kontrakan pembinaan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stats Cards -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Anggota Aktif</div>
                <div class="text-2xl font-bold text-slate-900">{{ $totalMembers }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Menunggu Approval</div>
                <div class="text-2xl font-bold text-slate-900">{{ $totalPending }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Total Kontrakan</div>
                <div class="text-2xl font-bold text-slate-900">{{ $totalKontrakans }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Isi Mutaba'ah Hari Ini</div>
                <div class="text-2xl font-bold text-slate-900">{{ $todayAmalCount }} <span class="text-xs font-normal text-slate-400">/ {{ $totalMembers }}</span></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">Kegiatan Terdekat</h2>
                <a href="{{ route('admin.kegiatans.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($upcomingKegiatans as $keg)
                    <div class="p-4 flex gap-4 hover:bg-slate-50 transition-colors">
                        <div class="w-14 h-14 shrink-0 rounded-lg bg-primary-50 border border-primary-100 flex flex-col items-center justify-center text-primary-700">
                            <span class="text-xs font-semibold uppercase">{{ $keg->tanggal_waktu->format('M') }}</span>
                            <span class="text-lg font-bold leading-none">{{ $keg->tanggal_waktu->format('d') }}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 leading-tight mb-1">{{ $keg->judul }}</h3>
                            <div class="text-sm text-slate-500 mb-1">{{ $keg->tanggal_waktu->format('H:i') }} WIB &bull; {{ $keg->tempat }}</div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">{{ $keg->tipe }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">Tidak ada jadwal kegiatan.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
