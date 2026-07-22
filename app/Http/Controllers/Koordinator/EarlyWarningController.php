<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Services\EarlyWarningService;

class EarlyWarningController extends Controller
{
    public function index(EarlyWarningService $service)
    {
        $kontrakan = auth()->user()->currentKontrakan();
        $warnings = $kontrakan
            ? $service->detectForKontrakan($kontrakan)
            : collect();

        return view('koordinator.early-warnings.index', compact('warnings', 'kontrakan'));
    }
}
