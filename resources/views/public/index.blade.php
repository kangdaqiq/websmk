@extends('layouts.public')
@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden min-h-screen flex items-center" x-data="{
                    activeSlide: 0,
                    slides: [
                        '{{ secure_asset('images/banner1.jpg') }}',
                        '{{ secure_asset('images/banner2.jpg') }}',
                        '{{ secure_asset('images/banner3.jpg') }}'
                    ],
                    init() {
                        setInterval(() => {
                            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                        }, 5000);
                    }
                }">

        <!-- Background Slider -->
        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                :class="activeSlide === index ? 'opacity-100 scale-105' : 'opacity-0 scale-100'"
                :style="`transition: all 2s ease-in-out; background-image: url('${slide}');`">
            </div>
        </template>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-12">

                <!-- Hero Content -->
                <div class="w-full max-w-3xl pt-10" data-aos="fade-up">


                    <h1
                        class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6 hidden md:block">
                        <span class="block drop-shadow-lg"></span>
                        <span
                            class="block text-primary-400 drop-shadow-lg">{{ $settings['school_name'] ?? 'Sekolah Kita' }}</span>
                    </h1>
                    <!-- Mobile heading -->
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight mb-6 md:hidden">
                        <span class="block drop-shadow-md"></span>
                        <span
                            class="block text-primary-400 drop-shadow-md">{{ $settings['school_name'] ?? 'Sekolah Kita' }}</span>
                    </h1>

                    <p class="mt-4 text-lg md:text-xl text-slate-200 max-w-2xl mx-auto md:mx-0 font-medium drop-shadow-md">
                        {{ $settings['hero_text'] ?? 'Wadah kreativitas dan inovasi generasi bangsa. Kami mendidik, melatih, dan menyiapkan pemuda-pemudi untuk menguasai masa depan.' }}
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="https://spmb.smkassuniyah.sch.id/" target="_blank"
                            class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white bg-primary-600 rounded-full overflow-hidden shadow-lg shadow-primary-600/30 hover:shadow-primary-600/50 transition-all duration-300 hover:-translate-y-1">
                            <span
                                class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                            <span class="relative">Daftar Sekarang</span>
                            <svg class="w-5 h-5 ml-2 relative group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('about') }}"
                            class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white bg-white/10 border border-white/20 rounded-full hover:bg-white/20 backdrop-blur-md transition-all duration-300">
                            Profil Sekolah
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Wave Bottom -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto text-gray-50 fill-current">
                <path
                    d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Features / Quick Links -->
    <div class="bg-gray-50 py-10 relative z-10 -mt-10 mb-8" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Berita & Artikel</h3>
                    <p class="text-gray-500 mb-4">Dapatkan update terkini mengenai informasi pendidikan dan kegiatan kami.
                    </p>
                    <a href="{{ route('posts') }}"
                        class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></a>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Galeri Kegiatan</h3>
                    <p class="text-gray-500 mb-4">Intip keseruan aktivitas siswa-siswi yang terekam dalam galeri foto.</p>
                    <a href="{{ route('galleries') }}"
                        class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Lihat Galeri <svg
                            class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></a>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Profil Intansi</h3>
                    <p class="text-gray-500 mb-4">Kenali lebih dekat visi, misi, dan latar belakang pendidikan institusi
                        kami.</p>
                    <a href="{{ route('about') }}"
                        class="text-primary-600 font-semibold hover:text-primary-800 flex items-center">Info Detail <svg
                            class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Principal Welcome Section -->
    <div class="bg-white py-24 my-10 relative overflow-hidden" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Text Content (Moved to Left) -->
                <div class="lg:col-span-8 order-2 lg:order-1" data-aos="fade-right" data-aos-delay="300">
                    <h2 class="text-sm font-bold text-primary-600 tracking-widest uppercase mb-3">Sambutan Kepala
                        Sekolah</h2>
                    <h3 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">Selamat Datang di
                        Portal Resmi<br><span
                            class="text-primary-600">{{ $settings['school_name'] ?? 'Sekolah Kita' }}</span></h3>
                    <div class="prose prose-lg text-gray-600 mb-8 w-full max-w-none">
                        @if(!empty($settings['principal_greeting']))
                            {!! $settings['principal_greeting'] !!}
                        @else
                            <p class="mb-4 text-xl font-medium text-gray-800">
                                Assalamu'alaikum Warahmatullahi Wabarakatuh.
                            </p>
                            <p class="mb-4 leading-relaxed">
                                Puji syukur kami panjatkan kehadirat Allah SWT atas limpahan rahmat dan karunia-Nya. Kami
                                mengucapkan selamat datang di website resmi sekolah kami.
                            </p>
                            <p class="leading-relaxed">
                                Dalam era digital yang terus berkembang, kehadiran website sekolah menjadi sangat penting
                                sebagai sarana informasi dan komunikasi bagi seluruh civitas akademika, orang tua murid,
                                serta masyarakat luas. Kami senantiasa berkomitmen untuk terus meningkatkan mutu pendidikan
                                dan memberikan layanan terbaik demi mencetak generasi muda yang cerdas, berkarakter, dan
                                berdaya saing global.
                            </p>
                        @endif
                    </div>
                    <div class="flex items-center mt-8">
                        <div class="w-16 h-1 bg-primary-600 mr-5 rounded-full"></div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">
                                {{ $settings['principal_name'] ?? 'Kepala Sekolah' }}
                            </h4>
                            <p class="text-base text-gray-500 font-medium mt-1">
                                Kepala {{ $settings['school_name'] ?? 'Sekolah Kita' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Image Content (Moved to Right) -->
                <div class="lg:col-span-4 flex justify-center lg:justify-end relative order-1 lg:order-2"
                    data-aos="fade-left" data-aos-delay="200">
                    <div
                        class="absolute inset-0 bg-primary-200 blur-3xl rounded-full opacity-30 transform translate-x-1/4 -translate-y-1/4">
                    </div>
                    <div
                        class="relative w-64 h-64 md:w-80 md:h-80 rounded-full border-4 border-gray-50 shadow-xl overflow-hidden bg-white">
                        <img src="{{ asset('images/kepala-sekolah.jpg') }}" alt="Kepala Sekolah"
                            class="w-full h-full object-cover"
                            onerror="this.src='https://ui-avatars.com/api/?name=Kepala+Sekolah&background=0D8ABC&color=fff&size=512'">
                    </div>
                    <!-- Decorative Element -->
                    <div
                        class="absolute -bottom-4 -left-2 w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg border border-gray-100">
                        <svg class="w-10 h-10 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Jurusan / Program Keahlian Section -->
    <div class="bg-gray-50 py-20 relative overflow-hidden" data-aos="fade-up">
        <!-- Decorative subtle pattern -->
        <div class="absolute inset-0 opacity-5"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-base text-primary-600 font-bold tracking-widest uppercase mb-2">Program Unggulan</h2>
                <h3 class="text-3xl md:text-5xl font-black text-gray-900 leading-tight">
                    Kompetensi Keahlian
                </h3>
                <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto">
                    Kami menawarkan berbagai program keahlian yang disesuaikan dengan kebutuhan industri dan dunia kerja
                    masa kini.
                </p>
                <div class="w-24 h-1.5 bg-primary-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Jurusan 1: TSM (Teknik Sepeda Motor) -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Teknik Sepeda Motor"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-600 text-white shadow-sm mb-2">
                                TSM
                            </span>
                            <h4 class="text-xl font-bold text-white leading-tight">Teknik Sepeda Motor</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Mempelajari keterampilan dalam melakukan perawatan, perbaikan, perakitan, dan modifikasi mesin
                            serta sistem kelistrikan pada sepeda motor berbagai merek.
                        </p>
                        <a href="#"
                            class="inline-flex items-center text-primary-600 font-bold hover:text-primary-800 text-sm">
                            Pelajari Lebih Lanjut <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 2: TB (Tata Busana) -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Tata Busana"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-pink-500 text-white shadow-sm mb-2">
                                TB
                            </span>
                            <h4 class="text-xl font-bold text-white leading-tight">Tata Busana</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Mengembangkan kreativitas di bidang *fashion*, mencakup pembuatan pola, menjahit, mendesain
                            pakaian modis, dan mengelola produksi busana berkualitas.
                        </p>
                        <a href="#"
                            class="inline-flex items-center text-primary-600 font-bold hover:text-primary-800 text-sm">
                            Pelajari Lebih Lanjut <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 3: TPHP (Teknologi Pengolahan Hasil Pertanian) -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1521997888043-aa9c827744f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Teknologi Pengolahan Hasil Pertanian"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-600 text-white shadow-sm mb-2">
                                TPHP
                            </span>
                            <h4 class="text-xl font-bold text-white leading-tight">Teknologi Pengolahan Hasil Pertanian</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Mempelajari proses penanganan, pengolahan, pengawetan pascapanen, hingga pengemasan
                            produk-produk makanan dan minuman berbahan dasar pangan/pertanian.
                        </p>
                        <a href="#"
                            class="inline-flex items-center text-primary-600 font-bold hover:text-primary-800 text-sm">
                            Pelajari Lebih Lanjut <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Jurusan 4: TKJ (Teknik Komputer & Jaringan) -->
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Teknik Komputer & Jaringan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-500 text-white shadow-sm mb-2">
                                TKJ
                            </span>
                            <h4 class="text-xl font-bold text-white leading-tight">Teknik Komputer & Jaringan</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Mendalami perakitan hardware komputer, instalasi sistem operasi, pengembangan dan administrasi
                            jaringan komputer baik intranet lokal maupun internet skala luas.
                        </p>
                        <a href="#"
                            class="inline-flex items-center text-primary-600 font-bold hover:text-primary-800 text-sm">
                            Pelajari Lebih Lanjut <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Scroll Section -->
    <div class="bg-white py-16 overflow-hidden border-t border-gray-100" data-aos="fade-up">
        <div class="mb-12 text-center px-4">
            <h2 class="text-base text-primary-600 font-bold tracking-widest uppercase">Tenaga Pendidik</h2>
            <h3 class="text-3xl font-black text-gray-900 mt-2">Guru Hebat Kami</h3>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                Dibimbing oleh tim pengajar profesional dan berpengalaman di bidangnya masing-masing.
            </p>
        </div>

        <!-- Alpine Carousel Logic -->
        <div x-data="{
                                activeIndex: 0,
                                itemsCount: {{ count($teachers) }},
                                next() {
                                    this.activeIndex = (this.activeIndex + 1) % this.itemsCount;
                                },
                                prev() {
                                    this.activeIndex = (this.activeIndex - 1 + this.itemsCount) % this.itemsCount;
                                },
                                getStyle(index) {
                                    // Calculate shortest distance in a circular array
                                    let diff = index - this.activeIndex;

                                    // Adjust for wrapping around the ends
                                    if (diff > Math.floor(this.itemsCount / 2)) diff -= this.itemsCount;
                                    if (diff < -Math.floor(this.itemsCount / 2)) diff += this.itemsCount;

                                    const absDiff = Math.abs(diff);

                                    // Visual properties based on distance from center
                                    let translateX = diff * 120; // Base spacing
                                    let scale = 1;
                                    let zIndex = 30;
                                    let opacity = 1;

                                    if (absDiff === 0) {
                                        // Center item
                                        scale = 1.15;
                                        zIndex = 40;
                                    } else if (absDiff === 1) {
                                        // Immediate neighbors
                                        scale = 0.85;
                                        zIndex = 30;
                                        opacity = 0.8;
                                        translateX = diff * 130; 
                                    } else if (absDiff === 2) {
                                        // Next neighbors
                                        scale = 0.65;
                                        zIndex = 20;
                                        opacity = 0.5;
                                        translateX = diff * 110;
                                    } else {
                                        // Further items (hidden or very small)
                                        scale = 0.4;
                                        zIndex = 10;
                                        opacity = 0;
                                    }

                                    // Adjust positioning for smaller screens
                                    if (window.innerWidth < 768) {
                                        translateX = diff * 80;
                                    }

                                    return `
                                        transform: translateX(calc(-50% + ${translateX}px)) scale(${scale});
                                        z-index: ${zIndex};
                                        opacity: ${opacity};
                                    `;
                                }
                            }"
            class="relative w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 h-80 flex justify-center items-center">

            <div class="relative w-full h-full flex justify-center items-center">
                @foreach($teachers as $index => $teacher)
                    <div class="absolute top-1/2 left-1/2 -mt-32 w-48 md:w-56 flex flex-col items-center cursor-pointer transition-all duration-500 ease-out origin-center"
                        :style="getStyle({{ $index }})" @click="activeIndex = {{ $index }}">

                        <div class="relative w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 bg-white shadow-xl mb-4 transition-all duration-500"
                            :class="{ 'border-primary-500 shadow-primary-500/30': activeIndex === {{ $index }}, 'border-white': activeIndex !== {{ $index }} }">
                            <img src="{{ Str::startsWith($teacher->image, 'http') ? $teacher->image : asset('storage/' . $teacher->image) }}"
                                alt="{{ $teacher->name }}" class="w-full h-full object-cover relative z-10">
                            <div class="absolute inset-0 bg-primary-900/40 transition-opacity duration-500 z-20"
                                :class="{ 'opacity-0': activeIndex === {{ $index }}, 'opacity-100': activeIndex !== {{ $index }} }">
                            </div>
                        </div>

                        <!-- Content only fully visible if center -->
                        <div class="text-center transition-all duration-500"
                            :class="{ 'opacity-100 translate-y-0': activeIndex === {{ $index }}, 'opacity-0 translate-y-4': activeIndex !== {{ $index }} }">
                            <h4 class="text-xl font-black text-gray-900 leading-tight">{{ $teacher->name }}</h4>
                            <p class="text-sm text-primary-600 mt-1 font-bold tracking-wide uppercase">{{ $teacher->subject }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Controls -->
            <button @click="prev()"
                class="absolute left-2 md:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white border border-gray-200 shadow-lg flex items-center justify-center text-primary-600 hover:bg-primary-50 hover:scale-110 transition-all z-50 focus:outline-none focus:ring-4 focus:ring-primary-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button @click="next()"
                class="absolute right-2 md:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white border border-gray-200 shadow-lg flex items-center justify-center text-primary-600 hover:bg-primary-50 hover:scale-110 transition-all z-50 focus:outline-none focus:ring-4 focus:ring-primary-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Dot Navigation -->
        <div class="flex justify-center items-center mt-2 gap-2 pb-8"
            x-data="{ get actIndex() { return document.querySelector('[x-data]').__x.$data.activeIndex } }">
            @foreach($teachers as $index => $teacher)
                <button @click="activeIndex = {{ $index }}"
                    class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                    :class="activeIndex === {{ $index }} ? 'w-8 bg-primary-600 shadow-md transform scale-110' : 'w-2.5 bg-gray-300 hover:bg-gray-400'"></button>
            @endforeach
        </div>
    </div>

    <!-- Auto Slide Gallery Section -->
    <div class="bg-gray-50 py-10 overflow-hidden border-t border-b border-gray-100" data-aos="fade-up"
        x-data="{ lightboxOpen: false, lightboxSrc: '', lightboxTitle: '' }">
        <div class="mb-8 text-center px-4">
            <h2 class="text-base text-primary-600 font-bold tracking-widest uppercase">Dokumentasi Kegiatan</h2>
            <h3 class="text-3xl font-black text-gray-900 mt-2">Galeri SMK</h3>
        </div>

        <div class="relative w-full overflow-hidden flex items-center">
            <!-- Left fade gradient -->
            <div
                class="absolute left-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-r from-gray-50 to-transparent z-10 pointer-events-none">
            </div>

            <div class="gallery-track">
                <!-- Gallery Items Group 1 -->
                @forelse($galleries as $gallery)
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = '{{ asset('storage/' . $gallery->image) }}'; lightboxTitle = '{{ addslashes($gallery->title) }}'">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-white mb-3 transform scale-75 group-hover:scale-100 transition-transform duration-300 drop-shadow-lg"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span
                                class="text-white font-bold text-base text-center px-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 drop-shadow">{{ $gallery->title }}</span>
                        </div>
                    </div>
                @empty
                    <!-- Dummy Images if no galleries exist -->
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=800&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1511629091441-ee46146481b6?w=800&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1510531704581-5b28709ec685?w=800&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1510531704581-5b28709ec685?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                @endforelse

                <!-- Duplicate Items for Seamless Loop (Group 2) - no lightbox on duplicates -->
                @forelse($galleries as $gallery)
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = '{{ asset('storage/' . $gallery->image) }}'; lightboxTitle = '{{ addslashes($gallery->title) }}'">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-white mb-3 transform scale-75 group-hover:scale-100 transition-transform duration-300 drop-shadow-lg"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            <span
                                class="text-white font-bold text-base text-center px-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 drop-shadow">{{ $gallery->title }}</span>
                        </div>
                    </div>
                @empty
                    <!-- Duplicate Dummy Images -->
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=1200&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=1200&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1511629091441-ee46146481b6?w=1200&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="w-64 md:w-80 h-48 md:h-64 flex-shrink-0 mx-2 md:mx-4 rounded-xl overflow-hidden shadow-md group relative cursor-pointer"
                        aria-hidden="true"
                        @click="lightboxOpen = true; lightboxSrc = 'https://images.unsplash.com/photo-1510531704581-5b28709ec685?w=1200&q=80'; lightboxTitle = 'Kegiatan Sekolah'">
                        <img src="https://images.unsplash.com/photo-1510531704581-5b28709ec685?w=800&q=80" alt="Kegiatan"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Right fade gradient -->
            <div
                class="absolute right-0 top-0 bottom-0 w-16 md:w-32 bg-gradient-to-l from-gray-50 to-transparent z-10 pointer-events-none">
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('galleries') }}"
                class="inline-flex items-center text-primary-600 font-bold hover:text-primary-800 group">
                Lihat Semua Galeri
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/85 backdrop-blur-sm p-4"
            @click.self="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false" style="display: none;">
            <div class="relative max-w-4xl max-h-[90vh] w-full" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                <!-- Close button -->
                <button @click="lightboxOpen = false"
                    class="fixed top-6 right-6 z-[10000] bg-white/10 hover:bg-white/20 p-2 rounded-full text-white backdrop-blur-md transition flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <!-- Image -->
                <img :src="lightboxSrc" :alt="lightboxTitle"
                    class="w-full h-auto max-h-[80vh] object-contain rounded-xl shadow-2xl">
                <!-- Caption -->
                <div x-show="lightboxTitle" class="mt-4 text-center text-white font-semibold text-lg drop-shadow"
                    x-text="lightboxTitle"></div>
            </div>
        </div>
    </div>

    <!-- Latest News Section -->
    <div class="bg-white py-16 overflow-hidden">
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
                    <div class="flex flex-col rounded-2xl shadow-lg border border-gray-100 overflow-hidden bg-white hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('post', $post->slug) }}" class="block relative group overflow-hidden">
                            <div class="flex-shrink-0 h-56 bg-gray-200 overflow-hidden">
                                @if($post->image)
                                    <img class="h-full w-full object-cover group-hover:scale-110 transition duration-700 ease-in-out"
                                        src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                @else
                                    <div
                                        class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400 group-hover:scale-110 transition duration-700">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary-600 shadow-sm">
                                Berita
                            </div>
                        </a>

                        <div class="flex-1 bg-white p-6 md:p-8 flex flex-col justify-between">
                            <div class="flex-1">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                        {{ $post->created_at->format('d M Y') }}
                                    </time>
                                </div>
                                <a href="{{ route('post', $post->slug) }}" class="block">
                                    <h3
                                        class="text-xl font-bold text-gray-900 hover:text-primary-600 transition duration-200 line-clamp-2">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="mt-3 text-base text-gray-600 line-clamp-3">
                                        {{ Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900 flex items-center">
                                    <span
                                        class="h-6 w-6 rounded-full bg-gradient-to-tr from-primary-500 to-primary-500 flex items-center justify-center text-white text-xs mr-2">A</span>
                                    Admin
                                </span>
                                <a href="{{ route('post', $post->slug) }}"
                                    class="text-primary-600 hover:text-primary-800 text-sm font-semibold transition flex items-center">
                                    Baca <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 bg-white rounded-2xl border border-gray-100 shadow-sm"
                        data-aos="fade-in">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Belum ada publikasi berita terbaru.
                    </div>
                @endforelse
            </div>

            <div class="mt-16 text-center" data-aos="fade-up">
                <a href="{{ route('posts') }}"
                    class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-primary-600 text-base font-bold text-primary-600 rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300">
                    Jelajahi Semua Berita
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Custom Blob Animation */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
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