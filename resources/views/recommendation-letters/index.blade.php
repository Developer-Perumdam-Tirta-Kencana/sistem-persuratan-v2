<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Surat Rekomendasi') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola surat rekomendasi untuk pihak ketiga</p>
            </div>
            <a href="{{ route('recommendation-letters.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Surat
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Surat Rekomendasi</h3>
                        <div class="text-sm text-gray-600">
                            Total: <span class="font-semibold text-gray-900">{{ $letters->total() }}</span> surat
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table id="recommendationTable" class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-3 text-left">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama PT</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kegiatan</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Kegiatan</span>
                                </th>
                                <th class="px-6 py-3 text-center">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($letters as $letter)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900">{{ $letter->nama_pt }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ $letter->jenis_kegiatan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700">{{ $letter->tanggal_kegiatan ? $letter->tanggal_kegiatan->format('d M Y') : '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-1.5 flex-wrap">
                                        <!-- View Buttons -->
                                        <div class="inline-flex rounded-lg border border-gray-300 bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                            <a href="{{ route('recommendation-letters.previewFormat', $letter) }}?kop=1" title="Lihat dengan kop (F4)" class="px-4 py-2 text-xs font-medium text-blue-600 hover:bg-blue-50 border-r border-gray-200 transition kop-button">📄 Lihat Dengan Kop</a>
                                            <a href="{{ route('recommendation-letters.previewFormat', $letter) }}?kop=0" title="Lihat tanpa kop" class="px-4 py-2 text-xs font-medium text-gray-600 hover:bg-gray-100 transition">📋 Lihat Tanpa Kop</a>
                                        </div>
                                        <form action="{{ route('recommendation-letters.destroy', $letter) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus surat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-700 font-medium mb-2">Belum ada surat rekomendasi</p>
                                        <p class="text-gray-600 text-sm mb-4">Mulai dengan membuat surat pertama Anda</p>
                                        <a href="{{ route('recommendation-letters.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat Surat Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>

    <script>
        $(document).ready(function() {
            @if($letters->count() > 0)
            $('#recommendationTable').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ per halaman",
                    zeroRecords: "Tidak ada data",
                    info: "_START_ hingga _END_ dari _TOTAL_ surat",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(disaring dari _MAX_ total)",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                pageLength: 15,
                lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Semua"]],
                responsive: true,
                autoWidth: false,
                ordering: true,
                searching: true,
                paging: true,
                info: true,
                dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
                columnDefs: [
                    { className: "text-center", targets: [3] }
                ]
            });
            @endif
        });
    </script>

    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .dataTables_wrapper .dataTables_length select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }
        
        .dataTables_wrapper .dataTables_info {
            padding: 1rem 0;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 0;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
            color: #374151;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #1d4ed8;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

    <script>
        // F4 shortcut untuk view pertama dengan kop
        document.addEventListener('keydown', function(event) {
            if (event.key === 'F4') {
                event.preventDefault();
                const firstKopButton = document.querySelector('.kop-button');
                if (firstKopButton) {
                    firstKopButton.click();
                }
            }
        });
    </script>
</x-app-layout>
