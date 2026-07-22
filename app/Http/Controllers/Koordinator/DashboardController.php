<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Services\ScoringService;
use App\Services\EarlyWarningService;
use App\Models\KasKontrakan;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(ScoringService $scoring, EarlyWarningService $warning)
    {
        $user = auth()->user();
        $kontrakan = $user->currentKontrakan();

        if (!$kontrakan) {
            return view('koordinator.dashboard', [
                'kontrakan' => null,
                'memberCount' => 0,
                'avgScore' => 0,
                'kasBalance' => 0,
                'inventarisCount' => 0,
                'upcomingKegiatans' => collect(),
                'warnings' => collect(),
            ]);
        }

        $members = $kontrakan->members()->where('status', 'active')->with('user')->get();
        $kontrakanScore = $scoring->getKontrakanScore($kontrakan);
        $warnings = $warning->detectForKontrakan($kontrakan);

        $kasBalance = KasKontrakan::where('kontrakan_id', $kontrakan->id)
            ->selectRaw("SUM(CASE WHEN tipe='masuk' THEN jumlah ELSE -jumlah END) as saldo")
            ->value('saldo') ?? 0;

        $inventarisCount = Inventaris::where('kontrakan_id', $kontrakan->id)->count();

        $upcomingKegiatans = Kegiatan::where('tanggal_waktu', '>=', now())
            ->where(function($q) use ($kontrakan) {
                $q->whereNull('kontrakan_id')->orWhere('kontrakan_id', $kontrakan->id);
            })
            ->orderBy('tanggal_waktu')
            ->take(5)
            ->get();

        return view('koordinator.dashboard', compact(
            'kontrakan', 'members', 'kontrakanScore', 'warnings',
            'kasBalance', 'inventarisCount', 'upcomingKegiatans'
        ));
    }
}
