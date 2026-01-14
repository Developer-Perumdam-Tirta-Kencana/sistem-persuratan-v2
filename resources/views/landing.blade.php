<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirta Kencana e-Surat - Sistem Persuratan Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
    @endphp
    @if (!empty($manifest['resources/css/app.css']['file'] ?? null))
        <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
    @endif
    @if (!empty($manifest['resources/js/app.js']['file'] ?? null))
        <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}" defer></script>
    @endif
    <style>
        .hero-gradient {
            background: radial-gradient(circle at 20% 20%, rgba(125, 249, 255, 0.35) 0%, rgba(14, 165, 233, 0.2) 22%, transparent 36%),
                        radial-gradient(circle at 80% 10%, rgba(56, 189, 248, 0.3) 0%, rgba(12, 122, 181, 0.15) 28%, transparent 40%),
                        linear-gradient(135deg, #0ea5e9 0%, #0b83c4 45%, #065f94 100%);
        }

        .water-wave { position: relative; overflow: hidden; }
        .water-wave::after {
            content: "";
            position: absolute;
            left: 0; right: 0; bottom: -1px;
            height: 140px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23e0f2fe" fill-opacity="1" d="M0,256L80,229.3C160,203,320,149,480,112C640,75,800,53,960,80C1120,107,1280,181,1360,218.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>') center bottom no-repeat;
            background-size: cover; opacity: 0.9; pointer-events: none;
        }

        .floating-shape { position: absolute; filter: drop-shadow(0 15px 25px rgba(6, 95, 148, 0.25)); }
        .float-slow { animation: float 10s ease-in-out infinite; }
        .float-med { animation: float 8s ease-in-out infinite; }
        .float-fast { animation: float 6s ease-in-out infinite; }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-14px); }
            100% { transform: translateY(0px); }
        }

        .card-glow { box-shadow: 0 18px 48px rgba(14, 165, 233, 0.16); }
        .depth-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fbff 50%, #eef7ff 100%);
            border: 1px solid #e0f2fe;
            box-shadow: 0 25px 70px rgba(6, 95, 148, 0.18);
            transform: perspective(1200px) rotateX(2deg) rotateY(-3deg);
            transition: all 0.4s ease;
        }
        .depth-card:hover { transform: perspective(1200px) rotateX(0deg) rotateY(0deg) translateY(-4px); }

        .cta-ripple {
            background: linear-gradient(135deg, #1ec9ff 0%, #0ea5e9 55%, #0a7bb8 100%);
            box-shadow: 0 14px 38px rgba(14, 165, 233, 0.4);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .cta-ripple:hover { transform: translateY(-2px); box-shadow: 0 18px 46px rgba(14, 165, 233, 0.5); }

        .section-title { letter-spacing: 0.08em; text-transform: uppercase; font-size: 0.85rem; }
        
        /* 3D Feature Cards */
        .feature-card-3d {
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .feature-card-3d:hover {
            transform: translateY(-12px) rotateX(5deg) rotateY(5deg) scale(1.02);
            box-shadow: 0 30px 60px rgba(14, 165, 233, 0.3);
        }
        .feature-inner {
            transform: translateZ(50px);
            transition: transform 0.5s ease;
        }
        .feature-card-3d:hover .feature-inner {
            transform: translateZ(70px);
        }
        
        /* Glowing Pulse Animation */
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(14, 165, 233, 0.5), 0 0 40px rgba(14, 165, 233, 0.3); }
            50% { box-shadow: 0 0 30px rgba(14, 165, 233, 0.8), 0 0 60px rgba(14, 165, 233, 0.5); }
        }
        .glow-pulse {
            animation: glow-pulse 2s ease-in-out infinite;
        }
        
        /* Floating Icons */
        @keyframes float-rotate {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .float-icon {
            animation: float-rotate 4s ease-in-out infinite;
        }
        
        /* 3D Text Effect */
        .text-3d {
            text-shadow: 1px 1px 0 rgba(14, 165, 233, 0.3),
                         2px 2px 0 rgba(14, 165, 233, 0.25),
                         3px 3px 0 rgba(14, 165, 233, 0.2),
                         4px 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Slide in from side */
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .slide-in-right {
            animation: slide-in-right 0.8s ease-out forwards;
        }
        
        /* Scale bounce */
        @keyframes scale-bounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .scale-bounce:hover {
            animation: scale-bounce 0.6s ease-in-out;
        }
        
        /* Fade in on scroll */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
        
        /* Sticky nav effect */
        .nav-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
            transition: all 0.3s ease;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 50%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-sky-50 text-slate-800">
    <!-- Navigation -->
    <nav class="nav-sticky bg-white/90 backdrop-blur shadow-md border-b border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('logo.png') }}" alt="Tirta Kencana Logo" class="w-12 h-12 object-contain">
                        <div>
                            <h1 class="text-2xl font-semibold text-sky-800 leading-tight">Tirta Kencana e-Surat</h1>
                            <p class="text-xs text-sky-500">Perumda Air Minum</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-700 hover:text-sky-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class=" text-slate-700 hover:text-sky-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="hero-gradient text-white hover:bg-sky-700 px-4 py-2 rounded-md text-sm font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient water-wave relative overflow-hidden">
        <div class="floating-shape float-slow hidden md:block" style="top: 120px; left: 8%;">
            <div class="w-24 h-24 rounded-full bg-white/10 border border-white/30"></div>
        </div>
        <div class="floating-shape float-med hidden md:block" style="top: 40px; right: 12%;">
            <div class="w-32 h-32 rounded-3xl bg-white/8 border border-white/25"></div>
        </div>
        <div class="floating-shape float-fast hidden md:block" style="bottom: 60px; left: 18%;">
            <div class="w-20 h-20 rounded-full bg-white/12 border border-white/25"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 text-white">
                    <p class="section-title text-sky-100 mb-3">Solusi Surat Formal</p>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                        Alur Persuratan Resmi<br class="hidden md:block" />
                        sejernih aliran Tirta Kencana
                    </h1>
                    <p class="text-lg md:text-xl text-sky-100/90 mb-8 max-w-2xl">
                        Digitalisasi surat masuk & keluar dengan audit trail, role-based access, dan pengalaman formal yang elegan untuk Perumda Air Minum.
                    </p>
                    <div class="flex flex-wrap items-center gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="cta-ripple text-white px-8 py-3 rounded-lg text-lg font-semibold">
                                Mulai Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="bg-white/90 text-sky-800 hover:bg-white px-8 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-300">
                                Login
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="cta-ripple text-white px-8 py-3 rounded-lg text-lg font-semibold">
                                Ke Dashboard
                            </a>
                        @endguest
                    </div>
                    <div class="mt-10 bg-white/15 backdrop-blur-md rounded-2xl border border-white/25 p-6 shadow-xl">
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div class="feature-card-3d bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/30 hover:border-white/50 transition-all duration-500">
                                <div class="feature-inner">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center flex-shrink-0 shadow-lg float-icon">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-base font-bold text-white mb-1 text-3d">Audit trail lengkap</p>
                                            <p class="text-sm text-sky-100/90">Jejak lengkap setiap aksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="feature-card-3d bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/30 hover:border-white/50 transition-all duration-500">
                                <div class="feature-inner">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg float-icon" style="animation-delay: 0.2s">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4m-9 4v6"/></svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-base font-bold text-white mb-1 text-3d">Surat masuk/keluar terstruktur</p>
                                            <p class="text-sm text-sky-100/90">Alur formal & terintegrasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="depth-card rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-white to-cyan-50 opacity-70"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-sky-500">Dashboard Surat</p>
                                    <h3 class="text-2xl font-bold text-slate-800">Ringkasan Hari Ini</h3>
                                </div>
                              <span
                                    class="relative px-3 py-1 text-xs font-semibold text-sky-800 bg-sky-200
                                        rounded-full animate-pulse
                                        shadow-[0_0_12px_rgba(56,189,248,0.8)]">
                                    Live
                                </span>
                            </div>
                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-sky-50">
                                    <p class="text-xs text-slate-500">Surat Masuk</p>
                                    <p class="text-2xl font-bold text-sky-700">128</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-sky-50">
                                    <p class="text-xs text-slate-500">Surat Keluar</p>
                                    <p class="text-2xl font-bold text-sky-700">94</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-sm border border-sky-50">
                                    <p class="text-xs text-slate-500">Terselesaikan</p>
                                    <p class="text-2xl font-bold text-emerald-600">91%</p>
                                </div>
                            </div>
                            <div class="hero-gradient rounded-xl p-6 text-white shadow-lg min-h-[140px]">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4m-9 4v6"/></svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-white/80">Rute persetujuan</p>
                                        <p class="text-lg font-semibold">Persetujuan 2 tahap aktif</p>
                                        <div class="mt-3 h-2 bg-white/20 rounded-full overflow-hidden">
                                            <div class="h-full bg-white rounded-full" style="width: 78%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Strip -->
    <div class="bg-white border-b border-sky-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <div class="feature-card-3d p-6 bg-gradient-to-br from-sky-50 to-sky-100 rounded-xl border border-sky-100 shadow-sm group">
                    <div class="feature-inner">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center shadow-lg glow-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <p class="text-sm text-sky-600 font-semibold mb-2">Kecepatan Proses</p>
                        <p class="text-4xl font-bold text-sky-800 mb-1 text-3d group-hover:scale-110 transition-transform duration-300"><span class="align-middle">-37%</span></p>
                        <p class="text-xs text-slate-500 mt-1">Waktu penyelesaian surat</p>
                    </div>
                </div>
                <div class="feature-card-3d p-6 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl border border-emerald-100 shadow-sm group">
                    <div class="feature-inner">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg glow-pulse" style="animation-delay: 0.5s">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-sm text-emerald-600 font-semibold mb-2">Kepatuhan Arsip</p>
                        <p class="text-4xl font-bold text-emerald-800 mb-1 text-3d group-hover:scale-110 transition-transform duration-300">99%</p>
                        <p class="text-xs text-slate-500 mt-1">Jejak audit & log</p>
                    </div>
                </div>
                <div class="feature-card-3d p-6 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl border border-amber-100 shadow-sm group">
                    <div class="feature-inner">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg glow-pulse" style="animation-delay: 1s">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <p class="text-sm text-amber-600 font-semibold mb-2">Kepuasan Unit</p>
                        <p class="text-4xl font-bold text-amber-800 mb-1 text-3d group-hover:scale-110 transition-transform duration-300">4.8/5</p>
                        <p class="text-xs text-slate-500 mt-1">Evaluasi internal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16">
            <p class="section-title text-sky-700 font-bold mb-2">Fitur Unggulan</p>
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Formal, aman, dan tetap elegan</h2>
            <p class="text-lg text-slate-700 max-w-3xl mx-auto">Setiap modul dirancang untuk menjaga tata kelola surat yang resmi namun tetap ramah digunakan.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="feature-card-3d bg-white rounded-2xl card-glow p-8 border border-sky-50 group">
                <div class="feature-inner">
                    <div class="w-16 h-16 bg-gradient-to-br from-sky-100 to-sky-200 rounded-xl flex items-center justify-center mb-6 glow-pulse group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4m-9 4v6"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-sky-700 transition-colors">Arsip & Pelacakan</h3>
                    <p class="text-slate-600">Timeline surat masuk/keluar dengan status real-time, kode arsip, dan histori disposisi.</p>
                    <div class="mt-4 pt-4 border-t border-sky-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm text-sky-600 font-semibold">Lihat detail →</span>
                    </div>
                </div>
            </div>

            <div class="feature-card-3d bg-white rounded-2xl card-glow p-8 border border-sky-50 group" style="animation-delay: 0.1s">
                <div class="feature-inner">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-100 to-cyan-200 rounded-xl flex items-center justify-center mb-6 glow-pulse group-hover:scale-110 transition-transform duration-300" style="animation-delay: 0.5s">
                        <svg class="w-8 h-8 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-cyan-700 transition-colors">Role & Otorisasi</h3>
                    <p class="text-slate-600">Admin, staff, dan user dengan hak akses terukur. Semua aksi tercatat untuk audit.</p>
                    <div class="mt-4 pt-4 border-t border-cyan-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm text-cyan-600 font-semibold">Lihat detail →</span>
                    </div>
                </div>
            </div>

            <div class="feature-card-3d bg-white rounded-2xl card-glow p-8 border border-sky-50 group" style="animation-delay: 0.2s">
                <div class="feature-inner">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mb-6 glow-pulse group-hover:scale-110 transition-transform duration-300" style="animation-delay: 1s">
                        <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-700 transition-colors">Template Resmi</h3>
                    <p class="text-slate-700">Format surat standar, kop resmi, dan penomoran otomatis untuk konsistensi identitas.</p>
                    <div class="mt-4 pt-4 border-t border-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-sm text-blue-600 font-semibold">Lihat detail →</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="bg-gradient-to-b from-white via-sky-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-5">
                    <p class="section-title text-sky-700 font-bold mb-3">Alur Formal</p>
                    <h3 class="text-3xl font-bold text-slate-900 mb-4">Tiga tahap jelas untuk setiap surat</h3>
                    <p class="text-slate-700 mb-6">Setiap langkah memiliki pemilik, tenggat, dan bukti terekam. Transparan dari intake hingga arsip.</p>
                    <div class="space-y-4">
                        <div class="feature-card-3d bg-gradient-to-br from-white to-sky-50 rounded-xl p-5 border-2 border-sky-200 shadow-lg hover:shadow-2xl transition-all duration-500 group">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-sky-400 to-sky-600 text-white flex items-center justify-center font-bold text-lg shadow-lg glow-pulse flex-shrink-0">1</div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-900 text-lg mb-1 group-hover:text-sky-700 transition-colors">Intake & Registrasi</p>
                                    <p class="text-sm text-slate-700">Surat masuk dicatat, diberi nomor, dan diarahkan ke unit terkait.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-card-3d bg-gradient-to-br from-white to-cyan-50 rounded-xl p-5 border-2 border-cyan-200 shadow-lg hover:shadow-2xl transition-all duration-500 group">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-400 to-cyan-600 text-white flex items-center justify-center font-bold text-lg shadow-lg glow-pulse flex-shrink-0" style="animation-delay: 0.5s">2</div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-900 text-lg mb-1 group-hover:text-cyan-700 transition-colors">Disposisi & Approval</p>
                                    <p class="text-sm text-slate-700">Alur persetujuan bertingkat dengan status jelas dan notifikasi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-card-3d bg-gradient-to-br from-white to-blue-50 rounded-xl p-5 border-2 border-blue-200 shadow-lg hover:shadow-2xl transition-all duration-500 group">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-lg glow-pulse flex-shrink-0" style="animation-delay: 1s">3</div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-900 text-lg mb-1 group-hover:text-blue-700 transition-colors">Arsip & Pelaporan</p>
                                    <p class="text-sm text-slate-700">Dokumen disimpan aman dengan audit trail, siap dilaporkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-28 h-28 rounded-full bg-sky-100 blur-3xl opacity-70"></div>
                        <div class="absolute -bottom-8 -right-4 w-32 h-32 rounded-full bg-cyan-100 blur-3xl opacity-60"></div>
                        <div class="bg-white rounded-2xl shadow-2xl border border-sky-100 p-8 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-white to-cyan-50 opacity-70"></div>
                            <div class="relative grid md:grid-cols-2 gap-6">
                                <div class="bg-white border border-sky-100 rounded-xl p-5 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs text-slate-700 font-medium">Surat Masuk</p>
                                        <span class="text-emerald-600 text-xs font-semibold">Aktif</span>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-900 mb-2">Agenda Air Bersih</p>
                                    <p class="text-sm text-slate-700">Ditujukan: Divisi Operasional • Tenggat: 12 Jan</p>
                                </div>
                                <div class="bg-white border border-sky-100 rounded-xl p-5 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs text-slate-700 font-medium">Surat Keluar</p>
                                        <span class="text-sky-600 text-xs font-semibold">Draft</span>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-900 mb-2">Balasan Pelanggan</p>
                                    <p class="text-sm text-slate-700">Status: Komposisi • Template resmi Tirta Kencana</p>
                                </div>
                                <div class="md:col-span-2 bg-gradient-to-r from-sky-600 to-cyan-600 rounded-xl p-6 text-white shadow-lg min-h-[180px]">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-sm">Progress Persetujuan</p>
                                        <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Multi-tahap</span>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between text-sm">
                                            <span>Manager Operasional</span>
                                            <span class="text-emerald-100">Selesai</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span>Direktur Teknis</span>
                                            <span class="text-white">Berjalan</span>
                                        </div>
                                        <div class="w-full h-2 bg-white/25 rounded-full overflow-hidden">
                                            <div class="h-full bg-white rounded-full" style="width: 72%;"></div>
                                        </div>
                                        <p class="text-xs text-sky-100/90">Jejak audit otomatis tersimpan untuk setiap keputusan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-sky-700 via-cyan-700 to-blue-800 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 bg-white rounded-full blur-3xl float-slow"></div>
            <div class="absolute bottom-10 right-10 w-56 h-56 bg-cyan-300 rounded-full blur-3xl float-fast"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4 text-3d">Siap jalankan tata kelola surat formal?</h2>
                <p class="text-xl text-sky-100 mb-10 max-w-2xl mx-auto">Aktifkan e-Surat Tirta Kencana dan pastikan setiap dokumen mengalir rapi.</p>
                @guest
                    <a href="{{ route('register') }}" class="scale-bounce bg-white text-sky-800 hover:bg-slate-100 px-10 py-4 rounded-xl text-lg font-bold shadow-2xl transition duration-300 inline-block hover:scale-105">
                        Daftar Sekarang →
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Tirta Kencana Logo" class="w-10 h-10 object-contain">
                        <h3 class="text-white font-bold text-lg">Tirta Kencana e-Surat</h3>
                    </div>
                    <p class="text-slate-400 text-sm">Sistem persuratan digital untuk Perumda Air Minum</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Fitur Utama</h4>
                    <ul class="space-y-2 text-slate-400 text-sm">
                        <li>• Surat Masuk & Keluar</li>
                        <li>• Audit Trail Lengkap</li>
                        <li>• Role Management</li>
                        <li>• Template Resmi</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Kontak</h4>
                    <p class="text-slate-400 text-sm">Perumda Air Minum Tirta Kencana</p>
                    <p class="text-slate-400 text-sm">Sistem Persuratan Terintegrasi</p>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-6 text-center text-slate-400 text-sm">
                <p>&copy; 2026 Tirta Kencana e-Surat. Menjaga arus dokumen tetap jernih.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Intersection Observer for fade-in animations
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                    }
                });
            }, observerOptions);
            
            // Observe all feature cards
            document.querySelectorAll('.feature-card-3d').forEach(card => {
                observer.observe(card);
            });
            
            // Smooth scroll for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>
