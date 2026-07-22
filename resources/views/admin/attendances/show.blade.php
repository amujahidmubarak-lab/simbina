<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Absensi: {{ $kegiatan->judul }}</h1><p class="text-sm text-slate-500 mt-1">{{ $kegiatan->tanggal_waktu->format('d M Y H:i') }} &bull; {{ $kegiatan->tempat }}</p></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<form method="POST" action="{{ route('admin.attendances.store', $kegiatan) }}">@csrf
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Hadir</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Izin</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Alfa</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Ket</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@foreach($members as $m)
@php $att = $attendances->get($m->id); $st = $att?->status ?? 'alfa'; @endphp
<tr class="hover:bg-slate-50">
<td class="py-3 px-4 font-medium text-slate-900">{{ $m->name }}</td>
<td class="py-3 px-4 text-center"><input type="radio" name="attendance[{{ $m->id }}]" value="hadir" {{ $st==='hadir'?'checked':'' }} class="text-emerald-600 focus:ring-emerald-500"></td>
<td class="py-3 px-4 text-center"><input type="radio" name="attendance[{{ $m->id }}]" value="izin" {{ $st==='izin'?'checked':'' }} class="text-amber-600 focus:ring-amber-500"></td>
<td class="py-3 px-4 text-center"><input type="radio" name="attendance[{{ $m->id }}]" value="alfa" {{ $st==='alfa'?'checked':'' }} class="text-red-600 focus:ring-red-500"></td>
<td class="py-3 px-4"><input type="text" name="keterangan[{{ $m->id }}]" value="{{ $att?->keterangan }}" class="w-full text-sm rounded border-slate-200 px-2 py-1" placeholder="Opsional"></td>
</tr>@endforeach
</tbody></table></div>
<div class="mt-4"><button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan Kehadiran</button></div>
</form>
</x-app-layout>
