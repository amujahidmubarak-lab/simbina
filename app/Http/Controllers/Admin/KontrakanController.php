<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontrakan;
use App\Models\User;
use Illuminate\Http\Request;

class KontrakanController extends Controller
{
    public function index()
    {
        $kontrakans = Kontrakan::with('penanggungJawab')->withCount('members')->paginate(10);
        return view('admin.kontrakans.index', compact('kontrakans'));
    }

    public function create()
    {
        $users = User::where('status', 'approved')->get();
        return view('admin.kontrakans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kontrakan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'required|integer|min:1',
            'penanggung_jawab' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        Kontrakan::create($validated);
        return redirect()->route('admin.kontrakans.index')->with('status', 'Kontrakan berhasil ditambahkan.');
    }

    public function show(Kontrakan $kontrakan)
    {
        $kontrakan->load(['penanggungJawab', 'members.user']);
        $users = User::where('status', 'approved')->whereDoesntHave('kontrakanMembers', function($q) use ($kontrakan) {
            $q->where('kontrakan_id', $kontrakan->id)->where('status', 'active');
        })->get();

        return view('admin.kontrakans.show', compact('kontrakan', 'users'));
    }

    public function edit(Kontrakan $kontrakan)
    {
        $users = User::where('status', 'approved')->get();
        return view('admin.kontrakans.edit', compact('kontrakan', 'users'));
    }

    public function update(Request $request, Kontrakan $kontrakan)
    {
        $validated = $request->validate([
            'nama_kontrakan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'required|integer|min:1',
            'penanggung_jawab' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $kontrakan->update($validated);
        return redirect()->route('admin.kontrakans.index')->with('status', 'Kontrakan berhasil diperbarui.');
    }

    public function destroy(Kontrakan $kontrakan)
    {
        $kontrakan->delete();
        return redirect()->route('admin.kontrakans.index')->with('status', 'Kontrakan berhasil dihapus.');
    }

    public function addMember(Request $request, Kontrakan $kontrakan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
        ]);

        $currentMembers = $kontrakan->members()->where('status', 'active')->count();
        if ($currentMembers >= $kontrakan->kapasitas) {
            return back()->withErrors(['user_id' => 'Kapasitas kontrakan sudah penuh.']);
        }

        $kontrakan->members()->create([
            'user_id' => $request->user_id,
            'start_date' => $request->start_date ?? now(),
            'status' => 'active'
        ]);

        return back()->with('status', 'Penghuni berhasil ditambahkan.');
    }

    public function removeMember(Kontrakan $kontrakan, User $user)
    {
        $member = $kontrakan->members()->where('user_id', $user->id)->where('status', 'active')->first();
        if ($member) {
            $member->update([
                'status' => 'inactive',
                'end_date' => now()
            ]);
        }
        return back()->with('status', 'Penghuni berhasil dikeluarkan dari kontrakan.');
    }
}
