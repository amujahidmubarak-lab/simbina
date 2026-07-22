<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\CatatanPembinaan;
use App\Models\User;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $memberIds = $kontrakan ? $kontrakan->members()->where('status', 'active')->pluck('user_id') : collect();

        $catatan = CatatanPembinaan::whereIn('user_id', $memberIds)
            ->with('user', 'author')
            ->latest()
            ->paginate(15);

        return view('koordinator.catatan.index', compact('catatan', 'kontrakan'));
    }

    public function create()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $memberIds = $kontrakan ? $kontrakan->members()->where('status', 'active')->pluck('user_id') : collect();
        $members = User::whereIn('id', $memberIds)->orderBy('name')->get();

        return view('koordinator.catatan.create', compact('members', 'kontrakan'));
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tipe'    => 'required|in:evaluasi,perkembangan,khusus',
            'konten'  => 'required|string',
        ]);

        CatatanPembinaan::create([
            ...$v,
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('koordinator.catatan.index')
            ->with('status', 'Catatan pembinaan berhasil disimpan.');
    }

    public function destroy(CatatanPembinaan $catatanPembinaan)
    {
        $this->authorize('delete', $catatanPembinaan);
        $catatanPembinaan->delete();
        return back()->with('status', 'Catatan dihapus.');
    }
}
