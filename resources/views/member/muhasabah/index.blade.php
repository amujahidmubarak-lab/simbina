<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">📝 Muhasabah Mingguan</h1><p class="text-sm text-slate-500 mt-1">Jurnal refleksi mingguan Anda. Pekan: {{ $startOfWeek->format('d M Y') }}</p></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
<form method="POST" action="{{ route('member.muhasabah.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">🎯 Capaian pekan ini</label><textarea name="capaian" rows="3" class="w-full rounded-lg border-slate-300" placeholder="Apa yang berhasil dicapai pekan ini?">{{ $current?->capaian }}</textarea></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">⚡ Kendala yang dihadapi</label><textarea name="kendala" rows="3" class="w-full rounded-lg border-slate-300" placeholder="Tantangan apa yang muncul?">{{ $current?->kendala }}</textarea></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">🚀 Target pekan depan</label><textarea name="target" rows="3" class="w-full rounded-lg border-slate-300" placeholder="Apa target untuk pekan selanjutnya?">{{ $current?->target }}</textarea></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700 w-full">Simpan Muhasabah</button>
</form>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
<h2 class="font-bold text-slate-900 mb-4">📚 Riwayat Muhasabah</h2>
<div class="space-y-4 max-h-[600px] overflow-y-auto">
@forelse($history as $h)
<div class="border-l-4 border-primary-400 pl-4 py-3">
<div class="text-xs text-slate-400 mb-2 font-medium">Pekan {{ $h->tanggal_awal_pekan->format('d M Y') }}</div>
@if($h->capaian)<div class="text-sm mb-1"><span class="font-medium text-emerald-600">Capaian:</span> {{ Str::limit($h->capaian, 100) }}</div>@endif
@if($h->kendala)<div class="text-sm mb-1"><span class="font-medium text-amber-600">Kendala:</span> {{ Str::limit($h->kendala, 100) }}</div>@endif
@if($h->target)<div class="text-sm"><span class="font-medium text-primary-600">Target:</span> {{ Str::limit($h->target, 100) }}</div>@endif
</div>
@empty<p class="text-sm text-slate-500">Belum ada riwayat muhasabah.</p>@endforelse
</div></div></div>
</x-app-layout>
