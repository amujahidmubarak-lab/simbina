<x-app-layout>
    <div class="mb-6">
        <a href="{{ route('member.pengumumans.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">&larr; Kembali ke Daftar Pengumuman</a>
    </div>

    <div class="bg-white rounded-xl border {{ $pengumuman->is_important ? 'border-red-200' : 'border-slate-200' }} shadow-sm max-w-3xl overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h1 class="text-2xl font-bold text-slate-900">{{ $pengumuman->judul }}</h1>
                @if($pengumuman->is_important)
                    <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded text-xs font-medium bg-red-100 text-red-800 uppercase tracking-wider">Penting</span>
                @endif
            </div>
            
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-8 pb-6 border-b border-slate-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>{{ $pengumuman->created_at->translatedFormat('l, d F Y - H:i') }}</span>
                <span class="mx-2">&bull;</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span>{{ $pengumuman->creator?->name ?? 'Admin' }}</span>
            </div>
            
            <div class="prose prose-slate max-w-none prose-p:leading-relaxed text-slate-800 whitespace-pre-wrap">
                {{ $pengumuman->konten }}
            </div>
        </div>
    </div>
</x-app-layout>
