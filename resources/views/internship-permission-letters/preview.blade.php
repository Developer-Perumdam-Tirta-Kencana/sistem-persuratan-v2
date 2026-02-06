<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Pratinjau Surat Izin Magang</h1>
                            <p class="text-sm text-gray-600">Instansi Pendidikan: {{ $internshipPermissionLetter->instansi_pendidikan }}</p>
                            <div class="mt-2 inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                                @if($internshipPermissionLetter->status === 'disetujui') bg-green-100 text-green-800
                                @elseif($internshipPermissionLetter->status === 'ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                Status: {{ ucfirst(str_replace('_', ' ', $internshipPermissionLetter->status ?? 'Menunggu')) }}
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('internship-permission-letters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Kembali ke Daftar
                            </a>
                            <a href="{{ route('internship-permission-letters.edit', $internshipPermissionLetter) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Surat
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 inline-flex rounded-lg border border-gray-200 overflow-hidden">
                        <a href="{{ route('internship-permission-letters.previewFormat', [$internshipPermissionLetter, 'kop' => 1, 'paper' => 'F4']) }}" class="px-4 py-2 text-sm font-medium transition border-r border-gray-200 {{ $withKop ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Dengan Kop</a>
                        <a href="{{ route('internship-permission-letters.previewFormat', [$internshipPermissionLetter, 'kop' => 0, 'paper' => 'F4']) }}" class="px-4 py-2 text-sm font-medium transition {{ !$withKop ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Tanpa Kop</a>
                    </div>

                    <dl class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Instansi Pendidikan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->instansi_pendidikan }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nomor Surat Permohonan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->nomor_surat_permohonan }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->tanggal_mulai->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Selesai</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $internshipPermissionLetter->tanggal_selesai->format('d/m/Y') }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">List Mahasiswa</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if(is_array($internshipPermissionLetter->list_mahasiswa) && count($internshipPermissionLetter->list_mahasiswa) > 0)
                                    <ul class="list-disc list-inside">
                                        @foreach($internshipPermissionLetter->list_mahasiswa as $mahasiswa)
                                            <li>{{ $mahasiswa['nama'] ?? $mahasiswa }} ({{ $mahasiswa['nim'] ?? '-' }})</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $internshipPermissionLetter->list_mahasiswa ?? '-' }}
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <!-- PDF Viewer Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Pratinjau Dokumen
                        </h3>

                        <!-- PDF Viewer Container - Gray background with white paper effect -->
                        <div class="bg-gray-300 rounded-lg p-4" style="min-height: 850px;">
                            <div class="flex items-center justify-center h-full">
                                <div class="w-full max-w-2xl">
                                    <iframe
                                        src="{{ route(
                                            'internship-permission-letters.previewFormat',
                                            [
                                                $internshipPermissionLetter,
                                                'mode' => 'pdf',
                                                'kop' => $withKop ? '1' : '0',
                                                'paper' => 'F4'
                                            ]
                                        ) }}"
                                        class="w-full rounded-lg shadow-2xl"
                                        style="
                                            height: 800px;
                                            border: none;
                                            background: white;
                                        "
                                        frameborder="0"
                                        allow="fullscreen">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-6 flex gap-2 flex-wrap">
                        <a href="{{ route('internship-permission-letters.exportPdf', [$internshipPermissionLetter, 'kop' => $withKop ? '1' : '0']) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download PDF
                        </a>
                        <a href="{{ route('internship-permission-letters.exportDocx', [$internshipPermissionLetter, 'kop' => $withKop ? '1' : '0']) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download DOCX
                        </a>
                        <a href="{{ route('internship-permission-letters.show', $internshipPermissionLetter) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Halaman Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
