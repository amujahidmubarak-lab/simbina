<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Kontrakan;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index(Request $request) {
        $query = Inventaris::with('kontrakan')->latest();
        if ($request->filled('kontrakan_id')) $query->where('kontrakan_id', $request->kontrakan_id);
        $items = $query->paginate(15);
        $kontrakans = Kontrakan::all();
        return view('admin.inventaris.index', compact('items','kontrakans'));
    }
    public function create() { $kontrakans = Kontrakan::all(); return view('admin.inventaris.create', compact('kontrakans')); }
    public function store(Request $request) {
        $v = $request->validate(['kontrakan_id'=>'required|exists:kontrakans,id','nama'=>'required|string|max:255','jumlah'=>'required|integer|min:1','kondisi'=>'required','lokasi'=>'nullable|string','keterangan'=>'nullable']);
        Inventaris::create($v);
        return redirect()->route('admin.inventaris.index')->with('status','Barang inventaris berhasil ditambahkan.');
    }
    public function edit(Inventaris $inventari) { $kontrakans = Kontrakan::all(); return view('admin.inventaris.edit', compact('inventari','kontrakans')); }
    public function update(Request $request, Inventaris $inventari) {
        $v = $request->validate(['nama'=>'required|string|max:255','jumlah'=>'required|integer|min:1','kondisi'=>'required','lokasi'=>'nullable|string','keterangan'=>'nullable']);
        $inventari->update($v);
        return redirect()->route('admin.inventaris.index')->with('status','Inventaris diperbarui.');
    }
    public function destroy(Inventaris $inventari) { $inventari->delete(); return back()->with('status','Inventaris dihapus.'); }
}
