<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Surat Informasi Ketersediaan Air') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('water-availability-letters.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status Ketersediaan *</label>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status_ketersediaan" value="1" {{ old('status_ketersediaan') == '1' ? 'checked' : '' }} class="form-radio" required>
                                <span class="ml-2">Dapat Melayani</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status_ketersediaan" value="0" {{ old('status_ketersediaan') == '0' ? 'checked' : '' }} class="form-radio" required>
                                <span class="ml-2">Belum Dapat Melayani</span>
                            </label>
                        </div>
                        @error('status_ketersediaan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama_pengembang" class="block text-gray-700 text-sm font-bold mb-2">Nama Pengembang/PT *</label>
                        <input type="text" name="nama_pengembang" id="nama_pengembang" value="{{ old('nama_pengembang') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_pengembang') border-red-500 @enderror" required>
                        @error('nama_pengembang')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama_proyek" class="block text-gray-700 text-sm font-bold mb-2">Nama Perumahan *</label>
                        <input type="text" name="nama_proyek" id="nama_proyek" value="{{ old('nama_proyek') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_proyek') border-red-500 @enderror" required>
                        @error('nama_proyek')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alamat_proyek" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lokasi *</label>
                        <textarea name="alamat_proyek" id="alamat_proyek" rows="3" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat_proyek') border-red-500 @enderror" required>{{ old('alamat_proyek') }}</textarea>
                        @error('alamat_proyek')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="nomor_surat_masuk" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat Masuk *</label>
                            <input type="text" name="nomor_surat_masuk" id="nomor_surat_masuk" value="{{ old('nomor_surat_masuk') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_surat_masuk') border-red-500 @enderror" required>
                            @error('nomor_surat_masuk')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggal_surat_masuk" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Surat Masuk *</label>
                            <input type="date" name="tanggal_surat_masuk" id="tanggal_surat_masuk" value="{{ old('tanggal_surat_masuk') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_surat_masuk') border-red-500 @enderror" required>
                            @error('tanggal_surat_masuk')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('water-availability-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
