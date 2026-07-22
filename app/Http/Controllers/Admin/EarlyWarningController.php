<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\EarlyWarningService;

class EarlyWarningController extends Controller
{
    public function index(EarlyWarningService $service)
    {
        $warnings = $service->detect();
        return view('admin.early-warnings.index', compact('warnings'));
    }
}
