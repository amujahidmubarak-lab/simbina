<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengumuman</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-2xl">
        <form action="{{ route('admin.pengumumans.update', $pengumuman) }}" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konten</label>
                <textarea name="konten" rows="5" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required>{{ $pengumuman->konten }}</textarea>
            </div>
            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_important" value="1" {{ $pengumuman->is_important ? 'checked' : '' }} class="rounded border-slate-300 text-primary-600 shadow-sm">
                    <span class="text-sm font-medium text-slate-700">Tandai Penting</span>
                </label>
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>
