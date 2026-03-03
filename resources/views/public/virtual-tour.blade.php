@extends('layouts.public')
@section('title', 'Virtual Tour')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <style>
        /* ===== VIEWER ===== */
        #panorama {
            width: 100%;
            height: 65vh;
            min-height: 400px;
            border-radius: 1.5rem;
            overflow: hidden;
            background: #0f172a;
        }

        /* ===== ROOM CARDS ===== */
        .room-card {
            cursor: pointer;
            transition: all .25s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .room-card:hover {
            transform: translateY(-4px);
            border-color: var(--tw-ring-color, #4f46e5);
        }

        .room-card.active {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, .25);
        }

        .room-card.locked {
            cursor: not-allowed;
        }

        .room-card .badge-coming {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(4px);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 9999px;
            letter-spacing: .05em;
        }

        /* ===== LOADING OVERLAY ===== */
        #tour-loading {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .85);
            backdrop-filter: blur(6px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 1.5rem;
            color: #fff;
            z-index: 10;
            transition: opacity .4s ease;
        }

        #tour-loading.hidden {
            display: none;
        }

        /* scrollbar kategori */
        .category-filter::-webkit-scrollbar {
            height: 4px;
        }

        .category-filter::-webkit-scrollbar-thumb {
            background: #c7d2fe;
            border-radius: 9999px;
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen">

        {{-- HERO --}}
        <div class="bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 text-white py-16 px-4">
            <div class="max-w-7xl mx-auto text-center">
                <span
                    class="inline-block bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-widest px-4 py-1 rounded-full mb-4 backdrop-blur-sm">
                    360° Virtual Tour
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
                    Jelajahi {{ $settings['school_name'] ?? 'Sekolah Kami' }}
                </h1>
                <p class="text-indigo-200 text-lg max-w-xl mx-auto">
                    Keliling lingkungan sekolah dari mana saja. Klik ruangan untuk memulai tur virtual.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- ===== VIEWER ===== --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl p-4">

                        {{-- Info bar --}}
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h2 id="viewer-title" class="text-xl font-bold text-gray-900">Pilih Ruangan</h2>
                                <p id="viewer-cat" class="text-sm text-indigo-600 font-medium">—</p>
                            </div>
                            <div class="flex gap-2 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 00-2 2v4a2 2 0 002 2h9a2 2 0 002-2v-4a2 2 0 00-2-2H3z" />
                                    </svg>
                                    Drag untuk memutar
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Scroll untuk zoom
                                </span>
                            </div>
                        </div>

                        {{-- Viewer --}}
                        <div class="relative">
                            <div id="tour-loading">
                                <svg class="animate-spin w-10 h-10 text-indigo-400 mb-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                </svg>
                                <p id="loading-text" class="text-sm text-gray-300">Pilih ruangan di panel kanan untuk memulai tour</p>
                            </div>
                            <div id="panorama"></div>
                        </div>

                        {{-- Navigation arrows antar ruangan --}}
                        <div class="flex items-center justify-between mt-3">
                            <button id="btn-prev"
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition disabled:opacity-30 disabled:cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Sebelumnya
                            </button>
                            <span id="room-counter" class="text-xs text-gray-400"></span>
                            <button id="btn-next"
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition disabled:opacity-30 disabled:cursor-not-allowed">
                                Berikutnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ===== ROOM LIST ===== --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-4 h-full">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">📍 Daftar Ruangan</h3>

                        {{-- Category filter --}}
                        <div class="category-filter flex gap-2 overflow-x-auto pb-2 mb-4">
                            <button onclick="filterCategory('all')" id="cat-all"
                                class="cat-btn active flex-shrink-0 px-3 py-1 text-xs font-bold rounded-full bg-indigo-600 text-white transition">
                                Semua
                            </button>
                            @foreach(collect($rooms)->pluck('category')->unique() as $cat)
                                <button onclick="filterCategory('{{ $cat }}')" id="cat-{{ Str::slug($cat) }}"
                                    class="cat-btn flex-shrink-0 px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-700 transition">
                                    {{ $cat }}
                                </button>
                            @endforeach
                        </div>

                        {{-- Room cards - badge dan state dikelola JS --}}
                        <div class="space-y-3 overflow-y-auto max-h-[55vh] pr-1" id="room-list">
                            @foreach($rooms as $i => $room)
                                <div class="room-card bg-gray-50 rounded-xl p-3 flex items-center gap-3"
                                    id="card-{{ $room['id'] }}" data-id="{{ $room['id'] }}" data-index="{{ $i }}"
                                    data-category="{{ $room['category'] }}" data-title="{{ $room['title'] }}"
                                    data-image="{{ $room['image'] }}" data-available="false" onclick="selectRoom(this)">

                                    {{-- Thumb --}}
                                    <div id="thumb-{{ $room['id'] }}"
                                        class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-indigo-100 flex items-center justify-center">
                                        {{-- diisi JS --}}
                                        <svg class="w-6 h-6 text-indigo-200 animate-pulse" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 00-2 2v4a2 2 0 002 2h9a2 2 0 002-2v-4a2 2 0 00-2-2H3z" />
                                        </svg>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-sm text-gray-900 truncate">{{ $room['title'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $room['category'] }}</p>
                                    </div>

                                    <div id="badge-{{ $room['id'] }}" class="flex-shrink-0">
                                        {{-- Badge diupdate JS --}}
                                        <span
                                            class="text-xs font-bold text-gray-300 bg-gray-100 px-2 py-0.5 rounded-full">Checking...</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>{{-- /grid --}}
        </div>{{-- /container --}}
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script>
        // ======= DATA =======
        const rooms = @json($rooms);
        let viewer = null;
        let activeIdx = null;

        // ======= CEK GAMBAR VIA JS (tidak pakai file_exists PHP) =======
        function checkImage(url) {
            return new Promise(resolve => {
                const img = new Image();
                img.onload = () => resolve(true);
                img.onerror = () => resolve(false);
                img.src = url + '?_t=' + Date.now(); // bypass cache
            });
        }

        async function initRooms() {
            for (const room of rooms) {
                const exists = await checkImage(room.image);
                const card = document.getElementById('card-' + room.id);
                const badge = document.getElementById('badge-' + room.id);
                const thumb = document.getElementById('thumb-' + room.id);

                if (exists) {
                    room.available = true;
                    card.dataset.available = 'true';
                    card.style.cursor = 'pointer';

                    // Badge Live
                    badge.innerHTML = `<span class="inline-flex items-center gap-1 text-xs font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Live
                    </span>`;

                    // Thumbnail
                    thumb.innerHTML = `<img src="${room.image}" alt="${room.title}" class="w-full h-full object-cover">`;
                } else {
                    room.available = false;
                    card.dataset.available = 'false';
                    card.style.cursor = 'not-allowed';

                    // Badge Segera
                    badge.innerHTML = `<span class="text-xs font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">Segera</span>`;
                }
            }

            // Auto-open ruangan pertama yang tersedia
            const firstAvailable = document.querySelector('.room-card[data-available="true"]');
            if (firstAvailable) selectRoom(firstAvailable);
        }

        // ======= SELECT ROOM =======
        function selectRoom(el) {
            if (el.dataset.available !== 'true') return;

            const idx = parseInt(el.dataset.index);
            const image = el.dataset.image;
            const title = el.dataset.title;
            const cat = el.dataset.category;

            document.querySelectorAll('.room-card').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            activeIdx = idx;

            document.getElementById('viewer-title').textContent = title;
            document.getElementById('viewer-cat').textContent   = cat;

            const loading = document.getElementById('tour-loading');
            const loadingText = document.getElementById('loading-text');
            loading.style.display = 'flex';
            loadingText.textContent = 'Memuat panorama...';

            if (viewer) { viewer.destroy(); viewer = null; }

            // Timeout fallback: sembunyikan overlay setelah 10 detik
            const hideLoading = () => { loading.style.display = 'none'; };
            const fallback = setTimeout(hideLoading, 10000);

            viewer = pannellum.viewer('panorama', {
                type              : 'equirectangular',
                panorama          : image,
                autoLoad          : true,
                autoRotate        : -2,
                compass           : false,
                showZoomCtrl      : true,
                showFullscreenCtrl: true,
                hfov              : 110,
                onLoad: function () {
                    clearTimeout(fallback);
                    hideLoading();
                }
            });

            updateNav();
        }

        // ======= NAV PREV / NEXT =======
        function findNext(from, dir) {
            let idx = from;
            for (let i = 0; i < rooms.length; i++) {
                idx = (idx + dir + rooms.length) % rooms.length;
                if (rooms[idx].available) return idx;
            }
            return null;
        }

        function updateNav() {
            const prev = document.getElementById('btn-prev');
            const next = document.getElementById('btn-next');
            const ctr = document.getElementById('room-counter');

            const availableRooms = rooms.filter(r => r.available);
            const pos = availableRooms.findIndex(r => r.id === rooms[activeIdx].id);

            prev.disabled = findNext(activeIdx, -1) === null;
            next.disabled = findNext(activeIdx, 1) === null;
            ctr.textContent = availableRooms.length ? `${pos + 1} / ${availableRooms.length} ruangan` : '';
        }

        document.getElementById('btn-prev').addEventListener('click', () => {
            if (activeIdx === null) return;
            const idx = findNext(activeIdx, -1);
            if (idx !== null) selectRoom(document.querySelector(`[data-index="${idx}"]`));
        });
        document.getElementById('btn-next').addEventListener('click', () => {
            if (activeIdx === null) return;
            const idx = findNext(activeIdx, 1);
            if (idx !== null) selectRoom(document.querySelector(`[data-index="${idx}"]`));
        });

        // ======= CATEGORY FILTER =======
        function filterCategory(cat) {
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove('bg-indigo-600', 'text-white');
                b.classList.add('bg-gray-100', 'text-gray-600');
            });
            const active = document.getElementById(cat === 'all' ? 'cat-all' : 'cat-' + cat.toLowerCase().replace(/\s+/g, '-'));
            if (active) {
                active.classList.remove('bg-gray-100', 'text-gray-600');
                active.classList.add('bg-indigo-600', 'text-white');
            }
            document.querySelectorAll('.room-card').forEach(card => {
                card.parentElement.style.display = (cat === 'all' || card.dataset.category === cat) ? '' : 'none';
            });
        }

        // ======= INIT =======
        window.addEventListener('DOMContentLoaded', initRooms);
    </script>
@endpush