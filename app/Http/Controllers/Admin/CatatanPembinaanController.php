<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CatatanPembinaan;
use App\Models\User;
use Illuminate\Http\Request;

class CatatanPembinaanController extends Controller
{
    public function index() {
        $catatans = CatatanPembinaan::with('user','author')->latest()->paginate(15);
        return view('admin.catatan-pembinaan.index', compact('catatans'));
    }
    public function create() {
        $users = User::role('member')->where('status','approved')->get();
        return view('admin.catatan-pembinaan.create', compact('users'));
    }
    public function store(Request $request) {
        $v = $request->validate(['user_id'=>'required|exists:users,id','tipe'=>'required','konten'=>'required']);
        CatatanPembinaan::create([...$v, 'author_id' => auth()->id()]);
        return redirect()->route('admin.catatan-pembinaan.index')->with('status','Catatan berhasil ditambahkan.');
    }
    public function destroy(CatatanPembinaan $catatanPembinaan) {
        $catatanPembinaan->delete();
        return back()->with('status','Catatan dihapus.');
    }
}
