@extends('layouts.public')
@section('title', 'Virtual Tour 360°')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
<style>
    /* ===== FULL SCREEN VIEWER ===== */
    #panorama {
        width: 100%;
        height: 80vh;
        min-height: 500px;
        border-radius: 1rem;
        overflow: hidden;
        background: #0f172a;
        position: relative;
    }

    /* Loading overlay */
    #tour-loading {
        position: absolute; inset: 0;
        background: rgba(15,23,42,.9);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        border-radius: 1rem;
        color: #fff; z-index: 20;
    }

    /* ===== INFO OVERLAY (bottom-left) ===== */
    #scene-info {
        position: absolute; bottom: 1.25rem; left: 1.25rem;
        background: rgba(15,23,42,.75);
        backdrop-filter: blur(10px);
        color: #fff; padding: .6rem 1.1rem;
        border-radius: .75rem; z-index: 15;
        border: 1px solid rgba(255,255,255,.12);
        pointer-events: none;
    }
    #scene-info h3 { font-size: 1rem; font-weight: 700; margin: 0 0 .1rem; }
    #scene-info p  { font-size: .7rem; margin: 0; opacity: .7; }

    /* ===== DEBUG PANEL ===== */
    #debug-panel {
        position: absolute; top: 1rem; right: 1rem;
        background: rgba(15,23,42,.85);
        backdrop-filter: blur(10px);
        color: #a5f3fc; padding: .6rem 1rem;
        border-radius: .75rem; z-index: 20;
        font-family: monospace; font-size: .78rem;
        border: 1px solid rgba(99,252,241,.3);
        display: none;
    }
    #debug-panel.on { display: block; }
    #debug-panel strong { color: #fff; }

    /* ===== MINI-MAP / ROOM LIST ===== */
    .scene-btn {
        cursor: pointer;
        transition: all .2s ease;
        border: 2px solid transparent;
    }
    .scene-btn:hover  { border-color: #818cf8; transform: translateY(-2px); }
    .scene-btn.active { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.3); }
    .scene-btn.unavailable { cursor: not-allowed; opacity: .5; }

    /* Pannellum hotspot custom style */
    .pnlm-hotspot.pnlm-scene {
        background: rgba(99,102,241,.85) !important;
        border: 3px solid #fff !important;
        width: 36px !important; height: 36px !important;
        border-radius: 50% !important;
        box-shadow: 0 0 0 4px rgba(99,102,241,.35) !important;
        transition: transform .2s ease !important;
    }
    .pnlm-hotspot.pnlm-scene:hover { transform: scale(1.2) !important; }
    .pnlm-hotspot-base.pnlm-scene span {
        background: rgba(15,23,42,.9) !important;
        color: #fff !important;
        font-weight: 600 !important;
        border-radius: .4rem !important;
        font-size: .75rem !important;
        padding: .2rem .5rem !important;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen">

    {{-- HERO --}}
    <div class="bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 text-white py-10 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <span class="inline-block bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-widest px-4 py-1 rounded-full mb-3 backdrop-blur-sm">
                🌐 360° Virtual Tour
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">
                Jelajahi {{ $settings['school_name'] ?? 'Sekolah Kami' }}
            </h1>
            <p class="text-indigo-200 text-base max-w-xl mx-auto">
                Klik <strong>panah biru</strong> di dalam viewer untuk berpindah ruangan, seperti Google Street View.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- VIEWER AREA --}}
        <div class="bg-white rounded-2xl shadow-xl p-4 mb-6">

            {{-- Toolbar --}}
            <div class="flex items-center justify-between mb-3 flex-wrap gap-2">
                <div>
                    <h2 id="viewer-title" class="text-xl font-bold text-gray-900">Halaman Depan (1)</h2>
                    <p  id="viewer-cat"   class="text-sm text-indigo-500 font-medium">Halaman Depan</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-400 hidden md:block">Drag untuk memutar · Scroll untuk zoom</span>
                    {{-- Toggle debug --}}
                    <button id="btn-debug" onclick="toggleDebug()"
                        class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 hover:bg-indigo-100 text-gray-600 hover:text-indigo-700 transition border border-gray-200">
                        📐 Koordinat
                    </button>
                    {{-- Fullscreen --}}
                    <button onclick="document.getElementById('panorama').requestFullscreen()"
                        class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 hover:bg-indigo-100 text-gray-600 hover:text-indigo-700 transition border border-gray-200">
                        ⛶ Layar Penuh
                    </button>
                </div>
            </div>

            {{-- Panorama viewer --}}
            <div class="relative">
                {{-- Loading overlay --}}
                <div id="tour-loading">
                    <svg class="animate-spin w-10 h-10 text-indigo-400 mb-3" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <p id="loading-text" class="text-sm text-gray-300">Memuat panorama...</p>
                </div>

                {{-- Debug panel --}}
                <div id="debug-panel">
                    <div class="mb-1"><strong>🛠 Mode Debug Koordinat</strong></div>
                    Pitch: <strong id="dbg-pitch">—</strong><br>
                    Yaw:   <strong id="dbg-yaw">—</strong><br>
                    <span class="text-xs opacity-60 mt-1 block">Arahkan mouse ke posisi<br>yang ingin dijadikan hotspot</span>
                </div>

                {{-- Scene info --}}
                <div id="scene-info">
                    <h3 id="info-title">Halaman Depan (1)</h3>
                    <p  id="info-cat">Halaman Depan</p>
                </div>

                <div id="panorama"></div>
            </div>
        </div>

        {{-- MINI-MAP: daftar scene --}}
        <div class="bg-white rounded-2xl shadow-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-gray-900">📍 Peta Lokasi</h3>
                <span class="text-xs text-gray-400">Klik untuk lompat ke lokasi</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-3" id="scene-map">
                @foreach($rooms as $i => $room)
                <div class="scene-btn unavailable bg-gray-50 rounded-xl p-2 text-center"
                     id="scene-btn-{{ $room['id'] }}"
                     data-id="{{ $room['id'] }}"
                     data-title="{{ $room['title'] }}"
                     data-cat="{{ $room['category'] }}"
                     onclick="goToScene('{{ $room['id'] }}')">
                    <div id="scene-thumb-{{ $room['id'] }}"
                        class="w-full aspect-video rounded-lg overflow-hidden bg-indigo-100 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-indigo-200 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 00-2 2v4a2 2 0 002 2h9a2 2 0 002-2v-4a2 2 0 00-2-2H3z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-gray-700 leading-tight">{{ $room['title'] }}</p>
                    <span id="scene-badge-{{ $room['id'] }}" class="text-xs text-gray-300">•••</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- PANDUAN HOTSPOT --}}
        <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-2xl p-5">
            <h4 class="font-bold text-indigo-800 mb-2">🧭 Cara Menambah Hotspot (Penghubung antar Ruangan)</h4>
            <ol class="text-sm text-indigo-700 space-y-1 list-decimal list-inside">
                <li>Aktifkan <strong>Mode Koordinat</strong> (tombol kanan atas viewer)</li>
                <li>Arahkan mouse ke posisi <em>pintu/jalur</em> ke ruangan berikutnya</li>
                <li>Catat nilai <strong>Pitch</strong> dan <strong>Yaw</strong> yang muncul</li>
                <li>Sampaikan ke developer → hotspot akan ditambahkan di kode</li>
            </ol>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
