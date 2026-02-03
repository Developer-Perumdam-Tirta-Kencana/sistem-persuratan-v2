<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Surat Perintah Tugas (SPT)') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('task-order-letters.store') }}" method="POST" x-data="{ petugas: [''] }">
                    @csrf
                    <div class="mb-4">
                        <label for="nomor_surat" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_surat') border-red-500 @enderror">
                        @error('nomor_surat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari *</label>
                        <input type="text" name="hari" id="hari" value="{{ old('hari') }}" placeholder="Contoh: Rabu - Jumat"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hari') border-red-500 @enderror" required>
                        @error('hari')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_surat" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Dikeluarkan (opsional)</label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat" value="{{ old('tanggal_surat') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_surat') border-red-500 @enderror">
                        @error('tanggal_surat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="dasar_surat" class="block text-gray-700 text-sm font-bold mb-2">Dasar Surat *</label>
                        <textarea name="dasar_surat" id="dasar_surat" rows="2" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dasar_surat') border-red-500 @enderror" required>{{ old('dasar_surat') }}</textarea>
                        @error('dasar_surat')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Daftar Petugas *</label>
                        <template x-for="(item, index) in petugas" :key="index">
                            <div class="flex gap-2 mb-2">
                                <input type="text" :name="'list_petugas[' + index + ']'" x-model="petugas[index]" 
                                    placeholder="Nama Petugas"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <button type="button" @click="petugas.splice(index, 1)" x-show="petugas.length > 1"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Hapus
                                </button>
                            </div>
                        </template>
                        <button type="button" @click="petugas.push('')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm mt-2">
                            + Tambah Petugas
                        </button>
                        @error('list_petugas')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="hari_tanggal_tugas" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Tugas *</label>
                        <input type="text" name="hari_tanggal_tugas" id="hari_tanggal_tugas" value="{{ old('hari_tanggal_tugas') }}" 
                            placeholder="Contoh: Senin, 22 Januari 2026"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hari_tanggal_tugas') border-red-500 @enderror" required>
                        @error('hari_tanggal_tugas')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="waktu_tugas" class="block text-gray-700 text-sm font-bold mb-2">Waktu Tugas *</label>
                        <input type="text" name="waktu_tugas" id="waktu_tugas" value="{{ old('waktu_tugas') }}" 
                            placeholder="Contoh: 08.00 - Selesai"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('waktu_tugas') border-red-500 @enderror" required>
                        @error('waktu_tugas')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tempat_tugas" class="block text-gray-700 text-sm font-bold mb-2">Tempat Tugas *</label>
                        <input type="text" name="tempat_tugas" id="tempat_tugas" value="{{ old('tempat_tugas') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tempat_tugas') border-red-500 @enderror" required>
                        @error('tempat_tugas')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keperluan_tugas" class="block text-gray-700 text-sm font-bold mb-2">Keperluan *</label>
                        <textarea name="keperluan_tugas" id="keperluan_tugas" rows="3" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('keperluan_tugas') border-red-500 @enderror" required>{{ old('keperluan_tugas') }}</textarea>
                        @error('keperluan_tugas')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pakaian" class="block text-gray-700 text-sm font-bold mb-2">Dresscode/Pakaian (Opsional)</label>
                        <input type="text" name="pakaian" id="pakaian" value="{{ old('pakaian') }}" 
                            placeholder="Contoh: Pakaian dinas lengkap"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pakaian') border-red-500 @enderror">
                        @error('pakaian')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('task-order-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
