<x-app-layout>
    <div class="mb-6">
        <a href="{{ route('member.materis.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">&larr; Kembali ke Daftar Materi</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-3xl overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold text-slate-900 mb-4">{{ $materi->judul }}</h1>
            
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-8 pb-6 border-b border-slate-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>Diposting: {{ $materi->created_at->translatedFormat('d F Y') }}</span>
                <span class="mx-2">&bull;</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span>{{ $materi->creator?->name ?? 'Admin' }}</span>
            </div>
            
            <div class="prose prose-slate max-w-none prose-p:leading-relaxed text-slate-800 whitespace-pre-wrap mb-8">
                {{ $materi->deskripsi }}
            </div>

            @if($materi->file_path || $materi->link_url)
                <div class="bg-slate-50 rounded-lg p-5 border border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-4">Lampiran Referensi</h3>
                    
                    <div class="space-y-3">
                        @if($materi->file_path)
                            <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="flex items-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-sm transition-all group">
                                <div class="w-10 h-10 rounded bg-rose-100 text-rose-600 flex items-center justify-center mr-4 group-hover:bg-rose-500 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-slate-900">Unduh Dokumen</div>
                                    <div class="text-xs text-slate-500">Klik untuk melihat file PDF/Doc terlampir</div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        @endif

                        @if($materi->link_url)
                            <a href="{{ $materi->link_url }}" target="_blank" class="flex items-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-300 hover:shadow-sm transition-all group">
                                <div class="w-10 h-10 rounded bg-blue-100 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-slate-900">Buka Tautan Luar</div>
                                    <div class="text-xs text-slate-500 line-clamp-1">{{ $materi->link_url }}</div>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
