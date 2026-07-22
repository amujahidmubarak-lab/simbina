<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserTimeline;

class TimelineController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $timelines = UserTimeline::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('member.timeline.index', compact('timelines'));
    }
}
