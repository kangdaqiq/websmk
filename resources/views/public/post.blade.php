@extends('layouts.public')
@section('title', $post->title)

@section('content')
<div class="bg-white py-12 min-h-[70vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="{{ route('posts') }}" class="text-primary-600 hover:text-primary-800 font-medium inline-flex items-center transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar Berita
            </a>
        </div>

        <article>
            <header class="mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl mb-4">
                    {{ $post->title }}
                </h1>
                <div class="flex items-center text-gray-500 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <time datetime="{{ $post->created_at->format('Y-m-d') }}">{{ $post->created_at->format('d F Y') }}</time>
                    <span class="mx-2">&bull;</span>
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Admin</span>
                </div>
            </header>

            @if($post->image)
                <figure class="mb-10 rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]">
                </figure>
            @endif

            <div class="prose prose-lg prose-blue max-w-none text-gray-800">
                {!! nl2br(e($post->content)) !!}
            </div>
            
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Bagikan Artikel Ini</h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition flex items-center">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 transition flex items-center">
                        Twitter / X
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition flex items-center">
                        WhatsApp
                    </a>
                </div>
            </div>
        </article>
        
    </div>
</div>
@endsection
