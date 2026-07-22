<x-app-layout>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Monitoring Amal Harian</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $kontrakan?->nama_kontrakan }}</p>
        </div>
        <form method="GET">
            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()"
                class="rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-slate-50 border-b">
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase">Nama</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Tilawah</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Berjamaah</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Qiyamul Lail</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Puasa Sunnah</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Infaq</th>
                <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase text-center">Status</th>
            </tr></thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $u)
                    @php $amal = $u->amalYaumiyyahs->first(); @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-medium text-slate-900">{{ $u->name }}</td>
                        @if($amal)
                            <td class="py-3 px-4 text-center text-sm">{{ $amal->tilawah_halaman ?? '-' }}</td>
                            <td class="py-3 px-4 text-center">{{ $amal->shalat_berjamaah ?? '-' }}/5</td>
                            <td class="py-3 px-4 text-center">{{ $amal->qiyamul_lail ? '✅' : '❌' }}</td>
                            <td class="py-3 px-4 text-center">{{ $amal->puasa_sunnah ? '✅' : '❌' }}</td>
                            <td class="py-3 px-4 text-center">{{ $amal->infaq ? '✅' : '❌' }}</td>
                            <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Isi</span></td>
                        @else
                            <td colspan="5" class="py-3 px-4 text-center text-slate-400 text-sm">Belum diisi</td>
                            <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-600">Kosong</span></td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-8 text-center text-slate-500">Belum ada anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
