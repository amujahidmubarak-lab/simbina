<x-guest-layout>
    <div class="mb-4 text-sm text-slate-600 bg-slate-50 p-4 rounded-lg border border-slate-200 text-center">
        @if (Auth::user()->status === 'pending')
            <div class="mx-auto w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-lg font-bold text-slate-900 mb-2">Menunggu Persetujuan</h2>
            Terima kasih telah mendaftar! Akun Anda saat ini sedang dalam status <strong>Pending</strong>. <br>
            Harap tunggu admin untuk menyetujui pendaftaran Anda sebelum dapat mengakses dashboard.
        @elseif (Auth::user()->status === 'rejected')
            <div class="mx-auto w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <h2 class="text-lg font-bold text-slate-900 mb-2">Pendaftaran Ditolak</h2>
            Mohon maaf, pendaftaran akun Anda <strong>Ditolak</strong> oleh Admin. <br>
            Silakan hubungi pengurus kontrakan pembinaan untuk informasi lebih lanjut.
        @endif
    </div>

    <div class="mt-6 flex items-center justify-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
