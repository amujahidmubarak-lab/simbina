<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Detail Mentoring</h1><p class="text-sm text-slate-500 mt-1">{{ $mentoring->mentor->name }} → {{ $mentoring->mentee->name }}</p></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold text-slate-900 mb-4">Tambah Catatan Mentoring</h2>
<form method="POST" action="{{ route('admin.mentoring.notes.store', $mentoring) }}" class="space-y-4">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label><input type="date" name="tanggal" value="{{ now()->format('Y-m-d') }}" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Catatan</label><textarea name="catatan" rows="4" required class="w-full rounded-lg border-slate-300"></textarea></div>
<button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Simpan</button>
</form></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold text-slate-900 mb-4">Riwayat Catatan</h2>
<div class="space-y-4">
@forelse($mentoring->notes as $n)
<div class="border-l-4 border-primary-400 pl-4 py-2"><p class="text-sm text-slate-600">{{ $n->catatan }}</p><p class="text-xs text-slate-400 mt-1">{{ $n->tanggal->format('d M Y') }} — {{ $n->author->name }}</p></div>
@empty<p class="text-sm text-slate-500">Belum ada catatan.</p>@endforelse
</div></div></div>
</x-app-layout>
