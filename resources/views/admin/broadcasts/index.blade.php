<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Broadcast</h1></div><a href="{{ route('admin.broadcasts.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Kirim Broadcast</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="space-y-4">
@forelse($broadcasts as $b)
<div class="bg-white rounded-xl border {{ $b->is_penting?'border-red-200':'border-slate-200' }} shadow-sm p-6">
<div class="flex items-start justify-between mb-2">
<h3 class="font-bold text-slate-900">{{ $b->judul }}</h3>
@if($b->is_penting)<span class="px-2 py-0.5 rounded text-xs font-bold bg-red-100 text-red-700">PENTING</span>@endif
</div>
<p class="text-sm text-slate-600 mb-3">{{ $b->konten }}</p>
<div class="flex items-center gap-4 text-xs text-slate-400"><span>Oleh: {{ $b->sender->name }}</span><span>{{ $b->created_at->format('d M Y H:i') }}</span><span class="capitalize">Target: {{ $b->target_type }}</span></div>
</div>
@empty<div class="text-center py-8 text-slate-500">Belum ada broadcast.</div>@endforelse
</div><div class="mt-4">{{ $broadcasts->links() }}</div>
</x-app-layout>
