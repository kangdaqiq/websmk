<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Website Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Sekolah</label>
                            <input type="text" name="school_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ old('school_name', $settings['school_name'] ?? 'SMK Hebat') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                            <textarea name="school_address" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('school_address', $settings['school_address'] ?? 'Jl. Pendidikan No. 1') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Telepon</label>
                            <input type="text" name="school_phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ old('school_phone', $settings['school_phone'] ?? '(021) 1234567') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="school_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ old('school_email', $settings['school_email'] ?? 'info@smkhebat.sch.id') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Visi & Misi Ringkas</label>
                            <textarea name="school_visi_misi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('school_visi_misi', $settings['school_visi_misi'] ?? 'Menjadi sekolah terbaik dan mencetak lulusan kompeten.') }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Welcome Text (Beranda)</label>
                            <textarea name="hero_text" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('hero_text', $settings['hero_text'] ?? 'Selamat Datang di Website Resmi Sekolah Kami, wadah kreativitas dan inovasi generasi bangsa!') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition" type="submit">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
