<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('admin.kontrakans.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Kontrakan</a>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-sm font-medium text-slate-900">Detail Kontrakan</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $kontrakan->nama_kontrakan }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $kontrakan->alamat }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.kontrakans.edit', $kontrakan) }}" class="inline-flex items-center justify-center bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm">
                Edit
            </a>
            <form action="{{ route('admin.kontrakans.destroy', $kontrakan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontrakan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 px-4 py-2 rounded-lg font-medium text-sm transition-colors shadow-sm">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('status') }}
        </div>
    @endif
    
    @error('user_id')
        <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ $message }}
        </div>
    @enderror

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Informasi</h3>
            <div class="space-y-4">
                <div>
                    <div class="text-xs text-slate-400">Penanggung Jawab</div>
                    <div class="font-medium text-slate-900">{{ $kontrakan->penanggungJawab?->name ?? 'Belum ada' }}</div>
                </div>
                <div>
                    <div class="text-xs text-slate-400">Status</div>
                    @if ($kontrakan->status === 'active')
                        <span class="mt-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Aktif</span>
                    @else
                        <span class="mt-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">Nonaktif</span>
                    @endif
                </div>
                <div>
                    <div class="text-xs text-slate-400">Deskripsi</div>
                    <div class="text-sm text-slate-700 mt-1">{{ $kontrakan->deskripsi ?: '-' }}</div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kapasitas & Penghuni</h3>
                <span class="text-sm font-medium text-slate-900">{{ $kontrakan->members->where('status', 'active')->count() }} / {{ $kontrakan->kapasitas }}</span>
            </div>
            
            <div class="w-full bg-slate-100 rounded-full h-3 mb-6 overflow-hidden">
                <div class="bg-primary-500 h-3 rounded-full" style="width: {{ $kontrakan->kapasitas > 0 ? min(($kontrakan->members->where('status', 'active')->count() / $kontrakan->kapasitas) * 100, 100) : 0 }}%"></div>
            </div>

            <form action="{{ route('admin.kontrakans.members.add', $kontrakan) }}" method="POST" class="flex items-end gap-3 p-4 bg-slate-50 rounded-lg border border-slate-200 mb-6">
                @csrf
                <div class="flex-1">
                    <label for="user_id" class="block text-xs font-medium text-slate-700 mb-1">Tambah Penghuni</label>
                    <select name="user_id" id="user_id" class="w-full rounded-md border-slate-300 focus:border-primary-500 focus:ring-primary-500 text-sm" required>
                        <option value="">-- Pilih Anggota (Approved) --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="start_date" class="block text-xs font-medium text-slate-700 mb-1">Tgl Masuk</label>
                    <input type="date" name="start_date" id="start_date" value="{{ date('Y-m-d') }}" class="w-full rounded-md border-slate-300 focus:border-primary-500 focus:ring-primary-500 text-sm">
                </div>
                <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-md text-sm font-medium transition-colors">
                    Tambahkan
                </button>
            </form>

            <h4 class="text-sm font-bold text-slate-900 mb-3 border-b border-slate-200 pb-2">Daftar Penghuni Saat Ini</h4>
            <div class="space-y-3">
                @forelse ($kontrakan->members->where('status', 'active') as $member)
                    <div class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg hover:border-slate-300 transition-colors shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm uppercase">
                                {{ substr($member->user->name, 0, 2) }}
                            </div>
                            <div>
                                <div class="font-medium text-slate-900 text-sm">{{ $member->user->name }}</div>
                                <div class="text-xs text-slate-500">Sejak {{ $member->start_date ? $member->start_date->format('d M Y') : '-' }}</div>
                            </div>
                        </div>
                        <form action="{{ route('admin.kontrakans.members.remove', [$kontrakan, $member->user_id]) }}" method="POST" onsubmit="return confirm('Keluarkan penghuni ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 hover:bg-red-50 px-2 py-1 rounded transition-colors">Keluarkan</button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-6 text-sm text-slate-500 bg-slate-50 rounded-lg border border-slate-200 border-dashed">
                        Belum ada penghuni aktif di kontrakan ini.
                    </div>
                @endforelse
            </div>
            
            @if($kontrakan->members->where('status', 'inactive')->count() > 0)
                <h4 class="text-sm font-bold text-slate-900 mb-3 mt-8 border-b border-slate-200 pb-2">Riwayat Penghuni (Nonaktif)</h4>
                <div class="space-y-2 opacity-75">
                    @foreach ($kontrakan->members->where('status', 'inactive') as $member)
                        <div class="flex items-center justify-between p-2 bg-slate-50 border border-slate-100 rounded text-sm">
                            <div class="text-slate-700 font-medium">{{ $member->user->name }}</div>
                            <div class="text-xs text-slate-500">
                                {{ $member->start_date ? $member->start_date->format('d M Y') : '-' }} s/d {{ $member->end_date ? $member->end_date->format('d M Y') : '-' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
