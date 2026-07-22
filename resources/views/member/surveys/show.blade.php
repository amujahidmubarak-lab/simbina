<x-app-layout>
<div class="mb-6"><h1 class="text-2xl font-bold text-slate-900">{{ $survey->judul }}</h1>@if($survey->deskripsi)<p class="text-sm text-slate-500 mt-1">{{ $survey->deskripsi }}</p>@endif</div>
@if($myResponse)
<div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center">
<p class="text-emerald-700 font-medium">✓ Anda sudah mengisi survey ini.</p>
<p class="text-sm text-emerald-600 mt-1">Rating: {{ str_repeat('⭐', $myResponse->rating) }}</p>
</div>
@else
<form method="POST" action="{{ route('member.surveys.store', $survey) }}" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 max-w-xl space-y-6">@csrf
<div><label class="block text-sm font-medium text-slate-700 mb-3">Rating</label>
<div class="flex gap-4">@for($i=1;$i<=5;$i++)<label class="flex flex-col items-center gap-1 cursor-pointer"><input type="radio" name="rating" value="{{ $i }}" required class="sr-only peer"><div class="w-12 h-12 rounded-xl border-2 border-slate-200 flex items-center justify-center text-lg peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:border-primary-300 transition">{{ $i }}⭐</div></label>@endfor</div></div>
<div><label class="block text-sm font-medium text-slate-700 mb-1">Feedback (Opsional)</label><textarea name="feedback" rows="4" class="w-full rounded-lg border-slate-300" placeholder="Sampaikan pendapat Anda..."></textarea></div>
<button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-primary-700 w-full">Kirim Evaluasi</button>
</form>@endif
</x-app-layout>
