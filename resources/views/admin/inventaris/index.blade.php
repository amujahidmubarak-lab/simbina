<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Inventaris Kontrakan</h1></div><a href="{{ route('admin.inventaris.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Tambah Barang</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama Barang</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Kontrakan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Jumlah</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Kondisi</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Aksi</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($items as $i)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $i->nama }}</td><td class="py-3 px-4 text-sm">{{ $i->kontrakan->nama_kontrakan }}</td><td class="py-3 px-4 text-center font-bold">{{ $i->jumlah }}</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium {{ $i->kondisi==='baik'?'bg-emerald-100 text-emerald-700':($i->kondisi==='rusak_ringan'?'bg-amber-100 text-amber-700':'bg-red-100 text-red-700') }}">{{ str_replace('_',' ',$i->kondisi) }}</span></td>
<td class="py-3 px-4 text-center"><a href="{{ route('admin.inventaris.edit', $i) }}" class="text-primary-600 text-sm font-medium">Edit</a></td></tr>
@empty<tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada inventaris.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $items->links() }}</div>
</x-app-layout>
