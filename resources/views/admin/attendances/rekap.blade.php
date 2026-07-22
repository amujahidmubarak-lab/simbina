<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Rekap Kehadiran Bulanan</h1></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Hadir</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Izin</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Alfa</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">%</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@foreach($rekap as $r)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $r['user']->name }}</td>
<td class="py-3 px-4 text-center text-emerald-600 font-bold">{{ $r['hadir'] }}</td>
<td class="py-3 px-4 text-center text-amber-600 font-bold">{{ $r['izin'] }}</td>
<td class="py-3 px-4 text-center text-red-600 font-bold">{{ $r['alfa'] }}</td>
<td class="py-3 px-4 text-center font-bold">{{ $r['total'] > 0 ? round(($r['hadir']/$r['total'])*100) : 0 }}%</td></tr>
@endforeach</tbody></table></div>
</x-app-layout>
