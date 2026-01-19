<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Surat Keluar</h2>
                <p class="text-sm text-gray-500">Kelola surat keluar organisasi</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Surat Keluar</p>
                        <p class="text-3xl font-semibold text-gray-900">{{ $totalSuratKeluar }}</p>
                    </div>
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Empty State -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada surat keluar</h3>
                    <p class="mt-2 text-sm text-gray-500">Mulai buat surat keluar pertama Anda untuk mengelola persuratan organisasi.</p>
                    <div class="mt-6">
                        <a href="{{ route('surat-keluar.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Surat Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
