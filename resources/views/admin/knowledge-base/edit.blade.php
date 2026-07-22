<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">Edit: {{ $knowledgeBase->judul }}</h1></div>
<form method="POST" action="{{ route('admin.knowledge-base.update', $knowledgeBase) }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-3xl space-y-5">@csrf @method('PUT')
<div><label class="block text-sm font-medium text-slate-700 mb-1">Judul</label><input type="text" name="judul" required value="{{ $knowledgeBase->judul }}" class="w-full rounded-lg border-slate-300"></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label><select name="tipe" required class="w-full rounded-lg border-slate-300">@foreach(['artikel','panduan','sop','faq'] as $t)<option value="{{ $t }}" {{ $knowledgeBase->tipe===$t?'selected':'' }}>{{ ucfirst($t) }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Konten</label><textarea name="konten" rows="12" required class="w-full rounded-lg border-slate-300">{{ $knowledgeBase->konten }}</textarea></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700">Update</button>
</form></x-app-layout>
