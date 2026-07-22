<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Rekap Mutaba'ah Yaumiyyah</h1>
            <p class="text-sm text-slate-500 mt-1">Pantau amalan harian seluruh anggota pembinaan.</p>
        </div>
        <div>
            <form method="GET" class="flex items-center gap-2">
                <label for="date" class="text-sm font-medium text-slate-700">Tanggal:</label>
                <input type="date" name="date" id="date" value="{{ $date }}" class="rounded-md border-slate-300 shadow-sm text-sm py-1.5 focus:ring-primary-500 focus:border-primary-500" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider sticky left-0 bg-slate-50 border-r border-slate-200">Nama Anggota</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center" title="Shalat Fardhu Berjamaah">Berjamaah</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center" title="Tilawah Halaman">Tilawah</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center" title="Qiyamul Lail">Q. Lail</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center" title="Puasa Sunnah">Puasa</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center" title="Infaq/Sedekah">Infaq</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $user)
                        @php
                            $amal = $user->amalYaumiyyahs->first();
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4 sticky left-0 bg-white group-hover:bg-slate-50 border-r border-slate-200 font-medium text-slate-900 text-sm shadow-[1px_0_0_0_#e2e8f0]">
                                {{ $user->name }}
                            </td>
                            
                            @if($amal)
                                <td class="py-3 px-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold {{ $amal->shalat_berjamaah >= 5 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $amal->shalat_berjamaah }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="text-sm font-medium {{ $amal->tilawah_halaman > 0 ? 'text-emerald-600' : 'text-slate-500' }}">{{ $amal->tilawah_halaman }}</span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($amal->qiyamul_lail)
                                        <svg class="w-5 h-5 mx-auto text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($amal->puasa_sunnah)
                                        <svg class="w-5 h-5 mx-auto text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($amal->infaq)
                                        <svg class="w-5 h-5 mx-auto text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-sm text-slate-500 truncate max-w-[150px] inline-block" title="{{ $amal->catatan }}">{{ $amal->catatan ?: '-' }}</span>
                                </td>
                            @else
                                <td colspan="6" class="py-3 px-4 text-center text-sm text-slate-400 italic">
                                    Belum mengisi mutaba'ah
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">
                                Belum ada user yang disetujui.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-4 py-3 border-t border-slate-200">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
