<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Edit Inventaris: {{ $inventari->nama }}</h1></div>
<form method="POST" action="{{ route('admin.inventaris.update', $inventari) }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf @method('PUT')
<div><label class="block text-sm font-medium text-slate-700 mb-1">Nama Barang</label><input type="text" name="nama" required value="{{ $inventari->nama }}" class="w-full rounded-lg border-slate-300"></div>
<div class="grid grid-cols-2 gap-4">
<div><label class="block text-sm font-medium text-slate-700 mb-1">Jumlah</label><input type="number" name="jumlah" value="{{ $inventari->jumlah }}" min="1" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Kondisi</label><select name="kondisi" required class="w-full rounded-lg border-slate-300">@foreach(['baik','rusak_ringan','rusak_berat'] as $c)<option value="{{ $c }}" {{ $inventari->kondisi===$c?'selected':'' }}>{{ str_replace('_',' ',ucfirst($c)) }}</option>@endforeach</select></div></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Lokasi</label><input type="text" name="lokasi" value="{{ $inventari->lokasi }}" class="w-full rounded-lg border-slate-300"></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Update</button>
</form></x-app-layout>
