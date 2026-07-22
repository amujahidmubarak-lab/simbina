<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::latest()->paginate(10);
        return view('member.materis.index', compact('materis'));
    }

    public function show(Materi $materi)
    {
        return view('member.materis.show', compact('materi'));
    }
}
