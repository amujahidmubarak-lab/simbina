<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::latest('tanggal_waktu')->paginate(10);
        return view('admin.attendances.index', compact('kegiatans'));
    }

    public function show(Kegiatan $kegiatan)
    {
        $members = User::role('member')->where('status', 'approved')->get();
        $attendances = Attendance::where('kegiatan_id', $kegiatan->id)->get()->keyBy('user_id');
        return view('admin.attendances.show', compact('kegiatan', 'members', 'attendances'));
    }

    public function store(Request $request, Kegiatan $kegiatan)
    {
        foreach ($request->input('attendance', []) as $userId => $status) {
            Attendance::updateOrCreate(
                ['kegiatan_id' => $kegiatan->id, 'user_id' => $userId],
                ['status' => $status, 'keterangan' => $request->input("keterangan.{$userId}")]
            );
        }
        return back()->with('status', 'Kehadiran berhasil disimpan.');
    }

    public function rekap(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $users = User::role('member')->where('status', 'approved')->get();
        $kegiatanIds = Kegiatan::whereYear('tanggal_waktu', substr($month, 0, 4))
            ->whereMonth('tanggal_waktu', substr($month, 5, 2))->pluck('id');

        $rekap = [];
        foreach ($users as $user) {
            $att = Attendance::where('user_id', $user->id)->whereIn('kegiatan_id', $kegiatanIds)->get();
            $rekap[] = [
                'user' => $user,
                'hadir' => $att->where('status', 'hadir')->count(),
                'izin' => $att->where('status', 'izin')->count(),
                'alfa' => $att->where('status', 'alfa')->count(),
                'total' => $kegiatanIds->count(),
            ];
        }
        return view('admin.attendances.rekap', compact('rekap', 'month'));
    }
}
