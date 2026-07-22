<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::with('creator')->latest()->paginate(10);
        return view('admin.materis.index', compact('materis'));
    }

    public function create()
    {
        return view('admin.materis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // max 10MB
            'link_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('materis', 'public');
        }

        $validated['created_by'] = auth()->id();

        Materi::create($validated);

        return redirect()->route('admin.materis.index')->with('status', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        return view('admin.materis.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'link_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('materis', 'public');
        }

        $materi->update($validated);

        return redirect()->route('admin.materis.index')->with('status', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();
        return redirect()->route('admin.materis.index')->with('status', 'Materi berhasil dihapus.');
    }
}
