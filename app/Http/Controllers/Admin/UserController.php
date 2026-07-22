<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                    
        return view('admin.users.index', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('status', 'User ' . $user->name . ' berhasil disetujui.');
    }

    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('status', 'User ' . $user->name . ' berhasil ditolak.');
    }
}
