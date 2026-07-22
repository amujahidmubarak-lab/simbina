<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('admin.kegiatans.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Kegiatan</a>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-sm font-medium text-slate-900">Detail Kegiatan</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $kegiatan->judul }}</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.kegiatans.edit', $kegiatan) }}" class="inline-flex items-center justify-center bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm">
                Edit
            </a>
            <form action="{{ route('admin.kegiatans.destroy', $kegiatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200">
            <div class="p-6">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal & Waktu</div>
                <div class="text-lg font-medium text-slate-900">{{ $kegiatan->tanggal_waktu->format('d M Y') }}</div>
                <div class="text-slate-600">{{ $kegiatan->tanggal_waktu->format('H:i') }} WIB</div>
            </div>
            <div class="p-6">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tempat</div>
                <div class="font-medium text-slate-900">{{ $kegiatan->tempat }}</div>
                <div class="text-slate-600 text-sm mt-1">
                    @if($kegiatan->kontrakan)
                        Khusus Kontrakan: {{ $kegiatan->kontrakan->nama_kontrakan }}
                    @else
                        Terbuka (Global)
                    @endif
                </div>
            </div>
            <div class="p-6">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Status & Tipe</div>
                <div class="flex items-center gap-2 mb-2 mt-1">
                    @if ($kegiatan->status === 'upcoming')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Upcoming</span>
                    @elseif ($kegiatan->status === 'ongoing')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Ongoing</span>
                    @elseif ($kegiatan->status === 'completed')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Completed</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Cancelled</span>
                    @endif
                    
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">
                        {{ $kegiatan->tipe }}
                    </span>
                </div>
                <div class="text-xs text-slate-500">Dibuat oleh: {{ $kegiatan->creator?->name ?? '-' }}</div>
            </div>
        </div>
    </div>

    @if($kegiatan->deskripsi)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-6">
        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Deskripsi Kegiatan</h3>
        <div class="text-slate-700 whitespace-pre-wrap">{{ $kegiatan->deskripsi }}</div>
    </div>
    @endif
    
    <div class="bg-slate-50 rounded-xl border border-slate-200 shadow-sm p-8 text-center text-slate-500 border-dashed">
        <svg class="mx-auto w-10 h-10 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        <p>Fitur Absensi (Kehadiran) Kegiatan akan dikembangkan pada fase berikutnya.</p>
    </div>
</x-app-layout>
