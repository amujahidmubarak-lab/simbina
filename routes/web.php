<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
    // Approval notice route
    Route::get('/approval', function () {
        return view('auth.approval-notice');
    })->name('approval.notice');

    // Protected by check.status (must be approved)
    Route::middleware('check.status')->group(function () {
        
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Global Search
        Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');
        
        // =============================================
        // ADMIN ROUTES
        // =============================================
        Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
            // User Management
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::patch('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
            Route::patch('/users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');
            
            // Kontrakan
            Route::resource('kontrakans', \App\Http\Controllers\Admin\KontrakanController::class);
            Route::post('kontrakans/{kontrakan}/members', [\App\Http\Controllers\Admin\KontrakanController::class, 'addMember'])->name('kontrakans.members.add');
            Route::delete('kontrakans/{kontrakan}/members/{user}', [\App\Http\Controllers\Admin\KontrakanController::class, 'removeMember'])->name('kontrakans.members.remove');
            
            // Kegiatan
            Route::resource('kegiatans', \App\Http\Controllers\Admin\KegiatanController::class);
            
            // Amal Rekap
            Route::get('amal-yaumiyyah', [\App\Http\Controllers\Admin\AmalYaumiyyahController::class, 'index'])->name('amal.index');
            Route::get('amal-usbuyyah', [\App\Http\Controllers\Admin\AmalUsbuyyahController::class, 'index'])->name('amal-usbuyyah.index');
            
            // Attendance
            Route::get('attendances', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendances.index');
            Route::get('attendances/rekap', [\App\Http\Controllers\Admin\AttendanceController::class, 'rekap'])->name('attendances.rekap');
            Route::get('attendances/{kegiatan}', [\App\Http\Controllers\Admin\AttendanceController::class, 'show'])->name('attendances.show');
            Route::post('attendances/{kegiatan}', [\App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendances.store');

            // Pengumuman & Materi
            Route::resource('pengumumans', \App\Http\Controllers\Admin\PengumumanController::class);
            Route::resource('materis', \App\Http\Controllers\Admin\MateriController::class);

            // Early Warning
            Route::get('early-warnings', [\App\Http\Controllers\Admin\EarlyWarningController::class, 'index'])->name('early-warnings.index');

            // Catatan Pembinaan
            Route::get('catatan-pembinaan', [\App\Http\Controllers\Admin\CatatanPembinaanController::class, 'index'])->name('catatan-pembinaan.index');
            Route::get('catatan-pembinaan/create', [\App\Http\Controllers\Admin\CatatanPembinaanController::class, 'create'])->name('catatan-pembinaan.create');
            Route::post('catatan-pembinaan', [\App\Http\Controllers\Admin\CatatanPembinaanController::class, 'store'])->name('catatan-pembinaan.store');
            Route::delete('catatan-pembinaan/{catatanPembinaan}', [\App\Http\Controllers\Admin\CatatanPembinaanController::class, 'destroy'])->name('catatan-pembinaan.destroy');

            // Mentoring
            Route::get('mentoring', [\App\Http\Controllers\Admin\MentoringController::class, 'index'])->name('mentoring.index');
            Route::get('mentoring/create', [\App\Http\Controllers\Admin\MentoringController::class, 'create'])->name('mentoring.create');
            Route::post('mentoring', [\App\Http\Controllers\Admin\MentoringController::class, 'store'])->name('mentoring.store');
            Route::get('mentoring/{mentoring}', [\App\Http\Controllers\Admin\MentoringController::class, 'show'])->name('mentoring.show');
            Route::post('mentoring/{mentoring}/notes', [\App\Http\Controllers\Admin\MentoringController::class, 'storeNote'])->name('mentoring.notes.store');
            Route::delete('mentoring/{mentoring}', [\App\Http\Controllers\Admin\MentoringController::class, 'destroy'])->name('mentoring.destroy');

            // Penugasan
            Route::get('penugasan', [\App\Http\Controllers\Admin\PenugasanController::class, 'index'])->name('penugasan.index');
            Route::get('penugasan/create', [\App\Http\Controllers\Admin\PenugasanController::class, 'create'])->name('penugasan.create');
            Route::post('penugasan', [\App\Http\Controllers\Admin\PenugasanController::class, 'store'])->name('penugasan.store');
            Route::delete('penugasan/{penugasan}', [\App\Http\Controllers\Admin\PenugasanController::class, 'destroy'])->name('penugasan.destroy');

            // Knowledge Base
            Route::get('knowledge-base', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'index'])->name('knowledge-base.index');
            Route::get('knowledge-base/create', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'create'])->name('knowledge-base.create');
            Route::post('knowledge-base', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'store'])->name('knowledge-base.store');
            Route::get('knowledge-base/{knowledgeBase}/edit', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'edit'])->name('knowledge-base.edit');
            Route::put('knowledge-base/{knowledgeBase}', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'update'])->name('knowledge-base.update');
            Route::delete('knowledge-base/{knowledgeBase}', [\App\Http\Controllers\Admin\KnowledgeBaseController::class, 'destroy'])->name('knowledge-base.destroy');

            // Survey
            Route::get('surveys', [\App\Http\Controllers\Admin\SurveyController::class, 'index'])->name('surveys.index');
            Route::get('surveys/create', [\App\Http\Controllers\Admin\SurveyController::class, 'create'])->name('surveys.create');
            Route::post('surveys', [\App\Http\Controllers\Admin\SurveyController::class, 'store'])->name('surveys.store');
            Route::get('surveys/{survey}', [\App\Http\Controllers\Admin\SurveyController::class, 'show'])->name('surveys.show');
            Route::delete('surveys/{survey}', [\App\Http\Controllers\Admin\SurveyController::class, 'destroy'])->name('surveys.destroy');

            // Broadcast
            Route::get('broadcasts', [\App\Http\Controllers\Admin\BroadcastController::class, 'index'])->name('broadcasts.index');
            Route::get('broadcasts/create', [\App\Http\Controllers\Admin\BroadcastController::class, 'create'])->name('broadcasts.create');
            Route::post('broadcasts', [\App\Http\Controllers\Admin\BroadcastController::class, 'store'])->name('broadcasts.store');
            Route::delete('broadcasts/{broadcast}', [\App\Http\Controllers\Admin\BroadcastController::class, 'destroy'])->name('broadcasts.destroy');

            // Inventaris
            Route::resource('inventaris', \App\Http\Controllers\Admin\InventarisController::class)->parameters(['inventaris' => 'inventari']);

            // Kas Kontrakan
            Route::get('kas', [\App\Http\Controllers\Admin\KasKontrakanController::class, 'index'])->name('kas.index');
            Route::get('kas/create', [\App\Http\Controllers\Admin\KasKontrakanController::class, 'create'])->name('kas.create');
            Route::post('kas', [\App\Http\Controllers\Admin\KasKontrakanController::class, 'store'])->name('kas.store');

            // Audit Logs
            Route::get('audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit-logs.index');

            // Organization Health Dashboard
            Route::get('org-health', [\App\Http\Controllers\Admin\OrgHealthController::class, 'index'])->name('org-health.index');
        });
        
        // =============================================
        // KOORDINATOR ROUTES
        // =============================================
        Route::middleware('role:koordinator|admin')->prefix('koordinator')->name('koordinator.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Koordinator\DashboardController::class, 'index'])->name('dashboard');
            Route::get('/members', [\App\Http\Controllers\Koordinator\MemberController::class, 'index'])->name('members.index');

            // Absensi
            Route::get('/attendances', [\App\Http\Controllers\Koordinator\AttendanceController::class, 'index'])->name('attendances.index');
            Route::get('/attendances/{kegiatan}', [\App\Http\Controllers\Koordinator\AttendanceController::class, 'show'])->name('attendances.show');
            Route::post('/attendances/{kegiatan}', [\App\Http\Controllers\Koordinator\AttendanceController::class, 'store'])->name('attendances.store');

            // Monitoring Amal
            Route::get('/amal-harian', [\App\Http\Controllers\Koordinator\AmalController::class, 'harian'])->name('amal.harian');
            Route::get('/amal-mingguan', [\App\Http\Controllers\Koordinator\AmalController::class, 'mingguan'])->name('amal.mingguan');

            // Catatan Pembinaan
            Route::get('/catatan', [\App\Http\Controllers\Koordinator\CatatanController::class, 'index'])->name('catatan.index');
            Route::get('/catatan/create', [\App\Http\Controllers\Koordinator\CatatanController::class, 'create'])->name('catatan.create');
            Route::post('/catatan', [\App\Http\Controllers\Koordinator\CatatanController::class, 'store'])->name('catatan.store');
            Route::delete('/catatan/{catatanPembinaan}', [\App\Http\Controllers\Koordinator\CatatanController::class, 'destroy'])->name('catatan.destroy');

            // Early Warning
            Route::get('/early-warnings', [\App\Http\Controllers\Koordinator\EarlyWarningController::class, 'index'])->name('early-warnings.index');

            // Inventaris
            Route::get('/inventaris', [\App\Http\Controllers\Koordinator\InventarisController::class, 'index'])->name('inventaris.index');
            Route::get('/inventaris/create', [\App\Http\Controllers\Koordinator\InventarisController::class, 'create'])->name('inventaris.create');
            Route::post('/inventaris', [\App\Http\Controllers\Koordinator\InventarisController::class, 'store'])->name('inventaris.store');
            Route::get('/inventaris/{inventari}/edit', [\App\Http\Controllers\Koordinator\InventarisController::class, 'edit'])->name('inventaris.edit');
            Route::put('/inventaris/{inventari}', [\App\Http\Controllers\Koordinator\InventarisController::class, 'update'])->name('inventaris.update');
            Route::delete('/inventaris/{inventari}', [\App\Http\Controllers\Koordinator\InventarisController::class, 'destroy'])->name('inventaris.destroy');

            // Kas
            Route::get('/kas', [\App\Http\Controllers\Koordinator\KasController::class, 'index'])->name('kas.index');
            Route::get('/kas/create', [\App\Http\Controllers\Koordinator\KasController::class, 'create'])->name('kas.create');
            Route::post('/kas', [\App\Http\Controllers\Koordinator\KasController::class, 'store'])->name('kas.store');
        });

        // =============================================
        // MEMBER ROUTES
        // =============================================
        Route::middleware('role:member|admin|koordinator')->prefix('member')->name('member.')->group(function () {
            // Amal
            Route::get('/amal', [\App\Http\Controllers\Member\AmalYaumiyyahController::class, 'index'])->name('amal.index');
            Route::post('/amal', [\App\Http\Controllers\Member\AmalYaumiyyahController::class, 'store'])->name('amal.store');
            Route::get('/amal-usbuyyah', [\App\Http\Controllers\Member\AmalUsbuyyahController::class, 'index'])->name('amal-usbuyyah.index');
            Route::post('/amal-usbuyyah', [\App\Http\Controllers\Member\AmalUsbuyyahController::class, 'store'])->name('amal-usbuyyah.store');
            
            // Muhasabah
            Route::get('/muhasabah', [\App\Http\Controllers\Member\MuhasabahController::class, 'index'])->name('muhasabah.index');
            Route::post('/muhasabah', [\App\Http\Controllers\Member\MuhasabahController::class, 'store'])->name('muhasabah.store');

            // Progress
            Route::get('/progress', [\App\Http\Controllers\Member\ProgressController::class, 'index'])->name('progress.index');

            // Timeline
            Route::get('/timeline', [\App\Http\Controllers\Member\TimelineController::class, 'index'])->name('timeline.index');

            // Penugasan
            Route::get('/penugasan', [\App\Http\Controllers\Member\PenugasanController::class, 'index'])->name('penugasan.index');
            Route::patch('/penugasan/{penugasan}', [\App\Http\Controllers\Member\PenugasanController::class, 'update'])->name('penugasan.update');

            // Pengumuman & Materi
            Route::get('/pengumumans', [\App\Http\Controllers\Member\PengumumanController::class, 'index'])->name('pengumumans.index');
            Route::get('/pengumumans/{pengumuman}', [\App\Http\Controllers\Member\PengumumanController::class, 'show'])->name('pengumumans.show');
            Route::get('/materis', [\App\Http\Controllers\Member\MateriController::class, 'index'])->name('materis.index');
            Route::get('/materis/{materi}', [\App\Http\Controllers\Member\MateriController::class, 'show'])->name('materis.show');

            // Knowledge Base
            Route::get('/knowledge-base', [\App\Http\Controllers\Member\KnowledgeBaseController::class, 'index'])->name('knowledge-base.index');
            Route::get('/knowledge-base/{knowledgeBase}', [\App\Http\Controllers\Member\KnowledgeBaseController::class, 'show'])->name('knowledge-base.show');

            // Survey
            Route::get('/surveys', [\App\Http\Controllers\Member\SurveyController::class, 'index'])->name('surveys.index');
            Route::get('/surveys/{survey}', [\App\Http\Controllers\Member\SurveyController::class, 'show'])->name('surveys.show');
            Route::post('/surveys/{survey}', [\App\Http\Controllers\Member\SurveyController::class, 'store'])->name('surveys.store');

            // Kas & Inventaris (read-only)
            Route::get('/kas', [\App\Http\Controllers\Member\KasController::class, 'index'])->name('kas.index');
            Route::get('/inventaris', [\App\Http\Controllers\Member\InventarisController::class, 'index'])->name('inventaris.index');
        });
    });
});

require __DIR__.'/auth.php';
