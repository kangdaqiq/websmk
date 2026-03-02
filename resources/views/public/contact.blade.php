@extends('layouts.public')
@section('title', 'Kontak')

@section('content')
<div class="bg-gray-50 py-16 sm:py-24 min-h-[70vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl lg:text-5xl">
                Hubungi Kami
            </h1>
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto">
                Kami siap membantu Anda. Silakan hubungi kami melalui kontak di bawah ini.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                
                <!-- Contact Info -->
                <div class="bg-primary-600 py-12 px-8 sm:px-12 text-white flex flex-col justify-center">
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    <p class="text-primary-100 mb-8">
                        Jangan ragu untuk menghubungi {{ $settings['school_name'] ?? 'Sekolah Kita' }} untuk pertanyaan terkait penerimaan siswa, kerja sama, maupun informasi lainnya.
                    </p>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-primary-200 mt-1 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-lg">{{ $settings['school_address'] ?? 'Jalan Raya Pendidikan No. 1, Kota Impian' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-primary-200 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-lg">{{ $settings['school_phone'] ?? '(021) 12345678' }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-primary-200 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-lg">{{ $settings['school_email'] ?? 'info@sekolahkita.sch.id' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Form Placeholder -->
                <div class="py-12 px-8 sm:px-12 flex flex-col justify-center bg-white">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Fitur kirim pesan akan tersedia segera!');">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="email@contoh.com">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Pesan</label>
                            <textarea rows="4" class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                                Kirim Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
