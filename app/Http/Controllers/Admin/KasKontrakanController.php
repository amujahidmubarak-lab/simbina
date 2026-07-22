<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\KasKontrakan;
use App\Models\Kontrakan;
use Illuminate\Http\Request;

class KasKontrakanController extends Controller
{
    public function index(Request $request) {
        $query = KasKontrakan::with('kontrakan','user')->latest();
        if ($request->filled('kontrakan_id')) $query->where('kontrakan_id', $request->kontrakan_id);
        $transactions = $query->paginate(15);
        $kontrakans = Kontrakan::all();
        // Hitung saldo per kontrakan
        $saldos = [];
        foreach ($kontrakans as $k) {
            $masuk = KasKontrakan::where('kontrakan_id',$k->id)->where('tipe','masuk')->sum('jumlah');
            $keluar = KasKontrakan::where('kontrakan_id',$k->id)->where('tipe','keluar')->sum('jumlah');
            $saldos[$k->id] = ['masuk'=>$masuk,'keluar'=>$keluar,'saldo'=>$masuk-$keluar];
        }
        return view('admin.kas.index', compact('transactions','kontrakans','saldos'));
    }
    public function create() { $kontrakans = Kontrakan::all(); return view('admin.kas.create', compact('kontrakans')); }
    public function store(Request $request) {
        $v = $request->validate(['kontrakan_id'=>'required|exists:kontrakans,id','tipe'=>'required|in:masuk,keluar','jumlah'=>'required|integer|min:1','keterangan'=>'required|string','tanggal'=>'required|date']);
        KasKontrakan::create([...$v, 'user_id' => auth()->id()]);
        return redirect()->route('admin.kas.index')->with('status','Transaksi berhasil dicatat.');
    }
    public function destroy(KasKontrakan $ka) { $ka->delete(); return back()->with('status','Transaksi dihapus.'); }
}
