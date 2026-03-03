@extends('layouts.public')
@section('title', 'Virtual Tour 360°')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <style>
        #panorama {
            width: 100%;
            height: 80vh;
            min-height: 500px;
            border-radius: 1rem;
            overflow: hidden;
            background: #0f172a;
        }
        #tour-loading {
            position: absolute; inset: 0;
            background: rgba(15,23,42,.9);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            border-radius: 1rem;
            color: #fff; z-index: 20;
        }
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
        .scene-btn { cursor: pointer; transition: all .2s ease; border: 2px solid transparent; }
        .scene-btn:hover  { border-color: #818cf8; transform: translateY(-2px); }
        .scene-btn.active { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.3); }
        .scene-btn.unavailable { cursor: not-allowed; opacity: .5; }
        /* Pannellum scene hotspot */
        .pnlm-hotspot.pnlm-scene-hotspot,
        .pnlm-hotspot[class*="pnlm-scene"] {
            background: rgba(79,70,229,.9) !important;
            border: 3px solid #fff !important;
            border-radius: 50% !important;
            width: 40px !important; height: 40px !important;
            box-shadow: 0 0 0 6px rgba(99,102,241,.35) !important;
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen">

        <div class="bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 text-white py-10 px-4">
            <div class="max-w-7xl mx-auto text-center">
                <span class="inline-block bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-widest px-4 py-1 rounded-full mb-3">
                    🌐 360° Virtual Tour
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">
                    Jelajahi {{ $settings['school_name'] ?? 'Sekolah Kami' }}
                </h1>
                <p class="text-indigo-200 text-base max-w-xl mx-auto">
                    Klik <strong>titik biru</strong> di dalam viewer untuk berpindah ruangan, seperti Google Street View.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-white rounded-2xl shadow-xl p-4 mb-6">
                <div class="flex items-center justify-between mb-3 flex-wrap gap-2">
                    <div>
                        <h2 id="viewer-title" class="text-xl font-bold text-gray-900">Memuat...</h2>
                        <p  id="viewer-cat"   class="text-sm text-indigo-500 font-medium">—</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-400 hidden md:block">Drag memutar · Scroll zoom</span>
                        <button id="btn-debug" onclick="toggleDebug()"
                            class="px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 hover:bg-indigo-100 text-gray-600 border border-gray-200 transition">
                            📐 Koordinat
                        </button>
                        <button onclick="document.getElementById('panorama').requestFullscreen()"
                            class="px-3 py-1.5 text-xs font-bold rounded-lg bg-gray-100 hover:bg-indigo-100 text-gray-600 border border-gray-200 transition">
                            ⛶ Penuh
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <div id="tour-loading">
                        <svg class="animate-spin w-10 h-10 text-indigo-400 mb-3" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                        <p id="loading-text" class="text-sm text-gray-300">Memuat panorama...</p>
                    </div>
                    <div id="debug-panel">
                        <div class="mb-1"><strong>🛠 Mode Debug</strong></div>
                        Pitch: <strong id="dbg-pitch">—</strong><br>
                        Yaw:   <strong id="dbg-yaw">—</strong><br>
                        <span class="text-xs opacity-60 mt-1 block">Arahkan ke posisi hotspot</span>
                    </div>
                    <div id="scene-info">
                        <h3 id="info-title">—</h3>
                        <p  id="info-cat">—</p>
                    </div>
                    <div id="panorama"></div>
                </div>
            </div>

            {{-- MINI-MAP --}}
            <div class="bg-white rounded-2xl shadow-xl p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-gray-900">📍 Peta Lokasi</h3>
                    <span class="text-xs text-gray-400">Klik untuk lompat ke lokasi</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-3">
                    @foreach($rooms as $room)
                        <div class="scene-btn unavailable bg-gray-50 rounded-xl p-2 text-center"
                             id="scene-btn-{{ $room['id'] }}"
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

            <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-2xl p-5">
                <h4 class="font-bold text-indigo-800 mb-2">🧭 Cara Menambah Hotspot</h4>
                <ol class="text-sm text-indigo-700 space-y-1 list-decimal list-inside">
                    <li>Aktifkan <strong>Mode Koordinat</strong> (tombol kanan atas)</li>
                    <li>Arahkan mouse ke posisi pintu/jalur ke ruangan berikutnya</li>
                    <li>Catat <strong>Pitch</strong> dan <strong>Yaw</strong> lalu kirim ke developer</li>
                </ol>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script>
    const SCENES = @json($rooms);

    // ============================================================
    // HOTSPOT — edit sesuai koordinat dari Mode Debug
    // ============================================================
    const HOTSPOTS = {
        'halaman-1': [
            { targetScene: 'halaman-2', pitch: -1.76, yaw:   4.74, label: '→ Halaman 2' },
        ],
        'halaman-2': [
            { targetScene: 'halaman-3', pitch:  0.20, yaw:  -3.39, label: '→ Halaman 3' },
            { targetScene: 'halaman-1', pitch: -2.03, yaw: 178.91, label: '← Halaman 1' },
        ],
        'halaman-3': [
            { targetScene: 'halaman-2', pitch: -3.24, yaw:  86.78, label: '← Halaman 2' },
        ],
    };
    // ============================================================

    let viewer    = null;
    let debugMode = false;

    function checkImage(url) {
        return new Promise(resolve => {
            const img   = new Image();
            img.onload  = () => resolve(true);
            img.onerror = () => resolve(false);
            img.src     = url + '?_nc=' + Date.now();
        });
    }

    async function initScenes() {
        for (const room of SCENES) {
            const exists = await checkImage(room.image);
            const btn   = document.getElementById('scene-btn-'   + room.id);
            const badge = document.getElementById('scene-badge-' + room.id);
            const thumb = document.getElementById('scene-thumb-' + room.id);

            room.available = exists;
            if (exists) {
                btn.classList.remove('unavailable');
                badge.textContent = '● Live';
                badge.className   = 'text-xs text-green-500 font-bold';
                thumb.innerHTML   = `<img src="${room.image}" class="w-full h-full object-cover">`;
            } else {
                badge.textContent = 'Segera';
                badge.className   = 'text-xs text-gray-400';
            }
        }

        const available = SCENES.filter(r => r.available);
        if (!available.length) {
            document.getElementById('loading-text').textContent = 'Belum ada foto 360° tersedia.';
            return;
        }

        // Build multi-scene config
        const scenesConfig = {};
        available.forEach(room => {
            scenesConfig[room.id] = {
                title    : room.title,
                panorama : room.image,
                type     : 'equirectangular',
                hotSpots : (HOTSPOTS[room.id] || [])
                    .filter(h => SCENES.find(r => r.id === h.targetScene && r.available))
                    .map(h => ({
                        pitch  : h.pitch,
                        yaw    : h.yaw,
                        type   : 'scene',
                        text   : h.label,
                        sceneId: h.targetScene,
                    })),
            };
        });

        const firstId = available[0].id;

        const fallback = setTimeout(() => {
            document.getElementById('tour-loading').style.display = 'none';
        }, 12000);

        viewer = pannellum.viewer('panorama', {
            default: {
                firstScene        : firstId,
                sceneFadeDuration : 800,
                autoLoad          : true,
                autoRotate        : -2,
                compass           : false,
                showZoomCtrl      : true,
                showFullscreenCtrl: true,
                hfov              : 110,
            },
            scenes: scenesConfig,
        });

        viewer.on('load', () => {
            clearTimeout(fallback);
            document.getElementById('tour-loading').style.display = 'none';
            const id = viewer.getScene();
            if (id) updateInfo(id);
            if (debugMode) attachDebug();
        });

        viewer.on('scenechange', id => {
            updateInfo(id);
            if (debugMode) attachDebug();
        });

        updateInfo(firstId);
    }

    function updateInfo(sceneId) {
        const room = SCENES.find(r => r.id === sceneId);
        if (!room) return;
        document.getElementById('viewer-title').textContent = room.title;
        document.getElementById('viewer-cat').textContent   = room.category;
        document.getElementById('info-title').textContent   = room.title;
        document.getElementById('info-cat').textContent     = room.category;
        document.querySelectorAll('.scene-btn').forEach(b => b.classList.remove('active'));
        const btn = document.getElementById('scene-btn-' + sceneId);
        if (btn) btn.classList.add('active');
    }

    function goToScene(id) {
        const room = SCENES.find(r => r.id === id);
        if (!room || !room.available || !viewer) return;
        viewer.loadScene(id);
    }

    function toggleDebug() {
        debugMode = !debugMode;
        document.getElementById('debug-panel').classList.toggle('on', debugMode);
        if (debugMode && viewer) attachDebug();
    }

    function attachDebug() {
        const el = document.getElementById('panorama');
        if (!el) return;
        if (window._dh) el.removeEventListener('mousemove', window._dh);
        window._dh = e => {
            if (!viewer || !debugMode) return;
            try {
                const c = viewer.mouseEventToCoords(e);
                document.getElementById('dbg-pitch').textContent = c[0].toFixed(2) + '°';
                document.getElementById('dbg-yaw').textContent   = c[1].toFixed(2) + '°';
            } catch(_) {
                const r = el.getBoundingClientRect();
                const p = viewer.getPitch() + ((e.clientY - r.top) / r.height - .5) * -viewer.getHfov() * (r.height / r.width);
                const y = viewer.getYaw()   + ((e.clientX - r.left) / r.width  - .5) *  viewer.getHfov();
                document.getElementById('dbg-pitch').textContent = p.toFixed(2) + '°';
                document.getElementById('dbg-yaw').textContent   = y.toFixed(2) + '°';
            }
        };
        el.addEventListener('mousemove', window._dh);
    }

    window.addEventListener('DOMContentLoaded', initScenes);
    </script>
@endpush