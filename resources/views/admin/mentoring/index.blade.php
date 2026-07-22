<x-app-layout>
<div class="mb-6 flex justify-between items-center"><div><h1 class="text-2xl font-bold text-slate-900">Mentoring</h1></div><a href="{{ route('admin.mentoring.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">+ Tugaskan Mentor</a></div>
@if(session('status'))<div class="mb-4 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">{{ session('status') }}</div>@endif
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Mentor</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Mentee</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Mulai</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Status</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Aksi</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($mentorings as $m)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 font-medium">{{ $m->mentor->name }}</td><td class="py-3 px-4">{{ $m->mentee->name }}</td><td class="py-3 px-4 text-sm text-slate-500">{{ $m->start_date->format('d M Y') }}</td><td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium {{ $m->status==='aktif'?'bg-emerald-100 text-emerald-700':'bg-slate-100 text-slate-600' }} capitalize">{{ $m->status }}</span></td>
<td class="py-3 px-4 text-center"><a href="{{ route('admin.mentoring.show', $m) }}" class="text-primary-600 text-sm font-medium">Detail</a></td></tr>
@empty<tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada data mentoring.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $mentorings->links() }}</div>
</x-app-layout>
