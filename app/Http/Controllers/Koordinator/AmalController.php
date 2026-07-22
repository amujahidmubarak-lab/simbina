<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\AmalYaumiyyah;
use App\Models\AmalUsbuyyah;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AmalController extends Controller
{
    public function harian(Request $request)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $memberIds = $kontrakan ? $kontrakan->members()->where('status', 'active')->pluck('user_id') : collect();

        $date = $request->get('date', now()->format('Y-m-d'));
        $users = User::whereIn('id', $memberIds)
            ->with(['amalYaumiyyahs' => fn($q) => $q->whereDate('tanggal', $date)])
            ->orderBy('name')
            ->get();

        return view('koordinator.amal.harian', compact('users', 'date', 'kontrakan'));
    }

    public function mingguan(Request $request)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $memberIds = $kontrakan ? $kontrakan->members()->where('status', 'active')->pluck('user_id') : collect();

        $dateStr = $request->input('date', now()->startOfWeek()->format('Y-m-d'));
        $startOfWeek = Carbon::parse($dateStr)->startOfWeek();

        $users = User::whereIn('id', $memberIds)->orderBy('name')->get();
        $amalan = AmalUsbuyyah::whereIn('user_id', $memberIds)
            ->where('tanggal_awal_pekan', $startOfWeek->format('Y-m-d'))
            ->get()->keyBy('user_id');

        return view('koordinator.amal.mingguan', compact('users', 'amalan', 'startOfWeek', 'kontrakan'));
    }
}
