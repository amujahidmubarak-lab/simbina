<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::with('creator')->latest()->paginate(10);
        return view('admin.pengumumans.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumumans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'is_important' => 'nullable',
        ]);

        $validated['is_important'] = $request->has('is_important');
        $validated['created_by'] = auth()->id();

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumumans.index')->with('status', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumumans.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'is_important' => 'nullable',
        ]);

        $validated['is_important'] = $request->has('is_important');
        $pengumuman->update($validated);

        return redirect()->route('admin.pengumumans.index')->with('status', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumumans.index')->with('status', 'Pengumuman berhasil dihapus.');
    }
}
