<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Knowledge Base</h1></div><a href="{{ route('admin.knowledge-base.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Tambah Artikel</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@forelse($articles as $a)
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
<span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700 capitalize">{{ $a->tipe }}</span>
<h3 class="text-lg font-bold text-slate-900 mt-3 mb-2">{{ $a->judul }}</h3>
<p class="text-sm text-slate-500 line-clamp-3">{{ Str::limit(strip_tags($a->konten), 120) }}</p>
<div class="mt-4 flex items-center justify-between">
<span class="text-xs text-slate-400">{{ $a->created_at->format('d M Y') }}</span>
<a href="{{ route('admin.knowledge-base.edit', $a) }}" class="text-primary-600 text-sm font-medium">Edit</a>
</div></div>
@empty<div class="col-span-3 text-center py-8 text-slate-500">Belum ada artikel.</div>@endforelse
</div><div class="mt-4">{{ $articles->links() }}</div>
</x-app-layout>
