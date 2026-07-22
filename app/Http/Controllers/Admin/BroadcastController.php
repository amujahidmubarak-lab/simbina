<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\Kontrakan;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function index() {
        $broadcasts = Broadcast::with('sender')->latest()->paginate(15);
        return view('admin.broadcasts.index', compact('broadcasts'));
    }
    public function create() {
        $kontrakans = Kontrakan::all();
        return view('admin.broadcasts.create', compact('kontrakans'));
    }
    public function store(Request $request) {
        $v = $request->validate(['judul'=>'required|string|max:255','konten'=>'required','target_type'=>'required','target_id'=>'nullable|integer','is_penting'=>'nullable']);
        Broadcast::create([...$v, 'sender_id' => auth()->id(), 'is_penting' => $request->has('is_penting')]);
        return redirect()->route('admin.broadcasts.index')->with('status','Broadcast berhasil dikirim.');
    }
    public function destroy(Broadcast $broadcast) {
        $broadcast->delete();
        return back()->with('status','Broadcast dihapus.');
    }
}
