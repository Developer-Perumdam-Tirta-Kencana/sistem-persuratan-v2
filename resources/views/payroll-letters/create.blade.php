<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Surat Payroll') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('payroll-letters.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nomor_surat" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat *</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_surat') border-red-500 @enderror" required>
                        @error('nomor_surat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_surat" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Surat *</label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat" value="{{ old('tanggal_surat') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_surat') border-red-500 @enderror" required>
                        @error('tanggal_surat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bulan_gaji" class="block text-gray-700 text-sm font-bold mb-2">Periode/Bulan Gaji *</label>
                        <input type="text" name="bulan_gaji" id="bulan_gaji" value="{{ old('bulan_gaji') }}" placeholder="Contoh: Desember 2025" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bulan_gaji') border-red-500 @enderror" required>
                        @error('bulan_gaji')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bank_tujuan" class="block text-gray-700 text-sm font-bold mb-2">Tujuan Bank *</label>
                        <select name="bank_tujuan" id="bank_tujuan" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bank_tujuan') border-red-500 @enderror" required>
                            <option value="">Pilih Bank</option>
                            <option value="Jatim" {{ old('bank_tujuan') == 'Jatim' ? 'selected' : '' }}>Bank Jatim</option>
                            <option value="BRI" {{ old('bank_tujuan') == 'BRI' ? 'selected' : '' }}>BRI</option>
                        </select>
                        @error('bank_tujuan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nomor_rekening_sumber" class="block text-gray-700 text-sm font-bold mb-2">Nomor Rekening Sumber *</label>
                        <input type="text" name="nomor_rekening_sumber" id="nomor_rekening_sumber" value="{{ old('nomor_rekening_sumber') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_rekening_sumber') border-red-500 @enderror" required>
                        @error('nomor_rekening_sumber')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="total_nominal" class="block text-gray-700 text-sm font-bold mb-2">Total Gaji (Rp) *</label>
                        <input type="number" name="total_nominal" id="total_nominal" value="{{ old('total_nominal') }}" min="0" step="0.01" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('total_nominal') border-red-500 @enderror" required>
                        @error('total_nominal')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-600 text-xs italic mt-1">Sistem akan otomatis generate terbilang</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('payroll-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
