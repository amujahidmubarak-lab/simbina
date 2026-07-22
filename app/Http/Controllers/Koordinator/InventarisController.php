<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $inventaris = $kontrakan
            ? Inventaris::where('kontrakan_id', $kontrakan->id)->latest()->paginate(15)
            : collect();

        return view('koordinator.inventaris.index', compact('inventaris', 'kontrakan'));
    }

    public function create()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        return view('koordinator.inventaris.create', compact('kontrakan'));
    }

    public function store(Request $request)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan, 403);

        $v = $request->validate([
            'nama'        => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:1',
            'kondisi'     => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi'      => 'nullable|string|max:255',
            'keterangan'  => 'nullable|string',
        ]);

        Inventaris::create([...$v, 'kontrakan_id' => $kontrakan->id]);

        return redirect()->route('koordinator.inventaris.index')
            ->with('status', 'Barang berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventari)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan && $inventari->kontrakan_id === $kontrakan->id, 403);
        return view('koordinator.inventaris.edit', compact('inventari', 'kontrakan'));
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan && $inventari->kontrakan_id === $kontrakan->id, 403);

        $v = $request->validate([
            'nama'       => 'required|string|max:255',
            'jumlah'     => 'required|integer|min:1',
            'kondisi'    => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi'     => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $inventari->update($v);

        return redirect()->route('koordinator.inventaris.index')
            ->with('status', 'Barang berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan && $inventari->kontrakan_id === $kontrakan->id, 403);
        $inventari->delete();
        return back()->with('status', 'Barang dihapus.');
    }
}
