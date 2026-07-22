<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmalYaumiyyah;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AmalYaumiyyahController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        
        $users = User::where('status', 'approved')
            ->with(['amalYaumiyyahs' => function($q) use ($date) {
                $q->whereDate('tanggal', $date);
            }])
            ->orderBy('name')
            ->paginate(15);
        
        return view('admin.amal.index', compact('users', 'date'));
    }
}
