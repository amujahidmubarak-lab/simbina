<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(10);
        return view('member.pengumumans.index', compact('pengumumans'));
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('member.pengumumans.show', compact('pengumuman'));
    }
}
