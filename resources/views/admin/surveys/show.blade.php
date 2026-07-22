<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Hasil Survey: {{ $survey->judul }}</h1><p class="text-sm text-slate-500 mt-1">{{ $survey->responses->count() }} responden • Rata-rata: <span class="font-bold text-primary-600">{{ number_format($avgRating, 1) }}/5 ⭐</span></p></div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold mb-4">Distribusi Rating</h2>
@for($i=5;$i>=1;$i--)
@php $count = $survey->responses->where('rating',$i)->count(); $pct = $survey->responses->count() > 0 ? round(($count/$survey->responses->count())*100) : 0; @endphp
<div class="flex items-center gap-3 mb-2"><span class="text-sm font-medium w-4">{{ $i }}</span><div class="flex-1 bg-slate-100 rounded-full h-3"><div class="h-3 rounded-full {{ $i>=4?'bg-emerald-500':($i>=3?'bg-amber-500':'bg-red-500') }}" style="width:{{ $pct }}%"></div></div><span class="text-xs text-slate-500 w-10 text-right">{{ $count }}</span></div>
@endfor</div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<div class="px-6 py-4 bg-slate-50 border-b font-bold">Feedback</div>
<div class="divide-y divide-slate-100 max-h-96 overflow-y-auto">
@forelse($survey->responses->whereNotNull('feedback') as $r)
<div class="p-4"><div class="flex items-center gap-2 mb-1"><span class="font-medium text-sm">{{ $r->user->name }}</span><span class="text-xs text-amber-500">{{ str_repeat('⭐',$r->rating) }}</span></div><p class="text-sm text-slate-600">{{ $r->feedback }}</p></div>
@empty<div class="p-8 text-center text-slate-500">Belum ada feedback.</div>@endforelse
</div></div></div>
</x-app-layout>
