<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Tambah Pengumuman</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-2xl">
        <form action="{{ route('admin.pengumumans.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                <input type="text" name="judul" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konten</label>
                <textarea name="konten" rows="5" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required></textarea>
            </div>
            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_important" value="1" class="rounded border-slate-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <span class="text-sm font-medium text-slate-700">Tandai Penting</span>
                </label>
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Simpan Pengumuman</button>
            </div>
        </form>
    </div>
</x-app-layout>
