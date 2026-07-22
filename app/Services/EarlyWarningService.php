<?php

namespace App\Services;

use App\Models\User;
use App\Models\AmalYaumiyyah;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class EarlyWarningService
{
    const DAYS_NO_AMAL = 3;
    const TIMES_ABSENT = 3;
    const DAYS_NO_LOGIN = 7;

    /**
     * Deteksi semua user yang perlu perhatian
     * @return Collection of ['user' => User, 'warnings' => [...], 'priority' => 'tinggi'|'sedang'|'rendah']
     */
    public function detect(): Collection
    {
        $users = User::role('member')->where('status', 'approved')->get();
        $results = collect();

        foreach ($users as $user) {
            $warnings = [];

            // 1. Tidak mengisi amal harian selama X hari
            $lastAmal = AmalYaumiyyah::where('user_id', $user->id)->latest('tanggal')->first();
            $daysSinceAmal = $lastAmal ? Carbon::parse($lastAmal->tanggal)->diffInDays(now()) : 999;
            if ($daysSinceAmal >= self::DAYS_NO_AMAL) {
                $warnings[] = [
                    'type' => 'no_amal',
                    'message' => "Tidak mengisi amal harian selama {$daysSinceAmal} hari",
                    'severity' => $daysSinceAmal >= 7 ? 'tinggi' : 'sedang',
                ];
            }

            // 2. Tidak hadir kegiatan sebanyak X kali (bulan ini)
            $alfaCount = Attendance::where('user_id', $user->id)
                ->where('status', 'alfa')
                ->whereMonth('created_at', now()->month)
                ->count();
            if ($alfaCount >= self::TIMES_ABSENT) {
                $warnings[] = [
                    'type' => 'frequent_absent',
                    'message' => "Alfa {$alfaCount}x pada bulan ini",
                    'severity' => $alfaCount >= 5 ? 'tinggi' : 'sedang',
                ];
            }

            // 3. Tidak login selama X hari
            $daysSinceLogin = $user->last_login_at ? Carbon::parse($user->last_login_at)->diffInDays(now()) : 999;
            if ($daysSinceLogin >= self::DAYS_NO_LOGIN) {
                $warnings[] = [
                    'type' => 'no_login',
                    'message' => "Tidak login selama {$daysSinceLogin} hari",
                    'severity' => $daysSinceLogin >= 14 ? 'tinggi' : 'rendah',
                ];
            }

            if (!empty($warnings)) {
                // Determine overall priority
                $hasTinggi = collect($warnings)->contains(fn($w) => $w['severity'] === 'tinggi');
                $hasSedang = collect($warnings)->contains(fn($w) => $w['severity'] === 'sedang');
                $priority = $hasTinggi ? 'tinggi' : ($hasSedang ? 'sedang' : 'rendah');

                $results->push([
                    'user' => $user,
                    'warnings' => $warnings,
                    'priority' => $priority,
                ]);
            }
        }

        // Sort by priority (tinggi first)
        return $results->sortBy(function ($item) {
            return match ($item['priority']) {
                'tinggi' => 0, 'sedang' => 1, 'rendah' => 2,
            };
        })->values();
    }

    /**
     * Deteksi untuk kontrakan tertentu saja
     */
    public function detectForKontrakan($kontrakan): Collection
    {
        $memberIds = $kontrakan->members()->where('status', 'active')->pluck('user_id');
        return $this->detect()->filter(fn($item) => $memberIds->contains($item['user']->id))->values();
    }
}
