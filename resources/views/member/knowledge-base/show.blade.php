<x-app-layout>
<div class="mb-6"><a href="{{ route('member.knowledge-base.index') }}" class="text-primary-600 text-sm font-medium">← Kembali</a><h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $knowledgeBase->judul }}</h1><div class="flex items-center gap-3 mt-2"><span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-700 capitalize">{{ $knowledgeBase->tipe }}</span><span class="text-sm text-slate-500">{{ $knowledgeBase->created_at->format('d M Y') }}</span></div></div>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 prose max-w-none">{!! nl2br(e($knowledgeBase->konten)) !!}</div>
</x-app-layout>
