<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Penugasan</h1></div><a href="{{ route('admin.penugasan.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Buat Tugas</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Tugas</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Untuk</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Deadline</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Status</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($penugasans as $p)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $p->judul }}</td><td class="py-3 px-4 text-sm">{{ $p->user->name }}</td><td class="py-3 px-4 text-sm text-slate-500">{{ $p->deadline?->format('d M Y') ?? '-' }}</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium {{ $p->status==='selesai'?'bg-emerald-100 text-emerald-700':($p->status==='dikerjakan'?'bg-amber-100 text-amber-700':'bg-slate-100 text-slate-600') }} capitalize">{{ $p->status }}</span></td></tr>
@empty<tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada penugasan.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $penugasans->links() }}</div>
</x-app-layout>
