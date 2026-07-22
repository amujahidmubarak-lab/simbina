<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $kegiatans = Kegiatan::where(function($q) use ($kontrakan) {
                $q->whereNull('kontrakan_id');
                if ($kontrakan) $q->orWhere('kontrakan_id', $kontrakan->id);
            })
            ->latest('tanggal_waktu')
            ->paginate(10);

        return view('koordinator.attendances.index', compact('kegiatans', 'kontrakan'));
    }

    public function show(Kegiatan $kegiatan)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $memberIds = $kontrakan ? $kontrakan->members()->where('status', 'active')->pluck('user_id') : collect();
        $members = User::whereIn('id', $memberIds)->get();
        $attendances = Attendance::where('kegiatan_id', $kegiatan->id)->get()->keyBy('user_id');

        return view('koordinator.attendances.show', compact('kegiatan', 'members', 'attendances', 'kontrakan'));
    }

    public function store(Request $request, Kegiatan $kegiatan)
    {
        foreach ($request->input('attendance', []) as $userId => $status) {
            Attendance::updateOrCreate(
                ['kegiatan_id' => $kegiatan->id, 'user_id' => $userId],
                ['status' => $status, 'keterangan' => $request->input("keterangan.{$userId}")]
            );
        }
        return back()->with('status', 'Kehadiran berhasil disimpan.');
    }
}
