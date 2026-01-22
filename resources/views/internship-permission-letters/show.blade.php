@extends('layouts.app')

@section('content')
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Izin Magang/PKL') }}
        </h2>
        <a href="{{ route('internship-permission-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                        <dt class="text-sm font-medium text-gray-500">Asal Kampus/Sekolah</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->instansi_pendidikan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">No. Surat Permohonan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->nomor_surat_permohonan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Periode Magang</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $internshipPermissionLetter->tanggal_mulai->format('d F Y') }} 
                            s/d 
                            {{ $internshipPermissionLetter->tanggal_selesai->format('d F Y') }}
                            <span class="text-gray-500">
                                ({{ $internshipPermissionLetter->tanggal_mulai->diffInDays($internshipPermissionLetter->tanggal_selesai) }} hari)
                            </span>
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Daftar Mahasiswa ({{ count($internshipPermissionLetter->list_mahasiswa) }} orang)</dt>
                        <dd class="mt-1">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($internshipPermissionLetter->list_mahasiswa as $index => $mhs)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs['nama'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs['nim'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs['prodi'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </dd>
                    </div>
                </dl>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('internship-permission-letters.edit', $internshipPermissionLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <form action="{{ route('internship-permission-letters.destroy', $internshipPermissionLetter) }}" method="POST" class="inline">
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
