<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Kehadiran Kegiatan</h1><p class="text-sm text-slate-500 mt-1">Kelola absensi per kegiatan.</p></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Kegiatan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tanggal</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tipe</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Aksi</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($kegiatans as $k)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium text-slate-900">{{ $k->judul }}</td><td class="py-3 px-4 text-sm text-slate-600">{{ $k->tanggal_waktu->format('d M Y H:i') }}</td><td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">{{ $k->tipe }}</span></td>
<td class="py-3 px-4 text-center"><a href="{{ route('admin.attendances.show', $k) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Input Absensi</a></td></tr>
@empty<tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada kegiatan.</td></tr>@endforelse
</tbody></table>
</div>
<div class="mt-4">{{ $kegiatans->links() }}</div>
</x-app-layout>
