<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Tambah Artikel</h1></div>
<form method="POST" action="{{ route('admin.knowledge-base.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-3xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Judul</label><input type="text" name="judul" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label><select name="tipe" required class="w-full rounded-lg border-slate-300"><option value="artikel">Artikel</option><option value="panduan">Panduan</option><option value="sop">SOP</option><option value="faq">FAQ</option></select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Konten</label><textarea name="konten" rows="12" required class="w-full rounded-lg border-slate-300"></textarea></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
