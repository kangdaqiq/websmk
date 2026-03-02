<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Berita</label>
                            <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Konten</label>
                            <textarea name="content" rows="6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Cover (Opsional)</label>
                            @if($post->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Cover" class="w-32 h-auto rounded">
                                </div>
                            @endif
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition" type="submit">
                                Update Berita
                            </button>
                            <a href="{{ route('admin.posts.index') }}" class="text-gray-500 hover:text-gray-800 transition">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
