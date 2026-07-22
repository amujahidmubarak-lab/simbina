<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Services\ScoringService;

class MemberController extends Controller
{
    public function index(ScoringService $scoring)
    {
        $kontrakan = auth()->user()->currentKontrakan();

        if (!$kontrakan) {
            return redirect()->route('koordinator.dashboard')
                ->with('error', 'Anda belum terhubung ke kontrakan manapun.');
        }

        $members = $kontrakan->members()
            ->where('status', 'active')
            ->with('user')
            ->get()
            ->map(function ($m) use ($scoring) {
                $m->score = $scoring->getUserScore($m->user);
                return $m;
            });

        return view('koordinator.members.index', compact('kontrakan', 'members'));
    }
}
