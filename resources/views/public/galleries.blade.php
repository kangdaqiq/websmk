@extends('layouts.public')
@section('title', 'Galeri Foto')

@section('content')
<div class="bg-gray-50 py-12 min-h-[70vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Galeri Foto Kegiatan
            </h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Dokumentasi berbagai momen berharga dan aktivitas di sekolah.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galleries as $gallery)
                <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="aspect-w-4 aspect-h-3 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500 ease-in-out cursor-pointer" onclick="openModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->description }}')">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 truncate" title="{{ $gallery->title }}">{{ $gallery->title }}</h3>
                        @if($gallery->description)
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2" title="{{ $gallery->description }}">{{ $gallery->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-lg shadow">
                    Belum ada foto di galeri.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="galleryModal" class="fixed inset-0 z-[100] hidden bg-black bg-opacity-90 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0" aria-modal="true" role="dialog">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    
    <div class="max-w-5xl w-full flex flex-col items-center">
        <img id="modalImage" src="" alt="Zoomed Image" class="max-h-[80vh] w-auto object-contain rounded-md shadow-2xl mb-4">
        <div class="text-center text-white">
            <h4 id="modalTitle" class="text-2xl font-bold mb-2"></h4>
            <p id="modalDesc" class="text-gray-300 max-w-2xl mx-auto"></p>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');

    function openModal(imageSrc, title, desc) {
        modalImage.src = imageSrc;
        modalTitle.innerText = title;
        modalDesc.innerText = desc || '';
        
        modal.classList.remove('hidden');
        // trigger animation
        setTimeout(() => {
            modal.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modalImage.src = '';
        }, 300);
        document.body.style.overflow = 'auto';
    }

    // Close on click outside image
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
@endsection
