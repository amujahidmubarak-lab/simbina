<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kontrakan;
use App\Models\Kegiatan;
use App\Models\AmalYaumiyyah;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        }

        if ($user->hasRole('koordinator')) {
            return redirect()->route('koordinator.dashboard');
        }

        return $this->memberDashboard($user);
    }

    private function adminDashboard()
    {
        $totalMembers = User::where('status', 'approved')->count();
        $totalPending = User::where('status', 'pending')->count();
        $totalKontrakans = Kontrakan::count();
        $upcomingKegiatans = Kegiatan::where('tanggal_waktu', '>=', now())
            ->orderBy('tanggal_waktu', 'asc')
            ->take(5)
            ->get();
            
        $todayAmalCount = AmalYaumiyyah::whereDate('tanggal', now()->format('Y-m-d'))->count();

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalPending',
            'totalKontrakans',
            'upcomingKegiatans',
            'todayAmalCount'
        ));
    }

    private function memberDashboard($user)
    {
        $upcomingKegiatans = Kegiatan::where('tanggal_waktu', '>=', now())
            ->orderBy('tanggal_waktu', 'asc')
            ->take(3)
            ->get();

        $recentPengumumans = Pengumuman::latest()->take(3)->get();
        
        $myAmalToday = AmalYaumiyyah::where('user_id', $user->id)
            ->whereDate('tanggal', now()->format('Y-m-d'))
            ->first();

        return view('member.dashboard', compact(
            'upcomingKegiatans',
            'recentPengumumans',
            'myAmalToday'
        ));
    }
}
