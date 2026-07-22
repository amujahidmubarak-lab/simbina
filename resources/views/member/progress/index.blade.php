<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">📈 Progress Pembinaan</h1><p class="text-sm text-slate-500 mt-1">Skor pembinaan Anda bulan ini.</p></div>
<!-- Total Score -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 mb-6 text-center">
<div class="inline-flex items-center justify-center w-32 h-32 rounded-full {{ $score['total']>=70?'bg-emerald-50 border-4 border-emerald-400':($score['total']>=40?'bg-amber-50 border-4 border-amber-400':'bg-red-50 border-4 border-red-400') }}">
<div><div class="text-4xl font-black {{ $score['total']>=70?'text-emerald-600':($score['total']>=40?'text-amber-600':'text-red-600') }}">{{ $score['total'] }}</div><div class="text-xs text-slate-500 font-medium">/ 100</div></div>
</div>
<p class="mt-4 text-sm text-slate-500">Berdasarkan amal harian (40%), amal mingguan (20%), kehadiran (30%), partisipasi (10%)</p>
</div>
<!-- Detail Scores -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
@php $items = [['Amal Harian','amal_harian','primary'],['Amal Mingguan','amal_mingguan','indigo'],['Kehadiran','kehadiran','emerald'],['Partisipasi','partisipasi','violet']]; @endphp
@foreach($items as [$label, $key, $color])
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
<div class="text-sm text-slate-500 mb-2">{{ $label }}</div>
<div class="text-2xl font-bold text-slate-900 mb-2">{{ $score[$key] }}%</div>
<div class="bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-{{ $color }}-500" style="width:{{ $score[$key] }}%"></div></div>
</div>@endforeach</div>
<!-- Timeline -->
@if($timeline->isNotEmpty())
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold text-slate-900 mb-4">🕐 Timeline Perjalanan</h2>
<div class="space-y-4">
@foreach($timeline as $t)
<div class="flex gap-4"><div class="w-3 h-3 rounded-full bg-primary-500 mt-1.5 shrink-0"></div><div><div class="font-medium text-slate-900">{{ $t->judul }}</div><div class="text-sm text-slate-500">{{ $t->deskripsi }}</div><div class="text-xs text-slate-400">{{ $t->tanggal->format('d M Y') }}</div></div></div>
@endforeach</div></div>@endif
</x-app-layout>
