<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kontrakan;
use App\Models\Kegiatan;
use App\Models\KnowledgeBase;
use App\Models\Pengumuman;
use App\Models\Materi;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q', '');
        $results = [];

        if (strlen($q) >= 2) {
            $results['users'] = User::where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->take(5)->get();
            $results['kontrakans'] = Kontrakan::where('nama_kontrakan', 'like', "%{$q}%")->take(5)->get();
            $results['kegiatans'] = Kegiatan::where('judul', 'like', "%{$q}%")->take(5)->get();
            $results['pengumumans'] = Pengumuman::where('judul', 'like', "%{$q}%")->take(5)->get();
            $results['materis'] = Materi::where('judul', 'like', "%{$q}%")->take(5)->get();
            $results['knowledge'] = KnowledgeBase::where('judul', 'like', "%{$q}%")->where('is_published', true)->take(5)->get();
        }

        return view('search.index', compact('q', 'results'));
    }
}
