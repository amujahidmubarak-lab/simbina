<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\AmalYaumiyyah;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AmalYaumiyyahController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        
        try {
            $startOfMonth = Carbon::parse($month)->startOfMonth();
            $endOfMonth = Carbon::parse($month)->endOfMonth();
        } catch (\Exception $e) {
            $month = now()->format('Y-m');
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
        }

        $amals = AmalYaumiyyah::where('user_id', auth()->id())
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->orderBy('tanggal', 'desc')
            ->get()
            ->keyBy(function($item) {
                return $item->tanggal->format('Y-m-d');
            });

        return view('member.amal.index', compact('amals', 'month', 'startOfMonth', 'endOfMonth'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'tilawah_halaman' => 'required|integer|min:0',
            'shalat_berjamaah' => 'required|integer|min:0|max:5',
            'qiyamul_lail' => 'nullable',
            'puasa_sunnah' => 'nullable',
            'infaq' => 'nullable',
            'catatan' => 'nullable|string',
        ]);

        $validated['qiyamul_lail'] = $request->has('qiyamul_lail');
        $validated['puasa_sunnah'] = $request->has('puasa_sunnah');
        $validated['infaq'] = $request->has('infaq');

        $tanggal = Carbon::parse($validated['tanggal'])->startOfDay();

        AmalYaumiyyah::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal' => $tanggal],
            $validated
        );

        return back()->with('status', 'Mutaba\'ah yaumiyyah berhasil disimpan.');
    }
}
