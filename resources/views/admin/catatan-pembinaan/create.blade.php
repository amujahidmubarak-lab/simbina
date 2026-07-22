<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Tambah Catatan Pembinaan</h1></div>
<form method="POST" action="{{ route('admin.catatan-pembinaan.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Anggota</label><select name="user_id" required class="w-full rounded-lg border-slate-300"><option value="">-- Pilih --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label><select name="tipe" required class="w-full rounded-lg border-slate-300"><option value="perkembangan">Perkembangan</option><option value="evaluasi">Evaluasi</option><option value="khusus">Khusus</option></select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Isi Catatan</label><textarea name="konten" rows="5" required class="w-full rounded-lg border-slate-300"></textarea></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
