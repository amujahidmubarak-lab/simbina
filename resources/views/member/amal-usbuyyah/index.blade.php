<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Mutaba'ah Mingguan</h1>
        <p class="text-sm text-slate-500 mt-1">Evaluasi amalan pekanan Anda.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-lg border border-emerald-200">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Pekan Ini -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="mb-6 pb-4 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-900">Pekan Ini</h2>
                <div class="text-sm text-slate-500">{{ $startOfWeek->format('d M Y') }} - {{ $startOfWeek->copy()->endOfWeek()->format('d M Y') }}</div>
            </div>

            <form action="{{ route('member.amal-usbuyyah.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:bg-slate-50 cursor-pointer transition-colors">
                    <input type="checkbox" name="puasa_sunnah" value="1" {{ ($myAmalThisWeek->puasa_sunnah ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <span class="font-medium text-slate-700">Puasa Sunnah (Senin/Kamis/Ayyamul Bidh)</span>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:bg-slate-50 cursor-pointer transition-colors">
                    <input type="checkbox" name="baca_alkahfi" value="1" {{ ($myAmalThisWeek->baca_alkahfi ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <span class="font-medium text-slate-700">Membaca Surat Al-Kahfi (Jumat)</span>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:bg-slate-50 cursor-pointer transition-colors">
                    <input type="checkbox" name="olahraga" value="1" {{ ($myAmalThisWeek->olahraga ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <span class="font-medium text-slate-700">Olahraga Pekanan</span>
                </label>

                <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:bg-slate-50 cursor-pointer transition-colors">
                    <input type="checkbox" name="bersih_kontrakan" value="1" {{ ($myAmalThisWeek->bersih_kontrakan ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <span class="font-medium text-slate-700">Piket / Bersih-bersih Kontrakan</span>
                </label>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                        Simpan Evaluasi Mingguan
                    </button>
                </div>
            </form>
        </div>

        <!-- Riwayat -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h2 class="font-bold text-slate-800">Riwayat 4 Pekan Terakhir</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($history as $h)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50">
                        <div>
                            <div class="font-medium text-slate-900">Pekan: {{ $h->tanggal_awal_pekan->format('d M') }}</div>
                        </div>
                        <div class="flex gap-2 text-xs">
                            <span class="px-2 py-1 rounded {{ $h->puasa_sunnah ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}" title="Puasa Sunnah">P</span>
                            <span class="px-2 py-1 rounded {{ $h->baca_alkahfi ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}" title="Al-Kahfi">K</span>
                            <span class="px-2 py-1 rounded {{ $h->olahraga ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}" title="Olahraga">O</span>
                            <span class="px-2 py-1 rounded {{ $h->bersih_kontrakan ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}" title="Bersih Kontrakan">B</span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">Belum ada riwayat pekan sebelumnya.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
