<x-app-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Mutaba'ah Yaumiyyah</h1>
            <p class="text-sm text-slate-500 mt-1">Catat dan evaluasi amal harian Anda (Shalat, Tilawah, dll).</p>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200 flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('status') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200 flex flex-col gap-1">
            @foreach($errors->all() as $e)
                <div class="flex items-center gap-3 text-sm">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $e }}
                </div>
            @endforeach
        </div>
    @endif

    @php
        $todayStr = now()->format('Y-m-d');
        $todayAmal = $amals->get($todayStr);
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Input Hari Ini -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden lg:col-span-1">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-800">Isi Amal Hari Ini</h2>
                <p class="text-xs text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <form action="{{ route('member.amal.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $todayStr }}">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Shalat Fardhu Berjamaah (Waktu)</label>
                    <input type="number" name="shalat_berjamaah" min="0" max="5" value="{{ old('shalat_berjamaah', $todayAmal?->shalat_berjamaah ?? 0) }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 text-sm">
                    <p class="text-xs text-slate-400 mt-1">Isi 0 hingga 5 waktu shalat.</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tilawah Al-Qur'an (Halaman)</label>
                    <input type="number" name="tilawah_halaman" min="0" value="{{ old('tilawah_halaman', $todayAmal?->tilawah_halaman ?? 0) }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 text-sm">
                </div>
                
                <div class="pt-2 space-y-3">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="qiyamul_lail" value="1" {{ old('qiyamul_lail', $todayAmal?->qiyamul_lail) ? 'checked' : '' }} class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 w-4 h-4">
                        <span class="text-sm font-medium text-slate-700">Qiyamul Lail (Tahajud)</span>
                    </label>
                    
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="puasa_sunnah" value="1" {{ old('puasa_sunnah', $todayAmal?->puasa_sunnah) ? 'checked' : '' }} class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 w-4 h-4">
                        <span class="text-sm font-medium text-slate-700">Puasa Sunnah</span>
                    </label>
                    
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="infaq" value="1" {{ old('infaq', $todayAmal?->infaq) ? 'checked' : '' }} class="rounded border-slate-300 text-primary-600 focus:ring-primary-500 w-4 h-4">
                        <span class="text-sm font-medium text-slate-700">Infaq / Sedekah</span>
                    </label>
                </div>

                <div class="pt-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="2" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 text-sm">{{ old('catatan', $todayAmal?->catatan) }}</textarea>
                </div>
                
                <button type="submit" class="w-full mt-4 bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 rounded-lg transition-colors">
                    Simpan Mutaba'ah
                </button>
            </form>
        </div>

        <!-- Riwayat Bulan Ini -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden lg:col-span-2">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-800">Riwayat Bulan Ini</h2>
                <form method="GET" class="flex gap-2 items-center">
                    <input type="month" name="month" value="{{ $month }}" class="rounded-md border-slate-300 text-sm py-1.5 focus:border-primary-500 focus:ring-primary-500" onchange="this.form.submit()">
                </form>
            </div>
            
            <div class="overflow-x-auto p-4">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 rounded">
                            <th class="p-3 rounded-l">Tanggal</th>
                            <th class="p-3 text-center">Berjamaah</th>
                            <th class="p-3 text-center">Tilawah</th>
                            <th class="p-3 text-center" title="Qiyamul Lail">QL</th>
                            <th class="p-3 text-center" title="Puasa">PS</th>
                            <th class="p-3 text-center rounded-r" title="Infaq">INF</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php
                            $loopDate = $endOfMonth->copy();
                            $hasData = false;
                        @endphp
                        
                        @while($loopDate->gte($startOfMonth) && $loopDate->lte(now()))
                            @php
                                $dStr = $loopDate->format('Y-m-d');
                                $amal = $amals->get($dStr);
                                $hasData = true;
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-medium {{ $dStr === $todayStr ? 'text-primary-600' : 'text-slate-700' }}">
                                    {{ $loopDate->format('d M Y') }}
                                </td>
                                <td class="p-3 text-center">
                                    @if($amal)
                                        <span class="{{ $amal->shalat_berjamaah >= 5 ? 'text-emerald-600 font-bold' : 'text-slate-600' }}">{{ $amal->shalat_berjamaah }}/5</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if($amal)
                                        <span class="text-slate-600">{{ $amal->tilawah_halaman }} hal</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if($amal && $amal->qiyamul_lail)
                                        <span class="text-emerald-500">✓</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if($amal && $amal->puasa_sunnah)
                                        <span class="text-emerald-500">✓</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if($amal && $amal->infaq)
                                        <span class="text-emerald-500">✓</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $loopDate->subDay();
                            @endphp
                        @endwhile
                        
                        @if(!$hasData)
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-500">
                                    Belum ada data untuk bulan ini.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
