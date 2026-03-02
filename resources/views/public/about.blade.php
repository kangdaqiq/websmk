@extends('layouts.public')
@section('title', 'Tentang Kami')

@section('content')
<div class="bg-white">
    <!-- Header -->
    <div class="bg-primary-600 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">
                Tentang Kami
            </h1>
            <p class="mt-4 text-xl text-primary-100 max-w-2xl mx-auto">
                Mengenal lebih dekat visi, misi, dan identitas {{ $settings['school_name'] ?? 'sekolah kami' }}.
            </p>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 sm:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            
            <div class="w-full lg:w-1/2">
                <!-- Sampul Foto Sekolah -->
                <div class="aspect-w-16 aspect-h-9 sm:aspect-h-10 rounded-2xl overflow-hidden shadow-2xl relative group">
                    <img src="{{ asset('images/about-cover.png') }}" alt="Gedung {{ $settings['school_name'] ?? 'Sekolah' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-sm font-semibold rounded-full border border-white/30">{{ $settings['school_name'] ?? 'SMK Hebat' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl mb-6">Profil Sekolah</h2>
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-4">
                        {{ $settings['school_name'] ?? 'Sekolah Kita' }} didedikasikan untuk membentuk generasi muda yang kompeten, berkarakter, dan siap menghadapi tantangan global. Kami berkomitmen memberikan layakan pendidikan bermutu dengan fasilitas yang memadai dan tenaga pendidik yang profesional.
                    </p>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Visi & Misi</h3>
                    <div class="bg-primary-50 border-l-4 border-primary-500 p-6 rounded-r-lg">
                        <p class="text-gray-700 italic font-medium">
                            "{!! nl2br(e($settings['school_visi_misi'] ?? 'Menjadi instansi pendidikan terbaik dan mencetak lulusan unggul.')) !!}"
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
