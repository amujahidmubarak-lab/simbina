<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Manajemen Kontrakan</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola data kontrakan pembinaan dan kapasitasnya.</p>
        </div>
        <div>
            <a href="{{ route('admin.kontrakans.create') }}" class="inline-flex bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm shadow-primary-600/20">
                + Tambah Kontrakan
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama & Alamat</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kapasitas</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">PJ</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($kontrakans as $k)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4">
                                <div class="font-medium text-slate-900">{{ $k->nama_kontrakan }}</div>
                                <div class="text-sm text-slate-500 truncate max-w-xs">{{ $k->alamat }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 bg-slate-200 rounded-full h-1.5">
                                        <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{ $k->kapasitas > 0 ? min(($k->members_count / $k->kapasitas) * 100, 100) : 0 }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-slate-600">{{ $k->members_count }}/{{ $k->kapasitas }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-sm font-medium text-slate-700">{{ $k->penanggungJawab?->name ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-4">
                                @if ($k->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.kontrakans.show', $k) }}" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-md font-medium transition-colors">Detail</a>
                                    <a href="{{ route('admin.kontrakans.edit', $k) }}" class="text-xs bg-amber-50 hover:bg-amber-100 text-amber-700 px-3 py-1.5 rounded-md font-medium transition-colors">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">
                                Belum ada data kontrakan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kontrakans->hasPages())
        <div class="px-4 py-3 border-t border-slate-200">
            {{ $kontrakans->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
