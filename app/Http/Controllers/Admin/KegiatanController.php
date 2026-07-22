<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kontrakan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with(['kontrakan', 'creator'])->orderBy('tanggal_waktu', 'desc')->paginate(10);
        return view('admin.kegiatans.index', compact('kegiatans'));
    }

    public function create()
    {
        $kontrakans = Kontrakan::where('status', 'active')->get();
        return view('admin.kegiatans.create', compact('kontrakans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_waktu' => 'required|date',
            'tempat' => 'required|string|max:255',
            'tipe' => 'required|in:rutin,insidental',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'kontrakan_id' => 'nullable|exists:kontrakans,id',
        ]);

        $validated['created_by'] = auth()->id();

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatans.index')->with('status', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load(['kontrakan', 'creator']);
        return view('admin.kegiatans.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kontrakans = Kontrakan::where('status', 'active')->get();
        return view('admin.kegiatans.edit', compact('kegiatan', 'kontrakans'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_waktu' => 'required|date',
            'tempat' => 'required|string|max:255',
            'tipe' => 'required|in:rutin,insidental',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'kontrakan_id' => 'nullable|exists:kontrakans,id',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatans.index')->with('status', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('admin.kegiatans.index')->with('status', 'Kegiatan berhasil dihapus.');
    }
}
