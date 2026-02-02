<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl md:text-3xl text-slate-900 leading-tight">
                    {{ __('Surat Payroll') }}
                </h2>
                <p class="text-sm text-slate-600 mt-2">Kelola dan pantau semua surat payroll/gaji karyawan</p>
            </div>
            <a href="{{ route('payroll-letters.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105">
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
            <div class="bg-white shadow-xl border border-slate-100 rounded-lg overflow-hidden">
                <!-- Header with Search and Filter -->
                <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-blue-50 via-white to-blue-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900">Daftar Surat Payroll</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1">{{ $letters->total() }} surat dalam sistem</p>
                        </div>
                        <!-- Search Input -->
                        <div class="w-full sm:w-64 relative">
                            <input type="text" id="payrollSearch" placeholder="Cari nomor surat..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <svg class="absolute right-3 top-2.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto px-4 pt-4">
                    <table id="payrollTable" class="w-full text-sm">
                        <thead>
                            <tr class="bg-blue-100 border-b border-slate-200">
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="nomor_surat">
                                    <div class="flex items-center gap-2">
                                        Nomor Surat
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="tanggal_surat">
                                    <div class="flex items-center gap-2">
                                        Tanggal
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="bulan_gaji">
                                    <div class="flex items-center gap-2">
                                        Bulan Gaji
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="bank_tujuan">
                                    <div class="flex items-center justify-center gap-2">
                                        Bank
                                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m0 0h16"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-right font-bold text-slate-700 uppercase tracking-wider text-xs cursor-pointer hover:bg-blue-200 transition" data-column="total_nominal">
                                    <div class="flex items-center justify-end gap-2">
                                        Nominal
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
                                    <span class="font-medium text-slate-900 text-xs sm:text-sm">{{ $letter->nomor_surat }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs sm:text-sm text-slate-700">{{ $letter->tanggal_surat->format('d M Y') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs sm:text-sm text-slate-700">{{ $letter->bulan_gaji }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                        {{ $letter->bank_tujuan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="font-medium text-slate-900 text-xs sm:text-sm">Rp {{ number_format($letter->total_nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <!-- View Buttons -->
                                        <a href="{{ route('payroll-letters.previewFormat', $letter) }}?kop=1&paper=A4" target="_blank" class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition" title="Preview surat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('payroll-letters.edit', $letter) }}" class="inline-flex items-center px-3 py-2 text-xs font-medium text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition" title="Edit surat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('payroll-letters.destroy', $letter) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus surat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-slate-700 font-medium mb-2">Belum ada surat payroll</p>
                                        <p class="text-slate-600 text-xs sm:text-sm mb-4">Mulai dengan membuat surat payroll pertama Anda</p>
                                        <a href="{{ route('payroll-letters.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700 rounded transition">
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
            if (!$.fn.DataTable.isDataTable('#payrollTable')) {
                const table = $('#payrollTable').DataTable({
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
                    { orderable: true, targets: [0, 1, 2, 3, 4] },
                    { orderable: false, targets: [5] }
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
                $('#payrollSearch').on('keyup', function() {
                    table.search(this.value).draw();
                    const resultText = table.page.info().recordsDisplay + ' hasil ditemukan';
                    console.log(resultText);
                });
            }
            @endif
        });
    </script>

    <style>
        /* Enhanced DataTables Styling */
        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            flex-direction: column;
            sm:flex-direction: row;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
            flex-wrap: wrap;
        }
        
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            min-width: 150px;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .dataTables_wrapper .dataTables_info {
            padding: 1rem 0;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 1rem;
        }
        
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            gap: 0.25rem;
            padding: 1rem 0;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-start;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.4rem 0.6rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
            color: #374151;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled):not(.current) {
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
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dataTables_wrapper .dataTables_filter input,
            .dataTables_wrapper .dataTables_length select {
                width: 100%;
                min-width: auto;
            }

            .dataTables_wrapper .dataTables_paginate {
                justify-content: center;
            }

            .dataTables_wrapper .dataTables_info {
                text-align: center;
                width: 100%;
            }
        }
    </style>

    <script>
        // Toggle dropdown function
        function toggleDropdown(id) {
            const dropdown = document.getElementById('dropdown-' + id);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
            
            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.add('hidden');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('button[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                    d.classList.add('hidden');
                });
            }
        });

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
