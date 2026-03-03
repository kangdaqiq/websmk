<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['school_name'] ?? 'Sekolah Kita' }} - @yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AlpineJS for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .glass-nav.scrolled {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
        }

        /* Auto Slide / Marquee Animation for Gallery */
        @keyframes slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .gallery-track {
            display: flex;
            width: max-content;
            animation: slide 30s linear infinite;
        }

        .gallery-track:hover {
            animation-play-state: paused;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.6s ease-out, visibility 0.6s ease-out;
        }

        body.loaded #preloader {
            opacity: 0;
            visibility: hidden;
        }

        body.loading {
            overflow: hidden;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen loading">

    <!-- Preloader -->
    <div id="preloader">
        <div class="w-12 h-12 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
        <p class="mt-4 text-primary-600 font-bold tracking-widest text-sm uppercase animate-pulse">Memuat...</p>
    </div>

    <!-- Top Bar -->
    <div class="bg-gray-900 text-gray-300 text-xs h-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
            <!-- Left: Phone & Email -->
            <div class="hidden md:flex items-center gap-4">
                @if(!empty($settings['school_phone']))
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        {{ $settings['school_phone'] }}
                    </span>
                @endif
                @if(!empty($settings['school_email']))
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $settings['school_email'] }}
                    </span>
                @endif
            </div>

            <!-- Right: Social Media + Search -->
            <div class="flex items-center gap-3 ml-auto">
                <!-- Social Media Icons -->
                <div class="flex items-center gap-2">
                    @if(!empty($settings['social_wa']))
                        <a href="{{ $settings['social_wa'] }}" target="_blank" title="WhatsApp"
                            class="hover:text-green-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($settings['social_ig']))
                        <a href="{{ $settings['social_ig'] }}" target="_blank" title="Instagram"
                            class="hover:text-pink-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($settings['social_fb']))
                        <a href="{{ $settings['social_fb'] }}" target="_blank" title="Facebook"
                            class="hover:text-blue-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($settings['social_yt']))
                        <a href="{{ $settings['social_yt'] }}" target="_blank" title="YouTube"
                            class="hover:text-red-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($settings['social_tiktok']))
                        <a href="{{ $settings['social_tiktok'] }}" target="_blank" title="TikTok"
                            class="hover:text-white transition-colors">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                    @endif
                </div>

                <!-- Search Bar -->
                <form action="{{ route('posts') }}" method="GET" class="hidden md:flex items-center w-36">
                    <div class="relative w-full">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..."
                            class="w-full bg-gray-800 text-gray-200 text-xs placeholder-gray-500 rounded-full pl-3 pr-8 py-1 border border-gray-700 focus:outline-none focus:border-gray-500 transition-colors">
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>{{-- end wrapper sosmed+search --}}
        </div>
    </div>{{-- /Top Bar --}}

    <!-- Navbar Spacer (muncul saat navbar jadi fixed, cegah content jump) -->
    <div id="navbar-spacer" style="display:none; height:72px;"></div>

    <!-- Navbar -->
    <nav x-data="{ open: false }" id="main-navbar" class="glass-nav w-full transition-all duration-300 py-2"
        style="z-index: 50;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300 h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $settings['school_name'] ?? 'Sekolah' }}"
                            class="h-10 w-auto drop-shadow-md">
                        <span
                            class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-primary-600 via-primary-600 to-primary-600 hidden sm:block">
                            {{ $settings['school_name'] ?? 'SMK Hebat' }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : '' }}">Beranda</a>
                    <a href="{{ route('posts') }}"
                        class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('posts', 'post') ? 'bg-primary-50 text-primary-600' : '' }}">Berita</a>
                    <a href="{{ route('galleries') }}"
                        class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('galleries') ? 'bg-primary-50 text-primary-600' : '' }}">Galeri</a>
                    <a href="{{ route('virtual-tour') }}"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-full text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 font-medium transition-all duration-200 {{ request()->routeIs('virtual-tour') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 00-2 2v4a2 2 0 002 2h9a2 2 0 002-2v-4a2 2 0 00-2-2H3z" />
                        </svg>
                        Virtual Tour
                    </a>

                    <!-- Dropdown Aplikasi -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false">
                        <button
                            class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 focus:outline-none">
                            Aplikasi
                            <svg :class="{'rotate-180': dropdownOpen}"
                                class="w-4 h-4 transition-transform duration-200 text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 pt-1 w-48 z-50" style="display: none;">
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                                <a href="https://erapor.smkassuniyah.sch.id" target="_blank"
                                    class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">E-Rapor</a>
                                <a href="https://sispendik.smkassuniyah.sch.id" target="_blank"
                                    class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors border-t border-gray-50">Sispendik</a>
                                <a href="https://absen.smkassuniyah.sch.id" target="_blank"
                                    class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors border-t border-gray-50">Sistem
                                    Absensi</a>
                            </div>
                        </div>
                    </div>



                    <a href="{{ route('contact') }}"
                        class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : '' }}">Kontak</a>

                    <a href="{{ route('about') }}"
                        class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : '' }}">Tentang
                        Kami</a>

                    <div class="ml-4 pl-4 border-l border-gray-200 flex items-center">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-gradient-to-r from-primary-600 to-primary-600 hover:from-primary-700 hover:to-primary-700 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            SPMB (Pendaftaran)
                            <span class="flex h-2 w-2 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-primary-600 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-xl absolute w-full left-0 top-full"
            style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1 sm:px-6">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ route('about') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Tentang
                    Kami</a>
                <a href="{{ route('posts') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('posts', 'post') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Berita</a>
                <a href="{{ route('galleries') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('galleries') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Galeri</a>
                <a href="{{ route('virtual-tour') }}"
                    class="flex items-center gap-2 px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('virtual-tour') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 00-2 2v4a2 2 0 002 2h9a2 2 0 002-2v-4a2 2 0 00-2-2H3z" />
                    </svg>
                    Virtual Tour
                </a>

                <!-- Mobile Dropdown Aplikasi -->
                <div x-data="{ mobileAppOpen: false }" class="border-t border-b border-gray-100 py-1 my-1">
                    <button @click="mobileAppOpen = !mobileAppOpen"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 focus:outline-none transition-colors">
                        Aplikasi
                        <svg :class="{'rotate-180': mobileAppOpen}"
                            class="w-4 h-4 transition-transform duration-200 text-gray-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="mobileAppOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="pl-4 pr-4 py-2 mt-1 space-y-1 bg-gray-50/80 rounded-b-lg border-l-2 border-primary-500 ml-2"
                        style="display: none;">
                        <a href="#"
                            class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">E-Rapor</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">Sispendik</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">Sistem
                            Absensi</a>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ Route::has('register') ? route('register') : '#' }}"
                        class="flex items-center justify-center gap-2 w-full text-center px-4 py-3 border border-transparent text-base font-bold rounded-lg text-white bg-primary-600 hover:bg-primary-700 shadow-md">
                        SPMB (Pendaftaran)
                        <span class="flex h-3 w-3 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-200 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-8">
                <div class="md:col-span-2 lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $settings['school_name'] ?? 'Sekolah' }}"
                            class="h-12 w-auto">
                        <h3
                            class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-400 to-primary-400">
                            {{ $settings['school_name'] ?? 'SMK Hebat' }}
                        </h3>
                    </div>
                    <p class="text-gray-400 mb-4">{{ $settings['school_visi_misi'] ?? 'Menjadi sekolah terbaik.' }}
                    </p>
                    <!-- Social Media Icons - Footer -->
                    <div class="flex items-center gap-2 mt-2">
                        @if(!empty($settings['social_wa']))
                            <a href="{{ $settings['social_wa'] }}" target="_blank" title="WhatsApp"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-green-500 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_ig']))
                            <a href="{{ $settings['social_ig'] }}" target="_blank" title="Instagram"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_fb']))
                            <a href="{{ $settings['social_fb'] }}" target="_blank" title="Facebook"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_yt']))
                            <a href="{{ $settings['social_yt'] }}" target="_blank" title="YouTube"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-red-600 hover:text-white transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_tiktok']))
                            <a href="{{ $settings['social_tiktok'] }}" target="_blank" title="TikTok"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-gray-400 hover:bg-gray-100 hover:text-gray-900 transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-1 lg:col-span-1">
                    <h4 class="text-lg font-semibold mb-4 text-white">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400">
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"
                                    class="hover:text-primary-400 transition-colors flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    SPMB (Pendaftaran)
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="#" class="hover:text-primary-400 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                Login Siswa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts') }}"
                                class="hover:text-primary-400 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                Berita Terbaru
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="md:col-span-1 lg:col-span-1">
                    <h4 class="text-lg font-semibold mb-4 text-white">Aplikasi Internal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>
                            <a href="#" class="hover:text-primary-400 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                E-Rapor
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary-400 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Sispendik
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary-400 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Sistem Absensi
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="md:col-span-2 lg:col-span-1">
                    <h4 class="text-lg font-semibold mb-4 text-white">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-primary-500 mt-1 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $settings['school_address'] ?? 'Jl. Pendidikan No. 1' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>{{ $settings['school_phone'] ?? '(021) 123456' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>{{ $settings['school_email'] ?? 'info@sekolah.com' }}</span>
                        </li>
                    </ul>
                </div>

            </div>


            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'SMK Hebat' }}. All rights reserved. Built
                with
                ❤️.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });
    </script>

    <script>
        // Sticky navbar: fix when scrolled past topbar (32px)
        (function () {
            const navbar = document.getElementById('main-navbar');
            const spacer = document.getElementById('navbar-spacer');
            const TOPBAR_H = 32; // height of topbar in px

            function onScroll() {
                if (window.scrollY > TOPBAR_H) {
                    navbar.style.position = 'fixed';
                    navbar.style.top = '0';
                    navbar.style.left = '0';
                    navbar.style.right = '0';
                    navbar.style.width = '100%';
                    spacer.style.display = 'block';
                } else {
                    navbar.style.position = '';
                    navbar.style.top = '';
                    navbar.style.left = '';
                    navbar.style.right = '';
                    navbar.style.width = '';
                    spacer.style.display = 'none';
                }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll(); // run on load
        })();

        // Preloader auto-hide on window load
        window.addEventListener('load', function () {
            // Add a small delay for smoother transition
            setTimeout(function () {
                document.body.classList.remove('loading');
                document.body.classList.add('loaded');
            }, 300);
        });
    </script>
    @stack('scripts')
</body>

</html>