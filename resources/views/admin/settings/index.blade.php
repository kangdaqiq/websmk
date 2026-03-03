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
                            <input type="text" name="school_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required value="{{ old('school_name', $settings['school_name'] ?? 'SMK Hebat') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                            <textarea name="school_address" rows="2"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('school_address', $settings['school_address'] ?? 'Jl. Pendidikan No. 1') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Telepon</label>
                            <input type="text" name="school_phone"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                                value="{{ old('school_phone', $settings['school_phone'] ?? '(021) 1234567') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="school_email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                                value="{{ old('school_email', $settings['school_email'] ?? 'info@smkhebat.sch.id') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Visi & Misi Ringkas</label>
                            <textarea name="school_visi_misi" rows="4"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('school_visi_misi', $settings['school_visi_misi'] ?? 'Menjadi sekolah terbaik dan mencetak lulusan kompeten.') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Hero Welcome Text
                                (Beranda)</label>
                            <textarea name="hero_text" rows="2"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('hero_text', $settings['hero_text'] ?? 'Selamat Datang di Website Resmi Sekolah Kami, wadah kreativitas dan inovasi generasi bangsa!') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Google Maps Embed URL
                                (Footer)</label>
                            <input type="url" name="maps_embed_url"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('maps_embed_url', $settings['maps_embed_url'] ?? '') }}"
                                placeholder="https://www.google.com/maps/embed?pb=...">
                            <p class="text-xs text-gray-400 mt-1">Google Maps → Share → Embed a map → salin URL dari
                                atribut <code>src</code> pada iframe.</p>
                        </div>

                        <div class="mb-6 border-t border-gray-100 pt-5">
                            <h3 class="text-gray-800 font-bold text-base mb-4">📱 Media Sosial</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">WhatsApp (link
                                        wa.me)</label>
                                    <input type="url" name="social_wa"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('social_wa', $settings['social_wa'] ?? '') }}"
                                        placeholder="https://wa.me/6281234567890">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Instagram</label>
                                    <input type="url" name="social_ig"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('social_ig', $settings['social_ig'] ?? '') }}"
                                        placeholder="https://instagram.com/username">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Facebook</label>
                                    <input type="url" name="social_fb"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('social_fb', $settings['social_fb'] ?? '') }}"
                                        placeholder="https://facebook.com/pagename">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">YouTube</label>
                                    <input type="url" name="social_yt"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('social_yt', $settings['social_yt'] ?? '') }}"
                                        placeholder="https://youtube.com/@channel">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">TikTok</label>
                                    <input type="url" name="social_tiktok"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}"
                                        placeholder="https://tiktok.com/@username">
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 border-t border-gray-100 pt-5">
                            <h3 class="text-gray-800 font-bold text-base mb-4">🎓 Sambutan Kepala Sekolah</h3>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kepala Sekolah</label>
                                <input type="text" name="principal_name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    value="{{ old('principal_name', $settings['principal_name'] ?? '') }}"
                                    placeholder="Contoh: Drs. Ahmad Suryadi, M.Pd.">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Teks Sambutan</label>
                                <textarea name="principal_greeting" id="principal_greeting" rows="8"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('principal_greeting', $settings['principal_greeting'] ?? '') }}</textarea>
                                <p class="text-xs text-gray-400 mt-1">Anda bisa memformat teks menggunakan editor di
                                    bawah.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition"
                                type="submit">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- TinyMCE for principal greeting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#principal_greeting',
            plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table help wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | removeformat | code fullscreen',
            height: 350,
            promotion: false,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    </script>
</x-app-layout>