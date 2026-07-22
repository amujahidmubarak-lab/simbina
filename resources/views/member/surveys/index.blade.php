<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">⭐ Survey & Evaluasi</h1></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="space-y-4">
@forelse($surveys as $s)
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 flex items-center justify-between">
<div><h3 class="font-bold text-slate-900">{{ $s->judul }}</h3>@if($s->kegiatan)<p class="text-sm text-slate-500 mt-1">{{ $s->kegiatan->judul }}</p>@endif</div>
@if($answeredIds->contains($s->id))<span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">✓ Sudah dijawab</span>
@else<a href="{{ route('member.surveys.show', $s) }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Isi Survey</a>@endif
</div>
@empty<div class="text-center py-8 text-slate-500">Belum ada survey.</div>@endforelse</div>
</x-app-layout>
