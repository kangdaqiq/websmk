@extends('layouts.public')
@section('title', 'Semua Berita')

@section('content')
<div class="bg-gray-50 py-12 min-h-[70vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Semua Berita & Pengumuman
            </h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Kumpulan informasi terbaru dari sekolah.
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="flex-shrink-0 h-48 bg-gray-200">
                        @if($post->image)
                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-400">Tak Ada Gambar</div>
                        @endif
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="{{ route('post', $post->slug) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 hover:text-primary-600 transition">
                                    {{ $post->title }}
                                </p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="text-sm text-gray-500">
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                    {{ $post->created_at->format('d M Y') }}
                                </time>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-lg shadow">
                    Belum ada berita dipublikasikan.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
