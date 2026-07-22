<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\KasKontrakan;

class KasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $kontrakan = $user->currentKontrakan();

        $transaksis = $kontrakan
            ? KasKontrakan::where('kontrakan_id', $kontrakan->id)->with('user')->latest('tanggal')->paginate(20)
            : collect();

        $saldo = $kontrakan
            ? KasKontrakan::where('kontrakan_id', $kontrakan->id)
                ->selectRaw("SUM(CASE WHEN tipe='masuk' THEN jumlah ELSE -jumlah END) as saldo")
                ->value('saldo') ?? 0
            : 0;

        return view('member.kas.index', compact('transaksis', 'saldo', 'kontrakan'));
    }
}
