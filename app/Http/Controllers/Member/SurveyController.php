<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index() {
        $surveys = Survey::where('aktif', true)->with('kegiatan')->latest()->get();
        $answeredIds = SurveyResponse::where('user_id', auth()->id())->pluck('survey_id');
        return view('member.surveys.index', compact('surveys', 'answeredIds'));
    }
    public function show(Survey $survey) {
        $myResponse = SurveyResponse::where('survey_id', $survey->id)->where('user_id', auth()->id())->first();
        return view('member.surveys.show', compact('survey', 'myResponse'));
    }
    public function store(Request $request, Survey $survey) {
        $v = $request->validate(['rating'=>'required|integer|min:1|max:5','feedback'=>'nullable|string']);
        SurveyResponse::updateOrCreate(
            ['survey_id' => $survey->id, 'user_id' => auth()->id()],
            $v
        );
        return redirect()->route('member.surveys.index')->with('status','Terima kasih atas evaluasi Anda.');
    }
}
