<?php

namespace App\Services;

use App\Models\User;
use App\Models\AmalYaumiyyah;
use App\Models\AmalUsbuyyah;
use App\Models\Attendance;
use Carbon\Carbon;

class ScoringService
{
    /**
     * Hitung skor progress pembinaan user (0-100)
     */
    public function getUserScore(User $user, ?Carbon $from = null, ?Carbon $to = null): array
    {
        $from = $from ?? now()->startOfMonth();
        $to = $to ?? now()->endOfMonth();
        $totalDays = $from->diffInDays($to) + 1;

        // 1. Amal Harian Score (40%)
        $amalCount = AmalYaumiyyah::where('user_id', $user->id)
            ->whereBetween('tanggal', [$from, $to])
            ->count();
        $amalScore = min(100, ($amalCount / max($totalDays, 1)) * 100);

        // 2. Amal Mingguan Score (20%)
        $totalWeeks = max(1, ceil($totalDays / 7));
        $usbuyyahCount = AmalUsbuyyah::where('user_id', $user->id)
            ->whereBetween('tanggal_awal_pekan', [$from, $to])
            ->count();
        $usbuyyahScore = min(100, ($usbuyyahCount / $totalWeeks) * 100);

        // 3. Kehadiran Score (30%)
        $totalKegiatanAttended = Attendance::where('user_id', $user->id)
            ->whereBetween('created_at', [$from, $to])
            ->count();
        $hadirCount = Attendance::where('user_id', $user->id)
            ->whereBetween('created_at', [$from, $to])
            ->where('status', 'hadir')
            ->count();
        $hadirScore = $totalKegiatanAttended > 0 ? ($hadirCount / $totalKegiatanAttended) * 100 : 0;

        // 4. Partisipasi Kegiatan (10%)
        $partisipasiScore = min(100, $totalKegiatanAttended * 20); // max 5 kegiatan = 100

        // Weighted total
        $totalScore = ($amalScore * 0.4) + ($usbuyyahScore * 0.2) + ($hadirScore * 0.3) + ($partisipasiScore * 0.1);

        return [
            'total' => round($totalScore),
            'amal_harian' => round($amalScore),
            'amal_mingguan' => round($usbuyyahScore),
            'kehadiran' => round($hadirScore),
            'partisipasi' => round($partisipasiScore),
            'amal_count' => $amalCount,
            'total_days' => $totalDays,
        ];
    }

    /**
     * Hitung skor rata-rata untuk kontrakan
     */
    public function getKontrakanScore($kontrakan, ?Carbon $from = null, ?Carbon $to = null): array
    {
        $members = $kontrakan->members()->where('status', 'active')->with('user')->get();
        if ($members->isEmpty()) return ['total' => 0, 'member_count' => 0];

        $totalScore = 0;
        $scores = [];
        foreach ($members as $m) {
            $s = $this->getUserScore($m->user, $from, $to);
            $totalScore += $s['total'];
            $scores[] = ['user' => $m->user, 'score' => $s];
        }

        return [
            'total' => round($totalScore / $members->count()),
            'member_count' => $members->count(),
            'details' => $scores,
        ];
    }
}