// =====================================================================
// KONFIGURASI SCENES & HOTSPOT
// Hotspot: { targetScene, pitch, yaw, label }
// Tambah/edit hotspot di sini setelah mendapat koordinat dari Mode Debug
// =====================================================================
const SCENES = @json($rooms);

// Hotspot connections — isi setelah cek koordinat dengan mode debug
const HOTSPOTS = {
    'halaman-1': [
        { targetScene: 'halaman-2', pitch: -1.76, yaw: 4.74, label: '→ Halaman 2' },
    ],
    'halaman-2': [
        { targetScene: 'halaman-3', pitch: 0.20, yaw: -3.39, label: '→ Halaman 3' },
    ],
};

// =====================================================================
let viewer       = null;
let currentScene = null;
let debugMode    = false;

// ===== CEK GAMBAR VIA JS =====
function checkImage(url) {
    return new Promise(resolve => {
        const img   = new Image();
        img.onload  = () => resolve(true);
        img.onerror = () => resolve(false);
        img.src = url + '?_nc=' + Date.now();
    });
}

// ===== INIT: cek semua scene =====
async function initScenes() {
    for (const room of SCENES) {
        const exists = await checkImage(room.image);
        const btn    = document.getElementById('scene-btn-'   + room.id);
        const badge  = document.getElementById('scene-badge-' + room.id);
        const thumb  = document.getElementById('scene-thumb-' + room.id);

        if (exists) {
            room.available = true;
            btn.classList.remove('unavailable');
            badge.textContent = '● Live';
            badge.className   = 'text-xs text-green-500 font-bold';
            thumb.innerHTML   = `<img src="${room.image}" class="w-full h-full object-cover">`;
        } else {
            room.available = false;
            badge.textContent = 'Segera';
            badge.className   = 'text-xs text-gray-400';
        }
    }

    // Load scene pertama yang tersedia
    const first = SCENES.find(r => r.available);
    if (first) loadScene(first.id);
    else {
        document.getElementById('loading-text').textContent = 'Belum ada foto 360° tersedia.';
    }
}

