<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Tirta Kencana e-Surat</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
    @endphp
    @if (!empty($manifest['resources/css/app.css']['file'] ?? null))
        <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
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

        /* 3D Text Effect */
        .text-3d {
            text-shadow: 1px 1px 0 rgba(14, 165, 233, 0.3),
                         2px 2px 0 rgba(14, 165, 233, 0.25),
                         3px 3px 0 rgba(14, 165, 233, 0.2),
                         4px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* 3D Error Code */
        .error-code-3d {
            font-size: 8rem;
            font-weight: 900;
            letter-spacing: -0.05em;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 
                0px 2px 0 rgba(14, 165, 233, 0.4),
                0px 4px 0 rgba(14, 165, 233, 0.3),
                0px 6px 0 rgba(14, 165, 233, 0.2),
                0px 8px 12px rgba(0, 0, 0, 0.3);
            animation: float-3d 5s ease-in-out infinite;
        }

        @keyframes float-3d {
            0%, 100% { transform: translateY(0px) rotateZ(0deg); }
            50% { transform: translateY(-15px) rotateZ(1deg); }
        }

        /* 3D Card */
        .depth-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fbff 50%, #eef7ff 100%);
            border: 1px solid #e0f2fe;
            box-shadow: 0 25px 70px rgba(6, 95, 148, 0.18);
            transform: perspective(1200px) rotateX(2deg) rotateY(-3deg);
            transition: all 0.4s ease;
        }
        .depth-card:hover { transform: perspective(1200px) rotateX(0deg) rotateY(0deg) translateY(-4px); }

        /* Feature Cards */
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

        /* CTA Button */
        .cta-ripple {
            background: linear-gradient(135deg, #1ec9ff 0%, #0ea5e9 55%, #0a7bb8 100%);
            box-shadow: 0 14px 38px rgba(14, 165, 233, 0.4);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .cta-ripple:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 18px 46px rgba(14, 165, 233, 0.5);
        }

        /* Rotating Shape */
        @keyframes rotate-shape {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .rotate-shape {
            animation: rotate-shape 20s linear infinite;
        }

        /* Pulse Glow */
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(14, 165, 233, 0.5), 0 0 40px rgba(14, 165, 233, 0.3); }
            50% { box-shadow: 0 0 30px rgba(14, 165, 233, 0.8), 0 0 60px rgba(14, 165, 233, 0.5); }
        }
        .glow-pulse {
            animation: glow-pulse 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-sky-50 text-slate-800">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur shadow-md border-b border-sky-100">
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
                        <a href="{{ route('login') }}" class="text-slate-700 hover:text-sky-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Error Section -->
    <div class="hero-gradient water-wave relative overflow-hidden min-h-screen flex items-center justify-center">
        <!-- Floating Shapes -->
        <div class="floating-shape float-slow hidden md:block" style="top: 10%; left: 5%;">
            <div class="w-32 h-32 rounded-full bg-white/10 border border-white/30 rotate-shape"></div>
        </div>
        <div class="floating-shape float-med hidden md:block" style="top: 20%; right: 8%;">
            <div class="w-40 h-40 rounded-3xl bg-white/8 border border-white/25"></div>
        </div>
        <div class="floating-shape float-fast hidden md:block" style="bottom: 15%; left: 12%;">
            <div class="w-24 h-24 rounded-full bg-white/12 border border-white/25"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <!-- Left: Error Code -->
                <div class="text-center lg:text-right">
                    <div class="error-code-3d">404</div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 text-3d">
                        Halaman Tidak Ditemukan
                    </h1>
                </div>

                <!-- Right: Error Card -->
                <div class="feature-card-3d">
                    <div class="depth-card rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-white to-cyan-50 opacity-70"></div>
                        <div class="relative">
                            <div class="mb-6">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center shadow-lg mx-auto lg:mx-0">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-center lg:text-left text-slate-600 mb-2">
                                Maaf, halaman yang Anda cari tidak dapat ditemukan.
                            </p>
                            <p class="text-center lg:text-left text-sm text-slate-500 mb-8">
                                Halaman mungkin telah dihapus, dipindahkan, atau URL yang Anda masukkan tidak valid.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                                <a href="{{ route('landing') }}" class="cta-ripple text-white px-6 py-3 rounded-lg text-base font-semibold text-center">
                                    Kembali ke Beranda
                                </a>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="bg-white/90 text-sky-800 hover:bg-white px-6 py-3 rounded-lg text-base font-semibold text-center shadow-lg transition duration-300">
                                        Ke Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-white/90 text-sky-800 hover:bg-white px-6 py-3 rounded-lg text-base font-semibold text-center shadow-lg transition duration-300">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-16 grid sm:grid-cols-3 gap-6">
                <div class="feature-card-3d">
                    <div class="bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/30 hover:border-white/50 transition-all duration-500">
                        <div class="feature-inner">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base font-bold text-white mb-1">Cek URL</p>
                                    <p class="text-sm text-sky-100/90">Pastikan alamat halaman sudah benar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="feature-card-3d">
                    <div class="bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/30 hover:border-white/50 transition-all duration-500">
                        <div class="feature-inner">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base font-bold text-white mb-1">Sitemap</p>
                                    <p class="text-sm text-sky-100/90">Jelajahi halaman yang tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="feature-card-3d">
                    <div class="bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/30 hover:border-white/50 transition-all duration-500">
                        <div class="feature-inner">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base font-bold text-white mb-1">Kontak Support</p>
                                    <p class="text-sm text-sky-100/90">Tim siap membantu Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur border-t border-sky-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-600">
            <p>&copy; 2026 Tirta Kencana e-Surat. Semua hak cipta dilindungi.</p>
        </div>
    </footer>
</body>
</html>
