@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('header', 'Pesan Masuk')
@section('subheader', 'Pesan dari form kontak.')
@section('actions')
<form method="POST" action="{{ route('admin.messages.read-all') }}">
    @csrf
    <button class="px-4 py-2 rounded-xl text-xs font-bold border border-zinc-200 dark:border-zinc-800 hover:border-emerald-400 hover:text-emerald-600 transition-colors">
        <i class="fas fa-check-double mr-1"></i> Tandai semua dibaca
    </button>
</form>
@endsection

@section('content')
<div class="flex flex-wrap gap-2 mb-5">
    @foreach(['all' => 'Semua', 'contact' => 'Pesan Kontak'] as $key => $text)
    <a href="{{ route('admin.messages.index', ['type' => $key]) }}"
        class="px-4 py-2 rounded-xl text-xs font-bold border transition-colors {{ $type === $key ? 'bg-emerald-500 text-zinc-950 border-emerald-500' : 'bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-emerald-400' }}">
        {{ $text }}
    </a>
    @endforeach
    <span class="ml-auto self-center text-xs font-semibold text-zinc-500 dark:text-zinc-400">{{ $messages->total() }} pesan • {{ $unread }} belum dibaca</span>
</div>

<div class="space-y-3">
    @forelse($messages as $message)
    <div class="rounded-2xl bg-white dark:bg-zinc-900 border {{ $message->is_read ? 'border-zinc-200 dark:border-zinc-800' : 'border-emerald-300 dark:border-emerald-500/40 ring-1 ring-emerald-100 dark:ring-emerald-500/20' }} p-4 md:p-5">
        <div class="flex items-start gap-3">
            <span class="w-10 h-10 shrink-0 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-extrabold">
                {{ strtoupper(substr($message->name, 0, 1)) }}
            </span>

            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="font-bold text-sm">{{ $message->name }}</p>
                    @if($message->role)
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">{{ $message->role }}</span>
                    @endif
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $message->type === 'guestbook' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400' }}">
                        {{ $message->type === 'guestbook' ? 'Kesan & Pesan' : 'Kontak' }}
                    </span>
                    @if(! $message->is_read)
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400">Baru</span>
                    @endif
                </div>

                <div class="flex flex-wrap gap-x-3 text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                    <span><i class="far fa-clock mr-1"></i>{{ $message->created_at->format('d M Y, H:i') }}</span>
                    @if($message->email)
                    <a href="mailto:{{ $message->email }}" class="hover:text-emerald-600"><i class="fas fa-envelope mr-1"></i>{{ $message->email }}</a>
                    @endif
                </div>

                <p class="text-sm text-zinc-700 dark:text-zinc-300 mt-2 whitespace-pre-line">{{ $message->message }}</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-1.5 shrink-0">
                <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                    @csrf @method('PATCH')
                    <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-emerald-600 hover:border-emerald-400 transition-colors" title="{{ $message->is_read ? 'Tandai belum dibaca' : 'Tandai dibaca' }}">
                        <i class="fas {{ $message->is_read ? 'fa-envelope' : 'fa-check' }} text-xs"></i>
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan dari {{ addslashes($message->name) }}?')">
                    @csrf @method('DELETE')
                    <button class="w-8 h-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-red-600 hover:border-red-400 transition-colors" title="Hapus">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-12 text-center">
        <i class="fas fa-inbox text-3xl text-zinc-300 dark:text-zinc-600 mb-3"></i>
        <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400">Belum ada pesan masuk.</p>
    </div>
    @endforelse
</div>

<div class="mt-5">
    {{ $messages->links() }}
</div>
@endsection
