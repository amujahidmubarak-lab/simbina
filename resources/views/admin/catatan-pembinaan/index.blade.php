<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Catatan Pembinaan</h1></div><a href="{{ route('admin.catatan-pembinaan.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Tambah Catatan</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Anggota</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tipe</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Catatan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Oleh</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tanggal</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($catatans as $c)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $c->user->name }}</td><td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium {{ $c->tipe==='evaluasi'?'bg-blue-100 text-blue-700':($c->tipe==='khusus'?'bg-red-100 text-red-700':'bg-emerald-100 text-emerald-700') }} capitalize">{{ $c->tipe }}</span></td><td class="py-3 px-4 text-sm text-slate-600 max-w-xs truncate">{{ $c->konten }}</td><td class="py-3 px-4 text-sm">{{ $c->author->name }}</td><td class="py-3 px-4 text-sm text-slate-500">{{ $c->created_at->format('d M Y') }}</td></tr>
@empty<tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada catatan.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $catatans->links() }}</div>
</x-app-layout>
