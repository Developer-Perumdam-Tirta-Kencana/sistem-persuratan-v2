<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Surat Keluar</h2>
                <p class="text-sm text-gray-500">Ubah data surat keluar</p>
            </div>
            <a href="{{ route('surat-keluar.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kembali ke Daftar</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Fitur sedang dalam pengembangan</h3>
                    <p class="mt-2 text-sm text-gray-500">Form edit surat keluar akan segera tersedia.</p>
                    <div class="mt-6">
                        <a href="{{ route('surat-keluar.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
