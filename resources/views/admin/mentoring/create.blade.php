<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Tugaskan Mentor</h1></div>
<form method="POST" action="{{ route('admin.mentoring.store') }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-2xl space-y-5">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-1">Mentor</label><select name="mentor_id" required class="w-full rounded-lg border-slate-300"><option value="">-- Pilih Mentor --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Mentee (Anggota Binaan)</label><select name="mentee_id" required class="w-full rounded-lg border-slate-300"><option value="">-- Pilih Mentee --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Mulai</label><input type="date" name="start_date" required value="{{ now()->format('Y-m-d') }}" class="w-full rounded-lg border-slate-300"></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Simpan</button>
</form></x-app-layout>
