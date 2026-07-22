<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Buat Penugasan</h1></div>
<form method="POST" action="{{ route('admin.penugasan.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Judul Tugas</label><input type="text" name="judul" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Untuk Anggota</label><select name="user_id" required class="w-full rounded-lg border-slate-300"><option value="">-- Pilih --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Terkait Kegiatan (Opsional)</label><select name="kegiatan_id" class="w-full rounded-lg border-slate-300"><option value="">-- Tidak Terkait --</option>@foreach($kegiatans as $k)<option value="{{ $k->id }}">{{ $k->judul }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" class="w-full rounded-lg border-slate-300"></textarea></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Deadline</label><input type="date" name="deadline" class="w-full rounded-lg border-slate-300"></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
