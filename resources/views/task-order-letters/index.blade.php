<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl md:text-3xl text-slate-900 leading-tight">
                    {{ __('Surat Perintah Tugas (SPT)') }}
                </h2>
                <p class="text-sm text-slate-600 mt-2">Kelola dan pantau semua surat perintah tugas untuk kegiatan</p>
            </div>
            <a href="{{ route('task-order-letters.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-semibold hover:shadow-lg hover:from-orange-700 hover:to-orange-800 transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Surat Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 shadow-sm flex items-start animate-fade-in">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <div>
                    <h3 class="font-semibold">Sukses!</h3>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white shadow-xl border border-slate-100 overflow-hidden flex flex-col flex-1">
                <!-- Header with Search and Filter -->
                <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-blue-50 via-white to-blue-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Daftar Surat Perintah Tugas</h3>
                            <p class="text-sm text-slate-600 mt-1">{{ $letters->total() }} surat dalam sistem</p>
                        </div>
                        <!-- Search Input -->
                        <div class="w-full sm:w-64 relative">
                            <input type="text" id="taskOrderSearch" placeholder="Cari..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <svg class="absolute right-3 top-2.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto px-4 pt-4">
                    <table id="taskOrderTable" class="w-full text-sm">
                        <thead>
                            <tr class="bg-blue-100 border-b border-slate-200">
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="tanggal_tugas">
                                    <div class="flex items-center gap-2">
                                        Tanggal Tugas
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="tempat_tugas">
                                    <div class="flex items-center gap-2">
                                        Tempat
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="keperluan">
                                    <div class="flex items-center gap-2">
                                        Keperluan
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="petugas">
                                    <div class="flex items-center justify-center gap-2">
                                        Petugas
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center font-bold text-slate-700 uppercase tracking-wider text-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($letters as $letter)
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-slate-900">{{ is_string($letter->tanggal_tugas) ? $letter->tanggal_tugas : ($letter->tanggal_tugas ? $letter->tanggal_tugas->format('d M Y') : '-') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-700">{{ $letter->tempat_tugas }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-700">{{ $letter->keperluan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold bg-blue-100 text-blue-800">{{ $letter->jumlah_petugas }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <!-- View Buttons -->
                                        <a href="{{ route('task-order-letters.previewFormat', $letter) }}?kop=1&paper=A4" target="_blank" class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition" title="Preview surat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <form action="{{ route('task-order-letters.destroy', $letter) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 transition" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus surat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-slate-700 font-medium mb-2">Belum ada surat perintah tugas</p>
                                        <p class="text-slate-600 text-sm mb-4">Mulai dengan membuat surat pertama Anda</p>
                                        <a href="{{ route('task-order-letters.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold hover:bg-orange-700 transition">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            @if($letters->count() > 0)
            // Prevent reinitializing DataTable
            if (!$.fn.DataTable.isDataTable('#taskOrderTable')) {
                const table = $('#taskOrderTable').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
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
                columnDefs: [
                    { orderable: true, targets: [0, 1, 2, 3] },
                    { orderable: false, targets: [4] }
                ],
                order: [[0, 'desc']],
                dom: 'lfrtp<"clear">',
                drawCallback: function() {
                    // Refresh dropdown functionality after redraw
                    document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                        d.classList.add('hidden');
                    });
                }
            });

                // Custom search with visual feedback
                $('#taskOrderSearch').on('keyup', function() {
                    table.search(this.value).draw();
                });
            }
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
    </style>
        function toggleDropdown(id) {
            const dropdown = document.getElementById('dropdown-' + id);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
            allDropdowns.forEach(d => { if (d !== dropdown) d.classList.add('hidden'); });
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('button[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));
            }
        });
    </script>
</x-app-layout>
