<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">⚠️ Early Warning System</h1><p class="text-sm text-slate-500 mt-1">Anggota yang memerlukan perhatian khusus.</p></div>
@if($warnings->isEmpty())<div class="bg-emerald-50 text-emerald-700 p-6 rounded-xl border border-emerald-200 text-center"><p class="font-medium">✅ Semua anggota dalam kondisi baik! Tidak ada peringatan aktif.</p></div>
@else
<div class="space-y-4">
@foreach($warnings as $w)
<div class="bg-white rounded-xl border {{ $w['priority']==='tinggi' ? 'border-red-200' : ($w['priority']==='sedang' ? 'border-amber-200' : 'border-slate-200') }} shadow-sm p-6">
<div class="flex items-start justify-between">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full {{ $w['priority']==='tinggi' ? 'bg-red-100 text-red-600' : ($w['priority']==='sedang' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-600') }} flex items-center justify-center font-bold text-lg shrink-0">{{ substr($w['user']->name,0,1) }}</div>
<div><h3 class="font-bold text-slate-900">{{ $w['user']->name }}</h3><p class="text-sm text-slate-500">{{ $w['user']->email }}</p></div>
</div>
<span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $w['priority']==='tinggi' ? 'bg-red-100 text-red-700' : ($w['priority']==='sedang' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600') }}">{{ $w['priority'] }}</span>
</div>
<div class="mt-4 space-y-2">
@foreach($w['warnings'] as $warn)
<div class="flex items-center gap-2 text-sm {{ $warn['severity']==='tinggi' ? 'text-red-600' : ($warn['severity']==='sedang' ? 'text-amber-600' : 'text-slate-500') }}">
<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
{{ $warn['message'] }}
</div>@endforeach
</div></div>@endforeach</div>@endif
</x-app-layout>
