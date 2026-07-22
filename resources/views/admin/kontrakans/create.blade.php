<x-app-layout>
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.kontrakans.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">Kontrakan</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-sm font-medium text-slate-900">Tambah Baru</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">Tambah Kontrakan</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.kontrakans.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="nama_kontrakan" class="block text-sm font-medium text-slate-700 mb-1">Nama Kontrakan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kontrakan" id="nama_kontrakan" value="{{ old('nama_kontrakan') }}" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                @error('nama_kontrakan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm">{{ old('alamat') }}</textarea>
                @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="kapasitas" class="block text-sm font-medium text-slate-700 mb-1">Kapasitas Penghuni <span class="text-red-500">*</span></label>
                    <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas', 0) }}" min="1" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                    @error('kapasitas') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="penanggung_jawab" class="block text-sm font-medium text-slate-700 mb-1">Penanggung Jawab (Opsional)</label>
                <select name="penanggung_jawab" id="penanggung_jawab" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm">
                    <option value="">-- Pilih Penanggung Jawab --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ old('penanggung_jawab') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
                @error('penanggung_jawab') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Tambahan</label>
                <textarea name="deskripsi" id="deskripsi" rows="2" class="w-full rounded-lg border-slate-300 focus:border-primary-500 focus:ring-primary-500 shadow-sm sm:text-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.kontrakans.index') }}" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Batal</a>
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors shadow-sm shadow-primary-600/20">Simpan Kontrakan</button>
            </div>
        </form>
    </div>
</x-app-layout>
