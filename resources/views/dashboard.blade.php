<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-200 rounded-lg p-6 mb-8">
                <h3 class="text-2xl font-bold text-indigo-900 mb-2">Selamat Datang! 👋</h3>
                <p class="text-indigo-700">Anda berhasil login ke Sistem e-Surat Tirta Kencana</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Sistem</h3>
                    <p class="text-gray-600">Sistem Persuratan Terintegrasi Perumda Air Minum Tirta Kencana siap membantu mengelola dokumen dan surat Anda dengan efisien.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
