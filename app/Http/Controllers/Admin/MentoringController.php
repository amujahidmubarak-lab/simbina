<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Mentoring;
use App\Models\MentoringNote;
use App\Models\User;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function index() {
        $mentorings = Mentoring::with('mentor','mentee')->latest()->paginate(15);
        return view('admin.mentoring.index', compact('mentorings'));
    }
    public function create() {
        $users = User::role('member')->where('status','approved')->get();
        return view('admin.mentoring.create', compact('users'));
    }
    public function store(Request $request) {
        $v = $request->validate(['mentor_id'=>'required|exists:users,id','mentee_id'=>'required|exists:users,id|different:mentor_id','start_date'=>'required|date']);
        Mentoring::create($v);
        return redirect()->route('admin.mentoring.index')->with('status','Mentoring berhasil ditugaskan.');
    }
    public function show(Mentoring $mentoring) {
        $mentoring->load('notes.author','mentor','mentee');
        return view('admin.mentoring.show', compact('mentoring'));
    }
    public function storeNote(Request $request, Mentoring $mentoring) {
        $v = $request->validate(['catatan'=>'required','tanggal'=>'required|date']);
        MentoringNote::create([...$v, 'mentoring_id' => $mentoring->id, 'author_id' => auth()->id()]);
        return back()->with('status','Catatan mentoring ditambahkan.');
    }
    public function destroy(Mentoring $mentoring) {
        $mentoring->delete();
        return redirect()->route('admin.mentoring.index')->with('status','Mentoring dihapus.');
    }
}
