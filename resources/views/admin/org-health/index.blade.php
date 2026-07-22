<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">🏥 Kesehatan Organisasi</h1><p class="text-sm text-slate-500 mt-1">Analisis aktivitas seluruh anggota dan kontrakan.</p></div>
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6"><div class="text-sm text-slate-500 mb-1">Total Anggota</div><div class="text-3xl font-bold text-slate-900">{{ $totalMembers }}</div></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6"><div class="text-sm text-slate-500 mb-1">Total Kontrakan</div><div class="text-3xl font-bold text-slate-900">{{ $totalKontrakans }}</div></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6"><div class="text-sm text-slate-500 mb-1">Isi Amal Hari Ini</div><div class="text-3xl font-bold {{ $amalRate>=70?'text-emerald-600':($amalRate>=40?'text-amber-600':'text-red-600') }}">{{ $amalRate }}%</div><div class="text-xs text-slate-400">{{ $todayAmalCount }}/{{ $totalMembers }}</div></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6"><div class="text-sm text-slate-500 mb-1">Kehadiran Bulan Ini</div><div class="text-3xl font-bold {{ $hadirRate>=70?'text-emerald-600':($hadirRate>=40?'text-amber-600':'text-red-600') }}">{{ $hadirRate }}%</div></div>
</div>
<!-- Kontrakan Health -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-6">
<h2 class="font-bold text-slate-900 mb-4">Status Kontrakan Hari Ini</h2>
<div class="space-y-4">
@foreach($kontrakanStats as $ks)
<div class="flex items-center gap-4">
<span class="text-sm font-medium text-slate-700 w-40 truncate">{{ $ks['kontrakan']->nama_kontrakan }}</span>
<div class="flex-1 bg-slate-100 rounded-full h-4"><div class="h-4 rounded-full {{ $ks['rate']>=70?'bg-emerald-500':($ks['rate']>=40?'bg-amber-500':'bg-red-500') }} transition-all" style="width:{{ $ks['rate'] }}%"></div></div>
<span class="text-sm font-bold {{ $ks['rate']>=70?'text-emerald-600':($ks['rate']>=40?'text-amber-600':'text-red-600') }} w-16 text-right">{{ $ks['filled'] }}/{{ $ks['total'] }}</span>
</div>@endforeach</div></div>
<!-- Tren Bulanan -->
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold text-slate-900 mb-4">Tren Aktivitas 6 Bulan Terakhir</h2>
<div class="flex items-end gap-4 h-48">
@foreach($tren as $t)
@php $max = max(array_column($tren,'aktif'),1); $h = ($t['aktif']/$max)*100; @endphp
<div class="flex-1 flex flex-col items-center gap-2">
<span class="text-xs font-bold text-slate-700">{{ $t['aktif'] }}</span>
<div class="w-full bg-primary-500 rounded-t-lg transition-all" style="height:{{ max($h,5) }}%"></div>
<span class="text-[10px] text-slate-500">{{ $t['bulan'] }}</span>
</div>@endforeach</div></div>
</x-app-layout>
