<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KnowledgeBaseController extends Controller
{
    public function index() {
        $articles = KnowledgeBase::with('creator')->latest()->paginate(15);
        return view('admin.knowledge-base.index', compact('articles'));
    }
    public function create() { return view('admin.knowledge-base.create'); }
    public function store(Request $request) {
        $v = $request->validate(['judul'=>'required|string|max:255','konten'=>'required','tipe'=>'required']);
        KnowledgeBase::create([...$v, 'slug' => Str::slug($v['judul']).'-'.Str::random(4), 'created_by' => auth()->id()]);
        return redirect()->route('admin.knowledge-base.index')->with('status','Artikel berhasil ditambahkan.');
    }
    public function edit(KnowledgeBase $knowledgeBase) { return view('admin.knowledge-base.edit', compact('knowledgeBase')); }
    public function update(Request $request, KnowledgeBase $knowledgeBase) {
        $v = $request->validate(['judul'=>'required|string|max:255','konten'=>'required','tipe'=>'required']);
        $knowledgeBase->update($v);
        return redirect()->route('admin.knowledge-base.index')->with('status','Artikel diperbarui.');
    }
    public function destroy(KnowledgeBase $knowledgeBase) {
        $knowledgeBase->delete();
        return back()->with('status','Artikel dihapus.');
    }
}
