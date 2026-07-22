<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Absensi: {{ $kegiatan->judul }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ $kegiatan->tanggal_waktu->format('d M Y, H:i') }} &bull; {{ $kegiatan->tempat }}</p>
    </div>

    @if(session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg px-4 py-3 text-sm">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('koordinator.attendances.store', $kegiatan) }}">
        @csrf
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-4">
            <table class="w-full text-left">
                <thead><tr class="bg-slate-50 border-b">
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Status</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Keterangan</th>
                </tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($members as $m)
                        @php $att = $attendances[$m->id] ?? null; @endphp
                        <tr class="hover:bg-slate-50">
                            <td class="py-3 px-4 font-medium text-slate-900">{{ $m->name }}</td>
                            <td class="py-3 px-4 text-center">
                                <select name="attendance[{{ $m->id }}]" class="rounded-lg border border-slate-200 px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option value="hadir" {{ ($att?->status ?? '') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin"  {{ ($att?->status ?? '') === 'izin'  ? 'selected' : '' }}>Izin</option>
                                    <option value="alfa"  {{ ($att?->status ?? '') === 'alfa'  ? 'selected' : '' }}>Alfa</option>
                                </select>
                            </td>
                            <td class="py-3 px-4">
                                <input type="text" name="keterangan[{{ $m->id }}]" value="{{ $att?->keterangan }}"
                                    placeholder="Keterangan (opsional)"
                                    class="w-full rounded-lg border border-slate-200 px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-8 text-center text-slate-500">Belum ada anggota.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-semibold text-sm shadow-sm transition-colors">
            Simpan Kehadiran
        </button>
    </form>
</x-app-layout>
