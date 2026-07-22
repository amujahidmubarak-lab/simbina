<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Kas Kontrakan</h1></div><a href="{{ route('admin.kas.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Catat Transaksi</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<!-- Saldo Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
@foreach($kontrakans as $k)
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4">
<h3 class="font-bold text-sm text-slate-900 mb-2">{{ $k->nama_kontrakan }}</h3>
<div class="flex justify-between text-sm"><span class="text-emerald-600">Masuk: Rp {{ number_format($saldos[$k->id]['masuk'] ?? 0) }}</span><span class="text-red-600">Keluar: Rp {{ number_format($saldos[$k->id]['keluar'] ?? 0) }}</span></div>
<div class="mt-2 pt-2 border-t font-bold text-lg {{ ($saldos[$k->id]['saldo'] ?? 0)>=0?'text-emerald-700':'text-red-700' }}">Saldo: Rp {{ number_format($saldos[$k->id]['saldo'] ?? 0) }}</div>
</div>@endforeach</div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tanggal</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Kontrakan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Keterangan</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-right">Jumlah</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($transactions as $t)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 text-sm">{{ $t->tanggal->format('d M Y') }}</td><td class="py-3 px-4 text-sm">{{ $t->kontrakan->nama_kontrakan }}</td><td class="py-3 px-4 text-sm">{{ $t->keterangan }}</td>
<td class="py-3 px-4 text-right font-bold {{ $t->tipe==='masuk'?'text-emerald-600':'text-red-600' }}">{{ $t->tipe==='masuk'?'+':'-' }} Rp {{ number_format($t->jumlah) }}</td></tr>
@empty<tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada transaksi.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $transactions->links() }}</div>
</x-app-layout>
