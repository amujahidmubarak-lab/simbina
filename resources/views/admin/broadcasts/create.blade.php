<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Kirim Broadcast</h1></div>
<form method="POST" action="{{ route('admin.broadcasts.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Judul</label><input type="text" name="judul" required class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Konten</label><textarea name="konten" rows="5" required class="w-full rounded-lg border-slate-300"></textarea></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Target</label><select name="target_type" required class="w-full rounded-lg border-slate-300"><option value="semua">Semua Anggota</option><option value="kontrakan">Per Kontrakan</option><option value="role">Per Role</option></select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Kontrakan (jika per-kontrakan)</label><select name="target_id" class="w-full rounded-lg border-slate-300"><option value="">--</option>@foreach($kontrakans as $k)<option value="{{ $k->id }}">{{ $k->nama_kontrakan }}</option>@endforeach</select></div>
<label class="flex items-center gap-2"><input type="checkbox" name="is_penting" class="rounded border-slate-300 text-red-600"><span class="text-sm text-slate-700 font-medium">Tandai sebagai Penting</span></label>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Kirim Broadcast</button>
</form></x-app-layout>
