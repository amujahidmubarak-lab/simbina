<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Tambah Inventaris</h1></div>
<form method="POST" action="{{ route('admin.inventaris.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Kontrakan</label><select name="kontrakan_id" required class="w-full rounded-lg border-slate-300">@foreach($kontrakans as $k)<option value="{{ $k->id }}">{{ $k->nama_kontrakan }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Nama Barang</label><input type="text" name="nama" required class="w-full rounded-lg border-slate-300"></div>
<div class="grid grid-cols-2 gap-4">
<div><label class="block text-sm font-medium text-slate-700 mb-1">Jumlah</label><input type="number" name="jumlah" value="1" min="1" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Kondisi</label><select name="kondisi" required class="w-full rounded-lg border-slate-300"><option value="baik">Baik</option><option value="rusak_ringan">Rusak Ringan</option><option value="rusak_berat">Rusak Berat</option></select></div></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Lokasi</label><input type="text" name="lokasi" class="w-full rounded-lg border-slate-300"></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
