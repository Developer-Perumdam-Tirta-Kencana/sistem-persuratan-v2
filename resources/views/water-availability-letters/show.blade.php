@extends('layouts.app')

@section('content')
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Informasi Ketersediaan Air') }}
        </h2>
        <a href="{{ route('water-availability-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status Ketersediaan</dt>
                        <dd class="mt-1">
                            @if($waterAvailabilityLetter->status_ketersediaan)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Dapat Melayani
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Belum Dapat Melayani
                            </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama Pengembang</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->nama_pengembang }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama Proyek/Perumahan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->nama_proyek }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Alamat Proyek</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->alamat_proyek }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Surat Masuk</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->nomor_surat_masuk }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Surat Masuk</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->tanggal_surat_masuk->format('d F Y') }}</dd>
                    </div>
                </dl>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('water-availability-letters.edit', $waterAvailabilityLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <form action="{{ route('water-availability-letters.destroy', $waterAvailabilityLetter) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
