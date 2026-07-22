<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Audit Log</h1></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
<table class="w-full text-left"><thead><tr class="bg-slate-50 border-b"><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Waktu</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">User</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Aksi</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Model</th><th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">IP</th></tr></thead>
<tbody class="divide-y divide-slate-100">
@forelse($logs as $l)
<tr class="hover:bg-slate-50"><td class="py-3 px-4 text-sm text-slate-500">{{ $l->created_at->format('d/m/Y H:i:s') }}</td><td class="py-3 px-4 text-sm font-medium">{{ $l->user?->name ?? 'System' }}</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700">{{ $l->action }}</span></td>
<td class="py-3 px-4 text-sm text-slate-500">{{ $l->model_type ? class_basename($l->model_type).' #'.$l->model_id : '-' }}</td>
<td class="py-3 px-4 text-xs text-slate-400 font-mono">{{ $l->ip_address }}</td></tr>
@empty<tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada log.</td></tr>@endforelse
</tbody></table></div><div class="mt-4">{{ $logs->links() }}</div>
</x-app-layout>
