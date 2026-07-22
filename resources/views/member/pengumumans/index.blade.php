<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Pengumuman</h1>
        <p class="text-sm text-slate-500 mt-1">Informasi penting terkait program pembinaan.</p>
    </div>

    <div class="space-y-4 max-w-3xl">
        @forelse ($pengumumans as $p)
            <div class="bg-white p-5 rounded-xl border {{ $p->is_important ? 'border-red-200 shadow-md shadow-red-100/50' : 'border-slate-200 shadow-sm' }} transition-shadow hover:shadow-md">
                <div class="flex items-start justify-between gap-4 mb-2">
                    <h2 class="text-lg font-bold text-slate-900 leading-tight">
                        <a href="{{ route('member.pengumumans.show', $p) }}" class="hover:text-primary-600 transition-colors">{{ $p->judul }}</a>
                    </h2>
                    @if($p->is_important)
                        <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Penting</span>
                    @endif
                </div>
                <div class="text-xs text-slate-500 mb-3">{{ $p->created_at->format('d M Y, H:i') }} &bull; Oleh: {{ $p->creator?->name ?? 'Admin' }}</div>
                <div class="text-sm text-slate-700 line-clamp-2">
                    {{ $p->konten }}
                </div>
                <div class="mt-3">
                    <a href="{{ route('member.pengumumans.show', $p) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        @empty
            <div class="bg-slate-50 p-8 rounded-xl border border-slate-200 text-center text-slate-500 border-dashed">
                Belum ada pengumuman saat ini.
            </div>
        @endforelse
    </div>
    
    <div class="mt-6 max-w-3xl">
        {{ $pengumumans->links() }}
    </div>
</x-app-layout>
