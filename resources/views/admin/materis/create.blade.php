<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Tambah Materi</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-2xl">
        <form action="{{ route('admin.materis.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Materi</label>
                <input type="text" name="judul" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload File (PDF/Doc/dll, Opsional)</label>
                <input type="file" name="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Link URL (Opsional)</label>
                <input type="url" name="link_url" class="w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm" placeholder="https://...">
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700">Simpan Materi</button>
            </div>
        </form>
    </div>
</x-app-layout>
