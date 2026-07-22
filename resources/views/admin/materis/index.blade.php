<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Materi Pembinaan</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola materi kajian, file PDF, atau link referensi.</p>
        </div>
        <div>
            <a href="{{ route('admin.materis.create') }}" class="inline-flex bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm">
                + Tambah Materi
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul Materi</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lampiran</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($materis as $m)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4">
                                <div class="font-medium text-slate-900">{{ $m->judul }}</div>
                                <div class="text-sm text-slate-500 truncate max-w-xs">{{ Str::limit($m->deskripsi, 50) }}</div>
                            </td>
                            <td class="py-3 px-4">
                                @if($m->file_path)
                                    <a href="{{ Storage::url($m->file_path) }}" target="_blank" class="text-xs text-blue-600 hover:underline">Download File</a><br>
                                @endif
                                @if($m->link_url)
                                    <a href="{{ $m->link_url }}" target="_blank" class="text-xs text-blue-600 hover:underline">Buka Link</a>
                                @endif
                                @if(!$m->file_path && !$m->link_url)
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-slate-500">{{ $m->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.materis.edit', $m) }}" class="text-xs bg-amber-50 hover:bg-amber-100 text-amber-700 px-3 py-1.5 rounded-md font-medium transition-colors">Edit</a>
                                    <form action="{{ route('admin.materis.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus materi ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-700 px-3 py-1.5 rounded-md font-medium transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-500">Belum ada materi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
