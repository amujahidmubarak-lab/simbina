<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Services\ScoringService;
use App\Models\UserTimeline;

class ProgressController extends Controller
{
    public function index(ScoringService $scoring) {
        $user = auth()->user();
        $score = $scoring->getUserScore($user);
        $timeline = UserTimeline::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
        return view('member.progress.index', compact('score', 'timeline'));
    }
}
