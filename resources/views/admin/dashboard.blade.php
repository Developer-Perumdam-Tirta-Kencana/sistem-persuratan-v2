<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
                <p class="text-sm text-gray-500">Ringkasan aktivitas dan navigasi cepat</p>
            </div>
            <a href="{{ route('admin.user-management') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kelola User</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-6">
                <aside class="bg-white shadow-sm sm:rounded-lg p-5 h-fit sticky top-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-12 w-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-lg">M</div>
                        <div>
                            <p class="text-xs uppercase text-gray-500">Manager PDAM</p>
                            <p class="font-semibold text-gray-900">Manager</p>
                        </div>
                    </div>

                    <nav class="space-y-5 text-sm text-gray-700">
                        <div>
                            <p class="text-xs uppercase text-gray-500 mb-2">Utama</p>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'hover:bg-gray-50' }}">Dashboard</a>
                        </div>

                        <div>
                            <p class="text-xs uppercase text-gray-500 mb-2">Surat Keluar</p>
                            <div class="space-y-1">
                                <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-50">Semua Template</a>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Informasi</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Informasi</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Payroll</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Payroll BR...</a>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Payroll II...</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Pembayaran</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Pembayaran</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Pemberitahuan</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Pemberitah...</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Permohonan</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Permohonan</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Rekomendasi</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Rekomendas...</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Surat Tugas</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Tugas (Sur...</a>
                                </div>
                                <div class="px-3 py-2 rounded-md bg-gray-50">
                                    <p class="text-gray-900 font-semibold mb-1">Undangan</p>
                                    <a href="#" class="block text-gray-600 hover:text-gray-900">Template Surat Undangan</a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs uppercase text-gray-500 mb-2">Surat Masuk</p>
                            <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-50">Daftar Surat Masuk</a>
                        </div>

                        <div>
                            <p class="text-xs uppercase text-gray-500 mb-2">Management User</p>
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md hover:bg-gray-50 {{ request()->routeIs('admin.user-management') ? 'bg-indigo-50 text-indigo-700 font-semibold' : '' }}">Persetujuan</a>
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md hover:bg-gray-50">Kelola User</a>
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md hover:bg-gray-50">Orang Ditugaskan</a>
                        </div>
                    </nav>
                </aside>

                <main class="space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 flex flex-col gap-2">
                            <h3 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-gray-600">Anda login sebagai <span class="font-semibold text-indigo-600">Administrator</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Users</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-semibold">U</span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Surat Masuk</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-600 font-semibold">SM</span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Surat Keluar</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600 font-semibold">SK</span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Pending</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-rose-100 text-rose-600 font-semibold">P</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <a href="{{ route('admin.user-management') }}" class="flex items-center justify-between bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                                    <span>Kelola User</span>
                                    <span class="text-xs bg-white/20 px-2 py-1 rounded">Akses</span>
                                </a>
                                <button class="flex items-center justify-between bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                                    <span>Lihat Laporan</span>
                                    <span class="text-xs bg-white/20 px-2 py-1 rounded">Baru</span>
                                </button>
                                <button class="flex items-center justify-between bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                                    <span>Pengaturan Sistem</span>
                                    <span class="text-xs bg-white/20 px-2 py-1 rounded">Konfigurasi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
