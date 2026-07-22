<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">📚 Knowledge Base</h1><p class="text-sm text-slate-500 mt-1">Panduan, SOP, FAQ, dan artikel internal organisasi.</p></div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@forelse($articles as $a)
<a href="{{ route('member.knowledge-base.show', $a) }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:border-primary-200 transition-all group">
<span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700 capitalize">{{ $a->tipe }}</span>
<h3 class="text-lg font-bold text-slate-900 mt-3 mb-2 group-hover:text-primary-600">{{ $a->judul }}</h3>
<p class="text-sm text-slate-500 line-clamp-3">{{ Str::limit(strip_tags($a->konten), 120) }}</p>
<div class="mt-3 text-xs text-slate-400">{{ $a->created_at->format('d M Y') }}</div>
</a>
@empty<div class="col-span-3 text-center py-8 text-slate-500">Belum ada artikel.</div>@endforelse
</div><div class="mt-4">{{ $articles->links() }}</div>
</x-app-layout>
