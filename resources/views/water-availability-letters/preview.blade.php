<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Pratinjau Surat Ketersediaan Air</h1>
                            <p class="text-sm text-gray-600">Nomor Surat Masuk: {{ $waterAvailabilityLetter->nomor_surat_masuk }}</p>
                            <div class="mt-2 inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                @if($waterAvailabilityLetter->status === 'disetujui') bg-green-100 text-green-800
                                @elseif($waterAvailabilityLetter->status === 'ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                Status: {{ ucfirst(str_replace('_', ' ', $waterAvailabilityLetter->status ?? 'Menunggu')) }}
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('water-availability-letters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Kembali ke Daftar
                            </a>
                            <a href="{{ route('water-availability-letters.edit', $waterAvailabilityLetter) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Surat
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 inline-flex rounded-lg border border-gray-200 overflow-hidden">
                        <a href="{{ route('water-availability-letters.previewFormat', [$waterAvailabilityLetter, 'kop' => 1]) }}" class="px-4 py-2 text-sm font-medium transition border-r border-gray-200 {{ $withKop ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Dengan Kop</a>
                        <a href="{{ route('water-availability-letters.previewFormat', [$waterAvailabilityLetter, 'kop' => 0]) }}" class="px-4 py-2 text-sm font-medium transition {{ !$withKop ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Tanpa Kop</a>
                    </div>

                    <dl class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Pengembang</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->nama_pengembang }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Proyek</dt>
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
                            <dd class="mt-1 text-sm text-gray-900">{{ $waterAvailabilityLetter->tanggal_surat_masuk->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status Ketersediaan</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($waterAvailabilityLetter->status_ketersediaan)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Tersedia</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">Tidak Tersedia</span>
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pratinjau Dokumen</h3>
                        <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                            <iframe src="{{ route('water-availability-letters.previewFormat', [$waterAvailabilityLetter, 'mode' => 'pdf', 'kop' => $withKop ? '1' : '0']) }}"
                                    class="w-full border-0"
                                    style="height: 700px;"
                                    frameborder="0"></iframe>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-2 flex-wrap">
                        <a href="{{ route('water-availability-letters.exportPdf', [$waterAvailabilityLetter, 'kop' => $withKop ? '1' : '0']) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download PDF
                        </a>
                        <a href="{{ route('water-availability-letters.exportDocx', [$waterAvailabilityLetter, 'kop' => $withKop ? '1' : '0']) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download DOCX
                        </a>
                        <a href="{{ route('water-availability-letters.show', $waterAvailabilityLetter) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Halaman Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
