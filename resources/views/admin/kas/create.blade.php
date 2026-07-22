<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Catat Transaksi Kas</h1></div>
<form method="POST" action="{{ route('admin.kas.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Kontrakan</label><select name="kontrakan_id" required class="w-full rounded-lg border-slate-300">@foreach($kontrakans as $k)<option value="{{ $k->id }}">{{ $k->nama_kontrakan }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label><select name="tipe" required class="w-full rounded-lg border-slate-300"><option value="masuk">Pemasukan</option><option value="keluar">Pengeluaran</option></select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Jumlah (Rp)</label><input type="number" name="jumlah" min="1" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label><input type="text" name="keterangan" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label><input type="date" name="tanggal" value="{{ now()->format('Y-m-d') }}" required class="w-full rounded-lg border-slate-300"></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
