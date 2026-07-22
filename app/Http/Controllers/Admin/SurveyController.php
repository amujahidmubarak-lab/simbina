<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index() {
        $surveys = Survey::with('kegiatan', 'creator')->withCount('responses')->latest()->paginate(15);
        return view('admin.surveys.index', compact('surveys'));
    }
    public function create() {
        $kegiatans = Kegiatan::latest()->get();
        return view('admin.surveys.create', compact('kegiatans'));
    }
    public function store(Request $request) {
        $v = $request->validate(['judul'=>'required|string|max:255','deskripsi'=>'nullable','kegiatan_id'=>'nullable|exists:kegiatans,id']);
        Survey::create([...$v, 'created_by' => auth()->id()]);
        return redirect()->route('admin.surveys.index')->with('status','Survey berhasil dibuat.');
    }
    public function show(Survey $survey) {
        $survey->load('responses.user');
        $avgRating = $survey->responses->avg('rating');
        return view('admin.surveys.show', compact('survey', 'avgRating'));
    }
    public function destroy(Survey $survey) { $survey->delete(); return back()->with('status','Survey dihapus.'); }
}