// ===== LOAD SCENE =====
function loadScene(sceneId) {
    const room = SCENES.find(r => r.id === sceneId);
    if (!room || !room.available) return;

    currentScene = sceneId;

    // Update info
    document.getElementById('viewer-title').textContent = room.title;
    document.getElementById('viewer-cat').textContent   = room.category;
    document.getElementById('info-title').textContent   = room.title;
    document.getElementById('info-cat').textContent     = room.category;

    // Show loading
    document.getElementById('tour-loading').style.display = 'flex';
    document.getElementById('loading-text').textContent   = 'Memuat ' + room.title + '...';

    // Highlight mini-map
    document.querySelectorAll('.scene-btn').forEach(b => b.classList.remove('active'));
    const activeBtn = document.getElementById('scene-btn-' + sceneId);
    if (activeBtn) activeBtn.classList.add('active');

    // Build hotspots for this scene
    const hotspots = (HOTSPOTS[sceneId] || []).map(h => ({
        pitch    : h.pitch,
        yaw      : h.yaw,
        type     : 'scene',
        text     : h.label,
        sceneId  : h.targetScene,
        cssClass : 'pnlm-scene',
        clickHandlerFunc: (evt, args) => loadScene(args.sceneId),
        clickHandlerArgs: { sceneId: h.targetScene },
    }));

    // Destroy old viewer
    if (viewer) { viewer.destroy(); viewer = null; }

    const fallback = setTimeout(() => {
        document.getElementById('tour-loading').style.display = 'none';
    }, 12000);

    viewer = pannellum.viewer('panorama', {
        type              : 'equirectangular',
        panorama          : room.image,
        autoLoad          : true,
        autoRotate        : -2,
        compass           : false,
        showZoomCtrl      : true,
        showFullscreenCtrl: true,
        hfov              : 110,
        hotSpots          : hotspots,
        onLoad: () => {
            clearTimeout(fallback);
            document.getElementById('tour-loading').style.display = 'none';

            // Debug: track mouse position
            if (debugMode) attachDebug();
        },
    });
}

// ===== TOMBOL MINI-MAP =====
function goToScene(id) {
    const room = SCENES.find(r => r.id === id);
    if (room && room.available) loadScene(id);
}

// ===== DEBUG MODE =====
function toggleDebug() {
    debugMode = !debugMode;
    const panel = document.getElementById('debug-panel');
    const btn   = document.getElementById('btn-debug');
    if (debugMode) {
        panel.classList.add('on');
        btn.classList.add('bg-indigo-600', 'text-white');
        btn.classList.remove('bg-gray-100', 'text-gray-600');
        if (viewer) attachDebug();
    } else {
        panel.classList.remove('on');
        btn.classList.remove('bg-indigo-600', 'text-white');
        btn.classList.add('bg-gray-100', 'text-gray-600');
    }
}

function attachDebug() {
    const container = document.getElementById('panorama');
    if (!container || !viewer) return;

    // Hapus listener lama dulu
    if (window._debugHandler) {
        container.removeEventListener('mousemove', window._debugHandler);
    }

    window._debugHandler = function(e) {
        if (!viewer || !debugMode) return;
        try {
            const coords = viewer.mouseEventToCoords(e);
            if (coords && coords.length === 2) {
                document.getElementById('dbg-pitch').textContent = coords[0].toFixed(2) + '°';
                document.getElementById('dbg-yaw').textContent   = coords[1].toFixed(2) + '°';
            }
        } catch(err) {
            // Fallback: hitung manual dari posisi mouse dan viewport
            const rect = container.getBoundingClientRect();
            const mx   = e.clientX - rect.left;
            const my   = e.clientY - rect.top;
            const yawOff   = ((mx / rect.width)  - 0.5) * viewer.getHfov();
            const pitchOff = ((my / rect.height) - 0.5) * -viewer.getHfov() * (rect.height / rect.width);
            const pitch = viewer.getPitch() + pitchOff;
            const yaw   = viewer.getYaw()   + yawOff;
            document.getElementById('dbg-pitch').textContent = pitch.toFixed(2) + '°';
            document.getElementById('dbg-yaw').textContent   = yaw.toFixed(2)   + '°';
        }
    };

    container.addEventListener('mousemove', window._debugHandler);
}

// ===== INIT =====
window.addEventListener('DOMContentLoaded', initScenes);
</script>
@endpush