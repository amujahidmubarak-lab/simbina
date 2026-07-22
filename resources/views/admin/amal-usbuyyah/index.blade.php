<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Rekap Amal Mingguan</h1>
            <p class="text-sm text-slate-500 mt-1">Pekan: {{ $startOfWeek->format('d M Y') }} s/d {{ $startOfWeek->copy()->endOfWeek()->format('d M Y') }}</p>
        </div>
        
        <form method="GET" action="{{ route('admin.amal-usbuyyah.index') }}" class="flex gap-2">
            <input type="date" name="date" value="{{ $startOfWeek->format('Y-m-d') }}" class="rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Filter Pekan</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Anggota</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Puasa Sunnah</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Al-Kahfi</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Olahraga</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Bersih Kontrakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $u)
                        @php $a = $amalan->get($u->id); @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 font-medium text-slate-900">{{ $u->name }}</td>
                            <td class="py-3 px-4 text-center">
                                @if($a && $a->puasa_sunnah) <span class="text-emerald-500 font-bold">✓</span> @else <span class="text-slate-300">-</span> @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($a && $a->baca_alkahfi) <span class="text-emerald-500 font-bold">✓</span> @else <span class="text-slate-300">-</span> @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($a && $a->olahraga) <span class="text-emerald-500 font-bold">✓</span> @else <span class="text-slate-300">-</span> @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($a && $a->bersih_kontrakan) <span class="text-emerald-500 font-bold">✓</span> @else <span class="text-slate-300">-</span> @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">Belum ada data anggota.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
