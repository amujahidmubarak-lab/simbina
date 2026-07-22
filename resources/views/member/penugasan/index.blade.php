<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">📋 Tugas Saya</h1></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="space-y-4">
@forelse($penugasans as $p)
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<div class="flex items-start justify-between mb-3">
<div><h3 class="font-bold text-slate-900">{{ $p->judul }}</h3>@if($p->kegiatan)<p class="text-xs text-slate-400 mt-1">Terkait: {{ $p->kegiatan->judul }}</p>@endif</div>
<form method="POST" action="{{ route('member.penugasan.update', $p) }}">@csrf @method('PATCH')
<select name="status" onchange="this.form.submit()" class="text-sm rounded-lg border-slate-200 {{ $p->status==='selesai'?'bg-emerald-50 text-emerald-700':($p->status==='dikerjakan'?'bg-amber-50 text-amber-700':'bg-slate-50 text-slate-600') }}"><option value="belum" {{ $p->status==='belum'?'selected':'' }}>Belum</option><option value="dikerjakan" {{ $p->status==='dikerjakan'?'selected':'' }}>Dikerjakan</option><option value="selesai" {{ $p->status==='selesai'?'selected':'' }}>Selesai</option></select>
</form></div>
@if($p->deskripsi)<p class="text-sm text-slate-600 mb-2">{{ $p->deskripsi }}</p>@endif
<div class="flex items-center gap-4 text-xs text-slate-400">
<span>Dari: {{ $p->assigner->name }}</span>
@if($p->deadline)<span>Deadline: {{ $p->deadline->format('d M Y') }}</span>@endif
</div></div>
@empty<div class="text-center py-8 text-slate-500">Belum ada tugas untuk Anda.</div>@endforelse
</div></x-app-layout>
