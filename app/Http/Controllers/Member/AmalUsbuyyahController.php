<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\AmalUsbuyyah;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AmalUsbuyyahController extends Controller
{
    public function index()
    {
        $startOfWeek = now()->startOfWeek();
        $myAmalThisWeek = AmalUsbuyyah::where('user_id', auth()->id())
            ->where('tanggal_awal_pekan', $startOfWeek->format('Y-m-d'))
            ->first();

        // Get past 4 weeks history
        $history = AmalUsbuyyah::where('user_id', auth()->id())
            ->orderBy('tanggal_awal_pekan', 'desc')
            ->take(4)
            ->get();

        return view('member.amal-usbuyyah.index', compact('startOfWeek', 'myAmalThisWeek', 'history'));
    }

    public function store(Request $request)
    {
        $startOfWeekDate = now()->startOfWeek()->startOfDay();

        AmalUsbuyyah::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal_awal_pekan' => $startOfWeekDate],
            [
                'puasa_sunnah' => $request->has('puasa_sunnah'),
                'baca_alkahfi' => $request->has('baca_alkahfi'),
                'olahraga' => $request->has('olahraga'),
                'bersih_kontrakan' => $request->has('bersih_kontrakan'),
            ]
        );

        return back()->with('status', 'Amalan mingguan berhasil disimpan.');
    }
}
