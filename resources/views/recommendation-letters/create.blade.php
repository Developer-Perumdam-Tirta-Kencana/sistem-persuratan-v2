@extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Surat Rekomendasi') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('recommendation-letters.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama_pt" class="block text-gray-700 text-sm font-bold mb-2">Nama PT Pengembang *</label>
                        <input type="text" name="nama_pt" id="nama_pt" value="{{ old('nama_pt') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_pt') border-red-500 @enderror" required>
                        @error('nama_pt')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kegiatan" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kegiatan *</label>
                        <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan') }}" 
                            placeholder="Contoh: Pembangunan rumah tinggal"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_kegiatan') border-red-500 @enderror" required>
                        @error('jenis_kegiatan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama_perumahan" class="block text-gray-700 text-sm font-bold mb-2">Nama Perumahan *</label>
                        <input type="text" name="nama_perumahan" id="nama_perumahan" value="{{ old('nama_perumahan') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_perumahan') border-red-500 @enderror" required>
                        @error('nama_perumahan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jumlah_unit" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Unit *</label>
                        <input type="number" name="jumlah_unit" id="jumlah_unit" value="{{ old('jumlah_unit') }}" min="1"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jumlah_unit') border-red-500 @enderror" required>
                        @error('jumlah_unit')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="lokasi" class="block text-gray-700 text-sm font-bold mb-2">Lokasi *</label>
                        <textarea name="lokasi" id="lokasi" rows="3" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi') border-red-500 @enderror" required>{{ old('lokasi') }}</textarea>
                        @error('lokasi')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('recommendation-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
