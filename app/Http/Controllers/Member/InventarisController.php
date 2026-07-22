<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;

class InventarisController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $kontrakan = $user->currentKontrakan();

        $inventaris = $kontrakan
            ? Inventaris::where('kontrakan_id', $kontrakan->id)->latest()->get()
            : collect();

        return view('member.inventaris.index', compact('inventaris', 'kontrakan'));
    }
}
