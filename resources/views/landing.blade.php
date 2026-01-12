<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirta Kencana e-Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="bg-sky-50 text-slate-800">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur shadow-md border-b border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-sky-100 text-sky-700 font-semibold">TK</span>
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
                    <div class="mt-10 flex flex-wrap gap-6 text-sm text-sky-50/90">
                        <div class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-white"></span><span>Audit trail lengkap</span></div>
                        <div class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-white"></span><span>Role admin, staff, user</span></div>
                        <div class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-white"></span><span>Surat masuk/keluar terstruktur</span></div>
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
                                <span class="px-3 py-1 text-xs font-semibold bg-sky-100 text-sky-700 rounded-full">Live</span>
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
                            <div class="bg-gradient-to-r from-sky-600 to-cyan-600 rounded-xl p-6 text-white shadow-lg min-h-[140px]">
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
    <div class="bg-white border-b border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid md:grid-cols-3 gap-6 text-center">
                <div class="p-6 bg-sky-50 rounded-xl border border-sky-100 shadow-sm">
                    <p class="text-sm text-sky-600">Kecepatan Proses</p>
                    <p class="text-3xl font-bold text-sky-800"><span class="align-middle">-37%</span></p>
                    <p class="text-xs text-slate-500 mt-1">Waktu penyelesaian surat</p>
                </div>
                <div class="p-6 bg-sky-50 rounded-xl border border-sky-100 shadow-sm">
                    <p class="text-sm text-sky-600">Kepatuhan Arsip</p>
                    <p class="text-3xl font-bold text-sky-800">99%</p>
                    <p class="text-xs text-slate-500 mt-1">Jejak audit & log</p>
                </div>
                <div class="p-6 bg-sky-50 rounded-xl border border-sky-100 shadow-sm">
                    <p class="text-sm text-sky-600">Kepuasan Unit</p>
                    <p class="text-3xl font-bold text-sky-800">4.8/5</p>
                    <p class="text-xs text-slate-500 mt-1">Evaluasi internal</p>
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
            <div class="bg-white rounded-2xl card-glow p-8 hover:shadow-2xl transition duration-300 border border-sky-50">
                <div class="w-16 h-16 bg-sky-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4m-9 4v6"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Arsip & Pelacakan</h3>
                <p class="text-slate-600">Timeline surat masuk/keluar dengan status real-time, kode arsip, dan histori disposisi.</p>
            </div>

            <div class="bg-white rounded-2xl card-glow p-8 hover:shadow-2xl transition duration-300 border border-sky-50">
                <div class="w-16 h-16 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7M9 5h6m-3 0v14"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Role & Otorisasi</h3>
                <p class="text-slate-600">Admin, staff, dan user dengan hak akses terukur. Semua aksi tercatat untuk audit.</p>
            </div>

            <div class="bg-white rounded-2xl card-glow p-8 hover:shadow-2xl transition duration-300 border border-sky-50">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Template Resmi</h3>
                <p class="text-slate-700">Format surat standar, kop resmi, dan penomoran otomatis untuk konsistensi identitas.</p>
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
                        <div class="flex items-start space-x-3">
                            <span class="w-8 h-8 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center font-semibold">1</span>
                            <div>
                                <p class="font-semibold text-slate-900">Intake & Registrasi</p>
                                <p class="text-sm text-slate-700">Surat masuk dicatat, diberi nomor, dan diarahkan ke unit terkait.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="w-8 h-8 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center font-semibold">2</span>
                            <div>
                                <p class="font-semibold text-slate-900">Disposisi & Approval</p>
                                <p class="text-sm text-slate-700">Alur persetujuan bertingkat dengan status jelas dan notifikasi.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">3</span>
                            <div>
                                <p class="font-semibold text-slate-900">Arsip & Pelaporan</p>
                                <p class="text-sm text-slate-700">Dokumen disimpan aman dengan audit trail, siap dilaporkan.</p>
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
    <div class="bg-gradient-to-r from-sky-700 via-cyan-700 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-3">Siap jalankan tata kelola surat formal?</h2>
                <p class="text-lg text-sky-100 mb-8">Aktifkan e-Surat Tirta Kencana dan pastikan setiap dokumen mengalir rapi.</p>
                @guest
                    <a href="{{ route('register') }}" class="bg-white text-sky-800 hover:bg-slate-100 px-8 py-3 rounded-lg text-lg font-semibold shadow-lg transition duration-300 inline-block">
                        Daftar Sekarang
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="text-center text-slate-400 text-sm">
                <p>&copy; 2026 Tirta Kencana e-Surat. Menjaga arus dokumen tetap jernih.</p>
            </div>
        </div>
    </footer>
</body>
</html>
