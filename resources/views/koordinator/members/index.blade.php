<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Anggota Kontrakan</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $kontrakan?->nama_kontrakan ?? '-' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b">
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Email</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Skor Bulan Ini</th>
                    <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($members as $m)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-medium text-slate-900">{{ $m->user->name }}</td>
                        <td class="py-3 px-4 text-sm text-slate-600">{{ $m->user->email }}</td>
                        <td class="py-3 px-4 text-center">
                            @php $s = $m->score['total']; @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-bold
                                {{ $s >= 75 ? 'bg-emerald-100 text-emerald-700' : ($s >= 50 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                {{ $s }}/100
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-slate-500 text-center">{{ $m->start_date?->format('d M Y') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-8 text-center text-slate-500">Belum ada anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
