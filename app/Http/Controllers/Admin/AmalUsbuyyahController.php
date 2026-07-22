<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmalUsbuyyah;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AmalUsbuyyahController extends Controller
{
    public function index(Request $request)
    {
        $dateStr = $request->input('date', now()->startOfWeek()->format('Y-m-d'));
        $startOfWeek = Carbon::parse($dateStr)->startOfWeek();

        $users = User::role('member')->where('status', 'approved')->get();
        $amalan = AmalUsbuyyah::where('tanggal_awal_pekan', $startOfWeek->format('Y-m-d'))->get()->keyBy('user_id');

        return view('admin.amal-usbuyyah.index', compact('users', 'amalan', 'startOfWeek'));
    }
}
