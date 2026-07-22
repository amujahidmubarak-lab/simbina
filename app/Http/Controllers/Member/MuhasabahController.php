<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\Muhasabah;
use Illuminate\Http\Request;

class MuhasabahController extends Controller
{
    public function index() {
        $startOfWeek = now()->startOfWeek();
        $current = Muhasabah::where('user_id', auth()->id())->where('tanggal_awal_pekan', $startOfWeek->format('Y-m-d'))->first();
        $history = Muhasabah::where('user_id', auth()->id())->orderBy('tanggal_awal_pekan', 'desc')->take(8)->get();
        return view('member.muhasabah.index', compact('startOfWeek', 'current', 'history'));
    }
    public function store(Request $request) {
        $v = $request->validate(['capaian'=>'nullable|string','kendala'=>'nullable|string','target'=>'nullable|string']);
        Muhasabah::updateOrCreate(
            ['user_id' => auth()->id(), 'tanggal_awal_pekan' => now()->startOfWeek()->startOfDay()],
            $v
        );
        return back()->with('status','Muhasabah berhasil disimpan.');
    }
}
