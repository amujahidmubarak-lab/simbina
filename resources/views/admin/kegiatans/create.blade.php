<x-app-layout>
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.kegiatans.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Kegiatan</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-sm font-medium text-slate-900">Tambah Baru</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Tambah Kegiatan</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.kegiatans.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_waktu" class="block text-sm font-medium text-slate-700 mb-1">Tanggal & Waktu <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" value="{{ old('tanggal_waktu') }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                    @error('tanggal_waktu') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="tempat" class="block text-sm font-medium text-slate-700 mb-1">Tempat <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat" id="tempat" value="{{ old('tempat') }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                    @error('tempat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="tipe" class="block text-sm font-medium text-slate-700 mb-1">Tipe <span class="text-red-500">*</span></label>
                    <select name="tipe" id="tipe" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                        <option value="rutin" {{ old('tipe') == 'rutin' ? 'selected' : '' }}>Rutin</option>
                        <option value="insidental" {{ old('tipe') == 'insidental' ? 'selected' : '' }}>Insidental</option>
                    </select>
                    @error('tipe') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="kontrakan_id" class="block text-sm font-medium text-slate-700 mb-1">Untuk Kontrakan (Opsional)</label>
                    <select name="kontrakan_id" id="kontrakan_id" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm">
                        <option value="">-- Global (Semua) --</option>
                        @foreach($kontrakans as $k)
                            <option value="{{ $k->id }}" {{ old('kontrakan_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kontrakan }}</option>
                        @endforeach
                    </select>
                    @error('kontrakan_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.kegiatans.index') }}" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Batal</a>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">Simpan Kegiatan</button>
            </div>
        </form>
    </div>
</x-app-layout>
