<!-- Sidebar Backdrop -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;"></div>

<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col bg-white border-r border-slate-200/60 shadow-xl shadow-slate-200/20 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 -translate-x-full">
    
    <!-- Logo -->
    <div class="flex items-center h-20 border-b border-slate-100 px-6 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-primary-500/30 group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="text-2xl font-bold tracking-tight text-slate-900">Simbina<span class="text-primary-600">.</span></span>
        </a>
    </div>

    <!-- Navigation -->
    <div class="overflow-y-auto flex-1 py-6 px-4 space-y-1 scrollbar-thin">
        
        @php $active = fn($r) => request()->routeIs($r) ? 'bg-primary-50 text-primary-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium transition-colors'; @endphp
        @php $iconActive = fn($r) => request()->routeIs($r) ? 'text-primary-600' : 'text-slate-400'; @endphp

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3 px-3">Menu Utama</div>
        
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('dashboard') }}">
            <svg class="w-5 h-5 {{ $iconActive('dashboard') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        <a href="{{ route('search') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('search') }}">
            <svg class="w-5 h-5 {{ $iconActive('search') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Pencarian
        </a>

        @role('admin')
        {{-- ===== ADMIN SECTION ===== --}}
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Administrasi</div>
        
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.users.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.users.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            User Management
        </a>

        <a href="{{ route('admin.org-health.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.org-health.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.org-health.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Kesehatan Organisasi
        </a>

        <a href="{{ route('admin.early-warnings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.early-warnings.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.early-warnings.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
            Early Warning
        </a>

        <a href="{{ route('admin.audit-logs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.audit-logs.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.audit-logs.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Audit Log
        </a>

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Monitoring</div>

        <a href="{{ route('admin.amal.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.amal.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.amal.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Rekap Yaumiyyah
        </a>
        <a href="{{ route('admin.amal-usbuyyah.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.amal-usbuyyah.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.amal-usbuyyah.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Rekap Mingguan
        </a>
        <a href="{{ route('admin.attendances.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.attendances.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.attendances.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            Kehadiran
        </a>

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Pembinaan</div>

        <a href="{{ route('admin.catatan-pembinaan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.catatan-pembinaan.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.catatan-pembinaan.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Catatan Pembinaan
        </a>
        <a href="{{ route('admin.mentoring.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.mentoring.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.mentoring.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Mentoring
        </a>
        <a href="{{ route('admin.penugasan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.penugasan.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.penugasan.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            Penugasan
        </a>

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Konten & Komunikasi</div>

        <a href="{{ route('admin.kontrakans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.kontrakans.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.kontrakans.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            Kontrakan
        </a>
        <a href="{{ route('admin.kegiatans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.kegiatans.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.kegiatans.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Kegiatan
        </a>
        <a href="{{ route('admin.pengumumans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.pengumumans.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.pengumumans.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            Pengumuman
        </a>
        <a href="{{ route('admin.materis.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.materis.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.materis.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Materi Kajian
        </a>
        <a href="{{ route('admin.broadcasts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.broadcasts.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.broadcasts.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
            Broadcast
        </a>
        <a href="{{ route('admin.knowledge-base.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.knowledge-base.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.knowledge-base.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Knowledge Base
        </a>
        <a href="{{ route('admin.surveys.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.surveys.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.surveys.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            Survey & Evaluasi
        </a>

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Operasional</div>

        <a href="{{ route('admin.inventaris.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.inventaris.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.inventaris.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Inventaris
        </a>
        <a href="{{ route('admin.kas.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('admin.kas.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('admin.kas.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Kas Kontrakan
        </a>
        @endrole

        {{-- ===== MEMBER SECTION (visible to member role) ===== --}}
        @role('member|koordinator')
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Evaluasi Amal</div>
        
        <a href="{{ route('member.amal.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.amal.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.amal.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Amal Yaumiyyah
        </a>
        <a href="{{ route('member.amal-usbuyyah.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.amal-usbuyyah.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.amal-usbuyyah.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Amal Mingguan
        </a>
        <a href="{{ route('member.muhasabah.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.muhasabah.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.muhasabah.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Muhasabah
        </a>
        <a href="{{ route('member.progress.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.progress.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.progress.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Progress Saya
        </a>

        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-8 mb-3 px-3">Informasi</div>

        <a href="{{ route('member.penugasan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.penugasan.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.penugasan.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            Tugas Saya
        </a>
        <a href="{{ route('member.pengumumans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.pengumumans.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.pengumumans.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            Pengumuman
        </a>
        <a href="{{ route('member.materis.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.materis.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.materis.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Materi
        </a>
        <a href="{{ route('member.knowledge-base.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.knowledge-base.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.knowledge-base.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Knowledge Base
        </a>
        <a href="{{ route('member.surveys.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $active('member.surveys.*') }}">
            <svg class="w-5 h-5 {{ $iconActive('member.surveys.*') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            Survey
        </a>
        @endrole
    </div>
    
    <!-- User Footer -->
    <div class="p-4 border-t border-slate-100">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors group">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-100 to-indigo-100 border border-primary-200 flex items-center justify-center shrink-0">
                <span class="text-sm font-bold text-primary-700">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</div>
                <div class="text-[11px] text-slate-500 truncate capitalize">{{ Auth::user()->roles->first()?->name ?? 'Member' }}</div>
            </div>
        </a>
    </div>
</aside>
