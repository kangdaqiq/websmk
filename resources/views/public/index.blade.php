@extends('layouts.public')
@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden min-h-[90vh] flex items-center bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/about-cover.jpg') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-12">
            
            <!-- Hero Content -->
            <div class="w-full max-w-3xl pt-10" data-aos="fade-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full border border-white/30 bg-black/20 text-white text-sm font-semibold mb-6 backdrop-blur-md">
                    <span class="flex h-2 w-2 relative mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                    </span>
                    Selamat Datang di Generasi Cemerlang
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6 hidden md:block">
                    <span class="block drop-shadow-lg">Bersama</span>
                    <span class="block text-primary-400 drop-shadow-lg">{{ $settings['school_name'] ?? 'Sekolah Kita' }}</span>
                </h1>
                <!-- Mobile heading -->
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight mb-6 md:hidden">
                    <span class="block drop-shadow-md">Bersama</span>
                    <span class="block text-primary-400 drop-shadow-md">{{ $settings['school_name'] ?? 'Sekolah Kita' }}</span>
                </h1>
                
                <p class="mt-4 text-lg md:text-xl text-slate-200 max-w-2xl mx-auto md:mx-0 font-medium drop-shadow-md">
                    {{ $settings['hero_text'] ?? 'Wadah kreativitas dan inovasi generasi bangsa. Kami mendidik, melatih, dan menyiapkan pemuda-pemudi untuk menguasai masa depan.' }}
                </p>
                
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('posts') }}" class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white bg-primary-600 rounded-full overflow-hidden shadow-lg shadow-primary-600/30 hover:shadow-primary-600/50 transition-all duration-300 hover:-translate-y-1">
                        <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                        <span class="relative">Informasi Terbaru</span>
                        <svg class="w-5 h-5 ml-2 relative group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white bg-white/10 border border-white/20 rounded-full hover:bg-white/20 backdrop-blur-md transition-all duration-300">
                        Profil Sekolah
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Wave Bottom -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto text-gray-50 fill-current">
          <path d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>

<!-- Features / Quick Links -->
<div class="bg-gray-50 py-10 relative z-10 -mt-10 mb-8" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Berita & Artikel</h3>
                <p class="text-gray-500 mb-4">Dapatkan update terkini mengenai informasi pendidikan dan kegiatan kami.</p>
                <a href="{{ route('posts') }}" class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Baca Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Galeri Kegiatan</h3>
                <p class="text-gray-500 mb-4">Intip keseruan aktivitas siswa-siswi yang terekam dalam galeri foto.</p>
                <a href="{{ route('galleries') }}" class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Lihat Galeri <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Profil Intansi</h3>
                <p class="text-gray-500 mb-4">Kenali lebih dekat visi, misi, dan latar belakang pendidikan institusi kami.</p>
                <a href="{{ route('about') }}" class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Info Detail <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
        </div>
    </div>
</div>

<!-- Latest News Section -->
<div class="bg-gray-50 py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-base text-primary-600 font-bold tracking-widest uppercase">Pusat Informasi</h2>
            <p class="mt-2 text-3xl leading-8 font-black tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                Kabar Terbaru
            </p>
            <div class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Ikuti terus perkembangan dan pengumuman dari sekolah melalui artikel kami.
            </div>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <div class="flex flex-col rounded-2xl shadow-lg border border-gray-100 overflow-hidden bg-white hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('post', $post->slug) }}" class="block relative group overflow-hidden">
                        <div class="flex-shrink-0 h-56 bg-gray-200 overflow-hidden">
                            @if($post->image)
                                <img class="h-full w-full object-cover group-hover:scale-110 transition duration-700 ease-in-out" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400 group-hover:scale-110 transition duration-700">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary-600 shadow-sm">
                            Berita
                        </div>
                    </a>
                    
                    <div class="flex-1 bg-white p-6 md:p-8 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                    {{ $post->created_at->format('d M Y') }}
                                </time>
                            </div>
                            <a href="{{ route('post', $post->slug) }}" class="block">
                                <h3 class="text-xl font-bold text-gray-900 hover:text-primary-600 transition duration-200 line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="mt-3 text-base text-gray-600 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-900 flex items-center">
                                <span class="h-6 w-6 rounded-full bg-gradient-to-tr from-primary-500 to-primary-500 flex items-center justify-center text-white text-xs mr-2">A</span>
                                Admin
                            </span>
                            <a href="{{ route('post', $post->slug) }}" class="text-primary-600 hover:text-primary-800 text-sm font-semibold transition flex items-center">
                                Baca <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 bg-white rounded-2xl border border-gray-100 shadow-sm" data-aos="fade-in">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Belum ada publikasi berita terbaru.
                </div>
            @endforelse
        </div>
        
        <div class="mt-16 text-center" data-aos="fade-up">
            <a href="{{ route('posts') }}" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-primary-600 text-base font-bold text-primary-600 rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                Jelajahi Semua Berita
            </a>
        </div>
    </div>
</div>

<style>
    /* Custom Blob Animation */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
