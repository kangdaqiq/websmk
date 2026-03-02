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
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            transition: all 0.3s ease;
        }
        .glass-nav.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 10)" :class="{'scrolled': scrolled, 'py-4': !scrolled, 'py-2': scrolled}" class="glass-nav fixed w-full z-50 top-0 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-300 h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $settings['school_name'] ?? 'Sekolah' }}" class="h-10 w-auto drop-shadow-md">
                        <span class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-primary-600 via-primary-600 to-primary-600 hidden sm:block">
                            {{ $settings['school_name'] ?? 'SMK Hebat' }}
                        </span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : '' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : '' }}">Tentang Kami</a>
                    <a href="{{ route('posts') }}" class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('posts', 'post') ? 'bg-primary-50 text-primary-600' : '' }}">Berita</a>
                    <a href="{{ route('galleries') }}" class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('galleries') ? 'bg-primary-50 text-primary-600' : '' }}">Galeri</a>
                    
                    <!-- Dropdown Aplikasi -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 focus:outline-none">
                            Aplikasi
                            <svg :class="{'rotate-180': dropdownOpen}" class="w-4 h-4 transition-transform duration-200 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="dropdownOpen" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50"
                            style="display: none;">
                            <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">E-Rapor</a>
                            <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors border-t border-gray-50">Sispendik</a>
                            <a href="#" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors border-t border-gray-50">Sistem Absensi</a>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-full text-gray-700 hover:text-primary-600 hover:bg-primary-50 font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : '' }}">Kontak</a>
                    
                    <div class="ml-4 pl-4 border-l border-gray-200 flex items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-gradient-to-r from-primary-600 to-primary-600 hover:from-primary-700 hover:to-primary-700 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 border border-primary-600 text-sm font-medium rounded-full text-primary-600 bg-transparent hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                                    Login Staf
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-primary-600 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-xl absolute w-full left-0 top-full"
            style="display: none;"
        >
            <div class="px-4 pt-2 pb-6 space-y-1 sm:px-6">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Tentang Kami</a>
                <a href="{{ route('posts') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('posts', 'post') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Berita</a>
                <a href="{{ route('galleries') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('galleries') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Galeri</a>
                
                <!-- Mobile Dropdown Aplikasi -->
                <div x-data="{ mobileAppOpen: false }" class="border-t border-b border-gray-100 py-1 my-1">
                    <button @click="mobileAppOpen = !mobileAppOpen" class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 focus:outline-none transition-colors">
                        Aplikasi
                        <svg :class="{'rotate-180': mobileAppOpen}" class="w-4 h-4 transition-transform duration-200 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="mobileAppOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="pl-4 pr-4 py-2 mt-1 space-y-1 bg-gray-50/80 rounded-b-lg border-l-2 border-primary-500 ml-2"
                         style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">E-Rapor</a>
                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">Sispendik</a>
                        <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary-600 hover:bg-primary-100 rounded-md transition-colors">Sistem Absensi</a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">Kontak</a>
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/admin/dashboard') }}" class="block w-full text-center px-4 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 border border-primary-600 text-base font-medium rounded-lg text-primary-600 bg-transparent hover:bg-primary-50">Login Staf</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-primary-400 to-primary-400">{{ $settings['school_name'] ?? 'SMK Hebat' }}</h3>
                    <p class="text-gray-400">{{ $settings['school_visi_misi'] ?? 'Menjadi sekolah terbaik.' }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-primary-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $settings['school_address'] ?? 'Jl. Pendidikan No. 1' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>{{ $settings['school_phone'] ?? '(021) 123456' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>{{ $settings['school_email'] ?? 'info@sekolah.com' }}</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Pintasan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-500 transition">Beranda</a></li>
                        <li><a href="{{ route('posts') }}" class="hover:text-primary-500 transition">Berita</a></li>
                        <li><a href="{{ route('galleries') }}" class="hover:text-primary-500 transition">Galeri</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'SMK Hebat' }}. All rights reserved. Built with ❤️.
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
</body>
</html>
