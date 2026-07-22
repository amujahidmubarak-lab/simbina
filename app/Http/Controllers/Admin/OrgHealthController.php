<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kontrakan;
use App\Models\Kegiatan;
use App\Models\AmalYaumiyyah;
use App\Models\Attendance;
use Carbon\Carbon;

class OrgHealthController extends Controller
{
    public function index()
    {
        $totalMembers = User::role('member')->where('status', 'approved')->count();
        $totalKontrakans = Kontrakan::count();

        // Tingkat pengisian amal hari ini
        $todayAmalCount = AmalYaumiyyah::whereDate('tanggal', now())->count();
        $amalRate = $totalMembers > 0 ? round(($todayAmalCount / $totalMembers) * 100) : 0;

        // Tingkat kehadiran bulan ini
        $monthKegiatans = Kegiatan::whereMonth('tanggal_waktu', now()->month)->count();
        $monthHadir = Attendance::where('status', 'hadir')->whereMonth('created_at', now()->month)->count();
        $monthTotal = Attendance::whereMonth('created_at', now()->month)->count();
        $hadirRate = $monthTotal > 0 ? round(($monthHadir / $monthTotal) * 100) : 0;

        // Kontrakan aktif vs kurang aktif (based on amal fill rate)
        $kontrakans = Kontrakan::with(['members' => fn($q) => $q->where('status', 'active')])->get();
        $kontrakanStats = [];
        foreach ($kontrakans as $k) {
            $memberIds = $k->members->pluck('user_id');
            $filled = AmalYaumiyyah::whereIn('user_id', $memberIds)->whereDate('tanggal', now())->count();
            $total = $memberIds->count();
            $kontrakanStats[] = ['kontrakan' => $k, 'filled' => $filled, 'total' => $total, 'rate' => $total > 0 ? round(($filled / $total) * 100) : 0];
        }

        // Tren bulanan (6 bulan terakhir)
        $tren = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->subMonths($i);
            $amalCt = AmalYaumiyyah::whereYear('tanggal', $m->year)->whereMonth('tanggal', $m->month)->distinct('user_id')->count('user_id');
            $tren[] = ['bulan' => $m->format('M Y'), 'aktif' => $amalCt];
        }

        return view('admin.org-health.index', compact('totalMembers', 'totalKontrakans', 'amalRate', 'hadirRate', 'kontrakanStats', 'tren', 'todayAmalCount', 'monthKegiatans'));
    }
}
