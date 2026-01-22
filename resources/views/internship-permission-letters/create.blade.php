@extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Surat Izin Magang/PKL') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('internship-permission-letters.store') }}" method="POST" 
                    x-data="{ mahasiswa: [{ nama: '', nim: '', prodi: '' }] }">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="instansi_pendidikan" class="block text-gray-700 text-sm font-bold mb-2">Asal Kampus/Sekolah *</label>
                        <input type="text" name="instansi_pendidikan" id="instansi_pendidikan" value="{{ old('instansi_pendidikan') }}" 
                            placeholder="Contoh: Universitas Airlangga"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instansi_pendidikan') border-red-500 @enderror" required>
                        @error('instansi_pendidikan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nomor_surat_permohonan" class="block text-gray-700 text-sm font-bold mb-2">Dasar/No. Surat Permohonan *</label>
                        <input type="text" name="nomor_surat_permohonan" id="nomor_surat_permohonan" value="{{ old('nomor_surat_permohonan') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_surat_permohonan') border-red-500 @enderror" required>
                        @error('nomor_surat_permohonan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Daftar Mahasiswa *</label>
                        <template x-for="(item, index) in mahasiswa" :key="index">
                            <div class="border rounded p-4 mb-3 bg-gray-50">
                                <div class="grid grid-cols-3 gap-2 mb-2">
                                    <div>
                                        <input type="text" :name="'list_mahasiswa[' + index + '][nama]'" x-model="mahasiswa[index].nama" 
                                            placeholder="Nama Lengkap"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    </div>
                                    <div>
                                        <input type="text" :name="'list_mahasiswa[' + index + '][nim]'" x-model="mahasiswa[index].nim" 
                                            placeholder="NIM"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    </div>
                                    <div>
                                        <input type="text" :name="'list_mahasiswa[' + index + '][prodi]'" x-model="mahasiswa[index].prodi" 
                                            placeholder="Program Studi"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    </div>
                                </div>
                                <button type="button" @click="mahasiswa.splice(index, 1)" x-show="mahasiswa.length > 1"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Hapus Mahasiswa
                                </button>
                            </div>
                        </template>
                        <button type="button" @click="mahasiswa.push({ nama: '', nim: '', prodi: '' })" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                            + Tambah Mahasiswa
                        </button>
                        @error('list_mahasiswa')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="tanggal_mulai" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai *</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_mulai') border-red-500 @enderror" required>
                            @error('tanggal_mulai')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggal_selesai" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai *</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_selesai') border-red-500 @enderror" required>
                            @error('tanggal_selesai')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('internship-permission-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
