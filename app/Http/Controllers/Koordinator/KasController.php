<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\KasKontrakan;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $transaksis = $kontrakan
            ? KasKontrakan::where('kontrakan_id', $kontrakan->id)->with('user')->latest('tanggal')->paginate(20)
            : collect();

        $saldo = $kontrakan
            ? KasKontrakan::where('kontrakan_id', $kontrakan->id)
                ->selectRaw("SUM(CASE WHEN tipe='masuk' THEN jumlah ELSE -jumlah END) as saldo")
                ->value('saldo') ?? 0
            : 0;

        return view('koordinator.kas.index', compact('transaksis', 'saldo', 'kontrakan'));
    }

    public function create()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan, 403);
        return view('koordinator.kas.create', compact('kontrakan'));
    }

    public function store(Request $request)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        abort_unless($kontrakan, 403);

        $v = $request->validate([
            'tipe'       => 'required|in:masuk,keluar',
            'jumlah'     => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:500',
            'tanggal'    => 'required|date',
        ]);

        KasKontrakan::create([
            ...$v,
            'kontrakan_id' => $kontrakan->id,
            'user_id'      => auth()->id(),
        ]);

        return redirect()->route('koordinator.kas.index')
            ->with('status', 'Transaksi kas berhasil dicatat.');
    }
}
