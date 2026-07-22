<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kontrakan;
use App\Models\KontrakanMember;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@simbina.test'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $admin->assignRole('admin');

        // Koordinator
        $koordinator = User::firstOrCreate(
            ['email' => 'koordinator@simbina.test'],
            [
                'name' => 'Koordinator Kontrakan',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $koordinator->assignRole('koordinator');

        // Member 1
        $member1 = User::firstOrCreate(
            ['email' => 'member@simbina.test'],
            [
                'name' => 'Member Aktif',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $member1->assignRole('member');

        // Member 2
        $member2 = User::firstOrCreate(
            ['email' => 'member2@simbina.test'],
            [
                'name' => 'Member Dua',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]
        );
        $member2->assignRole('member');

        // Dummy Kontrakan
        $kontrakan = Kontrakan::firstOrCreate(
            ['nama_kontrakan' => 'Kontrakan Al-Farabi'],
            [
                'alamat' => 'Jl. Ulujami No. 12, Jakarta Selatan',
                'deskripsi' => 'Kontrakan pembinaan putra zona selatan.',
                'kapasitas' => 10,
                'penanggung_jawab' => $koordinator->id,
                'status' => 'aktif',
            ]
        );

        // Link koordinator & members ke kontrakan
        KontrakanMember::firstOrCreate(
            ['kontrakan_id' => $kontrakan->id, 'user_id' => $koordinator->id],
            ['start_date' => now()->subYear(), 'status' => 'active']
        );
        KontrakanMember::firstOrCreate(
            ['kontrakan_id' => $kontrakan->id, 'user_id' => $member1->id],
            ['start_date' => now()->subMonths(6), 'status' => 'active']
        );
        KontrakanMember::firstOrCreate(
            ['kontrakan_id' => $kontrakan->id, 'user_id' => $member2->id],
            ['start_date' => now()->subMonths(3), 'status' => 'active']
        );
    }
}
