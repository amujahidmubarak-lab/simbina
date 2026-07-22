<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function index() {
        $penugasans = Penugasan::where('user_id', auth()->id())->with('kegiatan','assigner')->latest()->get();
        return view('member.penugasan.index', compact('penugasans'));
    }
    public function update(Request $request, Penugasan $penugasan) {
        abort_if($penugasan->user_id !== auth()->id(), 403);
        $penugasan->update(['status' => $request->input('status')]);
        return back()->with('status','Status tugas diperbarui.');
    }
}
