<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Koordinator</h1>
            <p class="text-sm text-slate-500 mt-1">
                {{ $kontrakan ? $kontrakan->nama_kontrakan : 'Belum terhubung ke kontrakan' }}
            </p>
        </div>
    </div>

    @if(!$kontrakan)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-amber-800">
            <p class="font-semibold">Anda belum terhubung ke kontrakan manapun.</p>
            <p class="text-sm mt-1">Hubungi admin untuk menambahkan Anda ke kontrakan.</p>
        </div>
    @else

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Anggota Aktif</div>
                <div class="text-2xl font-bold text-slate-900">{{ $members->count() }}</div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Skor Rata-rata</div>
                <div class="text-2xl font-bold text-slate-900">{{ $kontrakanScore['total'] ?? 0 }}<span class="text-sm font-normal text-slate-400">/100</span></div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Early Warning</div>
                <div class="text-2xl font-bold text-slate-900">{{ $warnings->count() }}</div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <div class="text-sm font-medium text-slate-500">Saldo Kas</div>
                <div class="text-2xl font-bold text-slate-900">Rp {{ number_format($kasBalance, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Kegiatan Terdekat --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">Kegiatan Terdekat</h2>
                <a href="{{ route('koordinator.attendances.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Input Absensi</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($upcomingKegiatans as $keg)
                    <div class="p-4 flex gap-3 hover:bg-slate-50">
                        <div class="w-12 h-12 shrink-0 rounded-lg bg-primary-50 flex flex-col items-center justify-center text-primary-700">
                            <span class="text-[10px] font-bold uppercase">{{ $keg->tanggal_waktu->format('M') }}</span>
                            <span class="text-lg font-bold leading-none">{{ $keg->tanggal_waktu->format('d') }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm leading-tight">{{ $keg->judul }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $keg->tanggal_waktu->format('H:i') }} • {{ $keg->tempat }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500 text-sm">Tidak ada kegiatan mendatang.</div>
                @endforelse
            </div>
        </div>

        {{-- Early Warning --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">Early Warning</h2>
                <a href="{{ route('koordinator.early-warnings.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($warnings->take(4) as $item)
                    <div class="p-4 flex gap-3 items-start">
                        <div class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center
                            {{ $item['priority'] === 'tinggi' ? 'bg-red-100 text-red-600' : ($item['priority'] === 'sedang' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-500') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-800">{{ $item['user']->name }}</p>
                            @foreach($item['warnings'] as $w)
                                <p class="text-xs text-slate-500">{{ $w['message'] }}</p>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500 text-sm">🎉 Semua anggota dalam kondisi baik!</div>
                @endforelse
            </div>
        </div>
    </div>

    @endif
</x-app-layout>
