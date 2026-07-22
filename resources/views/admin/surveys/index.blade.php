<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Survey & Evaluasi</h1></div><a href="{{ route('admin.surveys.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Buat Survey</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Survey</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Kegiatan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Responden</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Status</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Aksi</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($surveys as $s)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $s->judul }}</td><td class="py-3 px-4 text-sm">{{ $s->kegiatan?->judul ?? '-' }}</td><td class="py-3 px-4 text-center font-bold">{{ $s->responses_count }}</td><td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-xs font-medium {{ $s->aktif?'bg-emerald-100 text-emerald-700':'bg-slate-100 text-slate-600' }}">{{ $s->aktif?'Aktif':'Nonaktif' }}</span></td>
<td class="py-3 px-4 text-center"><a href="{{ route('admin.surveys.show', $s) }}" class="text-primary-600 text-sm font-medium">Lihat Hasil</a></td></tr>
@empty<tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada survey.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $surveys->links() }}</div>
</x-app-layout>
