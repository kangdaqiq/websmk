<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Daftar Foto</h3>
                        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            + Tambah Foto
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($galleries as $gallery)
                            <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-lg transition">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-40 object-cover rounded-md mb-4">
                                <h4 class="font-bold text-gray-800 truncate" title="{{ $gallery->title }}">{{ $gallery->title }}</h4>
                                <p class="text-sm text-gray-500 mb-4 truncate">{{ $gallery->description ?? 'Tidak ada deskripsi' }}</p>
                                
                                <div class="flex justify-between border-t pt-3">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-6 text-gray-500 border rounded bg-gray-50">
                                Belum ada foto di galeri.
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-6">
                        {{ $galleries->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
