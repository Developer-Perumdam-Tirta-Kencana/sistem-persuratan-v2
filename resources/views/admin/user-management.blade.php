<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola User</h2>
                <p class="text-sm text-gray-500">Persetujuan, penugasan, dan pengaturan akun</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kembali ke Dashboard</a>
        </div>
    </x-slot>

    @php
        $pendingApprovals = [
            ['name' => 'Rani Kusuma', 'role' => 'Staff', 'submitted_at' => 'Hari ini 09:10', 'status' => 'Menunggu'],
            ['name' => 'Rifky Maulana', 'role' => 'User', 'submitted_at' => 'Kemarin 16:22', 'status' => 'Menunggu'],
        ];

        $assignedPeople = [
            ['name' => 'Sinta Dewi', 'task' => 'Pemeriksaan Surat Masuk', 'due' => '13 Jan 2026'],
            ['name' => 'Agus Santoso', 'task' => 'Validasi Template Payroll', 'due' => '14 Jan 2026'],
        ];
    @endphp

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
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-gray-50">Dashboard</a>
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
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('admin.user-management') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'hover:bg-gray-50' }}">Persetujuan</a>
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md hover:bg-gray-50">Kelola User</a>
                            <a href="{{ route('admin.user-management') }}" class="block px-3 py-2 rounded-md hover:bg-gray-50">Orang Ditugaskan</a>
                        </div>
                    </nav>
                </aside>

                <main class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Pengguna</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-semibold">U</span>
                            </div>
                        </div>
                        <div class="bg-white shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Persetujuan Tertunda</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ count($pendingApprovals) }}</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 text-amber-600 font-semibold">P</span>
                            </div>
                        </div>
                        <div class="bg-white shadow-sm sm:rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Orang Ditugaskan</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ count($assignedPeople) }}</p>
                                </div>
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 font-semibold">T</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Persetujuan</h3>
                                    <p class="text-sm text-gray-500">Tinjau permintaan akses baru</p>
                                </div>
                                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-amber-100 text-amber-700">Menunggu</span>
                            </div>
                            <div class="divide-y divide-gray-100">
                                @forelse ($pendingApprovals as $item)
                                    <div class="p-5 flex items-start justify-between">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $item['name'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $item['role'] }} • {{ $item['submitted_at'] }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button class="text-xs px-3 py-1 rounded-md bg-emerald-100 text-emerald-700 hover:bg-emerald-200">Setujui</button>
                                            <button class="text-xs px-3 py-1 rounded-md bg-rose-100 text-rose-700 hover:bg-rose-200">Tolak</button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-sm text-gray-500">Tidak ada permintaan baru.</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Kelola User</h3>
                                    <p class="text-sm text-gray-500">Tambah atau ubah peran pengguna</p>
                                </div>
                                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700">Tambah User</a>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">Contoh Admin</p>
                                        <p class="text-sm text-gray-500">admin@contoh.id • Administrator</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button class="text-xs px-3 py-1 rounded-md border border-gray-200 hover:border-gray-300">Ubah</button>
                                        <button class="text-xs px-3 py-1 rounded-md bg-rose-50 text-rose-700 hover:bg-rose-100">Nonaktifkan</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">Contoh Staff</p>
                                        <p class="text-sm text-gray-500">staff@contoh.id • Staff</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button class="text-xs px-3 py-1 rounded-md border border-gray-200 hover:border-gray-300">Ubah</button>
                                        <button class="text-xs px-3 py-1 rounded-md bg-rose-50 text-rose-700 hover:bg-rose-100">Nonaktifkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Orang Ditugaskan</h3>
                                <p class="text-sm text-gray-500">Pantau distribusi tugas</p>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700">Kelola Tugas</a>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse ($assignedPeople as $person)
                                <div class="p-5 flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $person['name'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $person['task'] }} • Batas: {{ $person['due'] }}</p>
                                    </div>
                                    <button class="text-xs px-3 py-1 rounded-md border border-gray-200 hover:border-gray-300">Lihat Detail</button>
                                </div>
                            @empty
                                <div class="p-6 text-sm text-gray-500">Belum ada penugasan.</div>
                            @endforelse
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
