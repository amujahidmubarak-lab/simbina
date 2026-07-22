<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;

class KnowledgeBaseController extends Controller
{
    public function index() {
        $articles = KnowledgeBase::where('is_published', true)->latest()->paginate(15);
        return view('member.knowledge-base.index', compact('articles'));
    }
    public function show(KnowledgeBase $knowledgeBase) {
        abort_if(!$knowledgeBase->is_published, 404);
        return view('member.knowledge-base.show', compact('knowledgeBase'));
    }
}
