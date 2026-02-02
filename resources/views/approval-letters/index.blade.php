<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Persetujuan Surat</h2>
                <p class="text-sm text-gray-500">Kelola persetujuan semua template surat</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-500">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Menunggu ACC</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_pending'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-500">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Sudah Disetujui</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['total_approved'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-red-500">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600">{{ $stats['total_rejected'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-gray-500">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Draft</p>
                        <p class="text-3xl font-bold text-gray-600">{{ $stats['total_draft'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-yellow-500">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Perlu Revisi</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $stats['total_revision'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-transparent">
                    <h3 class="text-lg font-semibold text-gray-900">Filter Cepat</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Template Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Template Surat</label>
                            <select id="templateFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Template</option>
                                <option value="Surat Payroll">Surat Payroll</option>
                                <option value="Notifikasi Pekerjaan">Notifikasi Pekerjaan</option>
                                <option value="Ketersediaan Air">Ketersediaan Air</option>
                                <option value="Surat Rekomendasi">Surat Rekomendasi</option>
                                <option value="Surat Perintah Tugas">Surat Perintah Tugas</option>
                                <option value="Surat Delegasi">Surat Delegasi</option>
                                <option value="Surat Mutasi Internal">Surat Mutasi Internal</option>
                                <option value="Surat Izin Magang">Surat Izin Magang</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Surat</label>
                            <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="Menunggu ACC">Menunggu ACC</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Draft">Draft</option>
                                <option value="Perlu Revisi">Perlu Revisi</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <div class="flex items-end">
                            <button id="resetFilters" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors">
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Letters Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col flex-1">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-transparent">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Surat</h3>
                        <!-- Search Input -->
                        <div class="w-full sm:w-64 relative">
                            <input type="text" id="approvalSearch" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto px-4 pt-4">
                    <table id="approvalLettersTable" class="min-w-full divide-y divide-gray-200 display text-sm" style="width:100%">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-blue-200 transition" data-column="template">Template</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-blue-200 transition" data-column="nomor_surat">Nomor Surat</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-blue-200 transition" data-column="perihal">Perihal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-blue-200 transition" data-column="tanggal">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-blue-200 transition" data-column="status">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($letters as $letter)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $letter->template_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $letter->nomor_surat ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $letter->perihal ?? $letter->bulan_gaji ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-order="{{ $letter->tanggal_surat ? $letter->tanggal_surat->format('Y-m-d') : $letter->created_at->format('Y-m-d') }}">
                                        {{ $letter->tanggal_surat ? $letter->tanggal_surat->format('d/m/Y') : $letter->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @switch($letter->status)
                                            @case('menunggu_acc')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="w-2 h-2 mr-1.5 bg-yellow-600 rounded-full"></span> Menunggu ACC
                                                </span>
                                                @break
                                            @case('disetujui')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-2 h-2 mr-1.5 bg-green-600 rounded-full"></span> Disetujui
                                                </span>
                                                @break
                                            @case('ditolak')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-2 h-2 mr-1.5 bg-red-600 rounded-full"></span> Ditolak
                                                </span>
                                                @break
                                            @case('draft')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <span class="w-2 h-2 mr-1.5 bg-gray-600 rounded-full"></span> Draft
                                                </span>
                                                @break
                                            @case('perlu_revisi')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <span class="w-2 h-2 mr-1.5 bg-orange-600 rounded-full"></span> Perlu Revisi
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ ucfirst($letter->status) }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-3 sm:px-4 py-3 sm:py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>
                                        @if($letter->status === 'menunggu_acc')
                                            <button type="button" class="text-green-600 hover:text-green-900 mr-3" onclick="approveLetter('{{ $letter->template }}', {{ $letter->id }})">Setujui</button>
                                            <button type="button" class="text-red-600 hover:text-red-900" onclick="rejectLetter('{{ $letter->template }}', {{ $letter->id }})">Tolak</button>
                                        @elseif($letter->status === 'perlu_revisi')
                                            <button type="button" class="text-blue-600 hover:text-blue-900" onclick="editLetter('{{ $letter->template }}', {{ $letter->id }})">Edit</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* DataTables Custom Styling */
        .dataTables_wrapper {\n            width: 100%;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            min-width: 150px;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
        }
        .dataTables_wrapper .dataTables_info {
            margin-top: 1rem;
            font-size: 0.875rem;
        }
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.4rem 0.6rem;
            margin: 0;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        @media (max-width: 640px) {
            .dataTables_wrapper .dataTables_length select,
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
            }
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3b82f6 !important;
            color: white !important;
            border: 1px solid #3b82f6 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #60a5fa !important;
            color: white !important;
            border: 1px solid #60a5fa !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Prevent reinitializing DataTable
            if (!$.fn.DataTable.isDataTable('#approvalLettersTable')) {
                // Initialize DataTable with advanced features
                var table = $('#approvalLettersTable').DataTable({
                    "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                "order": [[3, "desc"]], // Sort by date column (newest first)
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { 
                        "targets": 5, // Aksi column
                        "orderable": false,
                        "searchable": false
                    }
                ],
                "responsive": true,
                "autoWidth": false,
                "dom": '<"flex flex-col sm:flex-row justify-between items-center mb-4"lf>rtip'
            });

            // Custom filter by template
            $('#templateFilter').on('change', function() {
                var value = $(this).val();
                table.column(0).search(value).draw();
            });

            // Custom filter by status
            $('#statusFilter').on('change', function() {
                var value = $(this).val();
                table.column(4).search(value).draw();
            });

            // Reset filters
            $('#resetFilters').on('click', function() {
                $('#templateFilter').val('');
                $('#statusFilter').val('');
                table.search('').columns().search('').draw();
            });
            }
        });

        function approveLetter(template, id) {
            if (confirm('Apakah Anda yakin ingin menyetujui surat ini?')) {
                // Implementation for approval will be added to the controller
                alert('Fitur approval akan diimplementasikan dalam fase berikutnya');
            }
        }

        function rejectLetter(template, id) {
            const reason = prompt('Masukkan alasan penolakan:');
            if (reason) {
                // Implementation for rejection will be added to the controller
                alert('Fitur rejection akan diimplementasikan dalam fase berikutnya');
            }
        }

        function editLetter(template, id) {
            // Redirect to edit page
            alert('Fitur edit akan diimplementasikan dalam fase berikutnya');
        }
    </script>
</x-app-layout>
