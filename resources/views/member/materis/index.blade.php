<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Materi Pembinaan</h1>
        <p class="text-sm text-slate-500 mt-1">Kumpulan materi, presentasi, dan referensi kajian.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($materis as $m)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow">
                <div class="p-5 flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        @if($m->file_path)
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-rose-100 text-rose-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </span>
                        @elseif($m->link_url)
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-blue-100 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </span>
                        @else
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-slate-100 text-slate-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </span>
                        @endif
                        <span class="text-xs text-slate-500">{{ $m->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <h2 class="text-lg font-bold text-slate-900 mb-2 leading-tight">
                        <a href="{{ route('member.materis.show', $m) }}" class="hover:text-primary-600 transition-colors">{{ $m->judul }}</a>
                    </h2>
                    
                    <p class="text-sm text-slate-600 line-clamp-3">
                        {{ $m->deskripsi }}
                    </p>
                </div>
                
                <div class="px-5 py-4 border-t border-slate-100 bg-slate-50 mt-auto rounded-b-xl flex items-center justify-between">
                    <a href="{{ route('member.materis.show', $m) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Lihat Detail</a>
                    
                    <div class="flex gap-2">
                        @if($m->link_url)
                            <a href="{{ $m->link_url }}" target="_blank" class="text-slate-400 hover:text-blue-600" title="Buka Tautan">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @endif
                        @if($m->file_path)
                            <a href="{{ Storage::url($m->file_path) }}" target="_blank" class="text-slate-400 hover:text-rose-600" title="Unduh File">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-slate-50 p-8 rounded-xl border border-slate-200 text-center text-slate-500 border-dashed">
                Belum ada materi yang dibagikan.
            </div>
        @endforelse
    </div>
    
    <div class="mt-6">
        {{ $materis->links() }}
    </div>
</x-app-layout>
