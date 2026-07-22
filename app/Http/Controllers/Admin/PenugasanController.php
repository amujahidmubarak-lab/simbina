<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function index() {
        $penugasans = Penugasan::with('user','kegiatan','assigner')->latest()->paginate(15);
        return view('admin.penugasan.index', compact('penugasans'));
    }
    public function create() {
        $users = User::role('member')->where('status','approved')->get();
        $kegiatans = Kegiatan::latest()->get();
        return view('admin.penugasan.create', compact('users','kegiatans'));
    }
    public function store(Request $request) {
        $v = $request->validate(['user_id'=>'required|exists:users,id','judul'=>'required|string|max:255','deskripsi'=>'nullable','kegiatan_id'=>'nullable|exists:kegiatans,id','deadline'=>'nullable|date']);
        Penugasan::create([...$v, 'assigned_by' => auth()->id()]);
        return redirect()->route('admin.penugasan.index')->with('status','Tugas berhasil dibuat.');
    }
    public function destroy(Penugasan $penugasan) { $penugasan->delete(); return back()->with('status','Tugas dihapus.'); }
}
