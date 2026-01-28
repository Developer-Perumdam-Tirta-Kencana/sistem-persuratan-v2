<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl md:text-3xl text-slate-900 leading-tight">
                    {{ __('Surat Notifikasi Pekerjaan') }}
                </h2>
                <p class="text-sm text-slate-600 mt-2">Kelola dan pantau semua surat notifikasi pekerjaan</p>
            </div>
            <a href="{{ route('job-notification-letters.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-semibold rounded-lg hover:shadow-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Surat Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-start animate-fade-in">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <div>
                    <h3 class="font-semibold">Sukses!</h3>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white shadow-xl rounded-2xl border border-slate-100 overflow-hidden">
                <!-- Header -->
                <div class="px-6 sm:px-8 py-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 via-white to-slate-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Daftar Surat</h3>
                            <p class="text-sm text-slate-600 mt-1">{{ $letters->total() }} surat dalam sistem</p>
                        </div>
                        <div class="flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <span class="text-slate-600">Menunggu</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="text-slate-600">Disetujui</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table id="jobNotificationTable" class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-100 border-b border-slate-200 hover:bg-slate-200 transition-colors">
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs">Instansi Tujuan</th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs">Jenis Pekerjaan</th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs">Tanggal Pelaksanaan</th>
                                <th class="px-6 py-4 text-left font-bold text-slate-700 uppercase tracking-wider text-xs">Status</th>
                                <th class="px-6 py-4 text-center font-bold text-slate-700 uppercase tracking-wider text-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($letters as $letter)
                            <tr class="hover:bg-slate-50 transition-colors duration-150 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-semibold text-slate-900">{{ $letter->instansi_tujuan }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-slate-700">{{ $letter->jenis_pekerjaan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-slate-700">{{ is_string($letter->hari_tanggal_pelaksanaan) ? $letter->hari_tanggal_pelaksanaan : ($letter->hari_tanggal_pelaksanaan ? $letter->hari_tanggal_pelaksanaan->format('d M Y') : '-') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($letter->status === 'menunggu_acc')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-yellow-800 bg-yellow-100 border border-yellow-300">
                                            <span class="w-2 h-2 rounded-full bg-yellow-600 mr-2"></span>
                                            Menunggu
                                        </span>
                                    @elseif($letter->status === 'disetujui')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-green-800 bg-green-100 border border-green-300">
                                            <span class="w-2 h-2 rounded-full bg-green-600 mr-2"></span>
                                            Disetujui
                                        </span>
                                    @elseif($letter->status === 'ditolak')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-red-800 bg-red-100 border border-red-300">
                                            <span class="w-2 h-2 rounded-full bg-red-600 mr-2"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-1.5 flex-wrap">
                                        <!-- View Dropdown -->
                                        <x-view-dropdown :route="route('job-notification-letters.previewFormat', $letter)" :id="$letter->id" />
                                        @if($letter->status === 'menunggu_acc')
                                        <a href="{{ route('job-notification-letters.edit', $letter) }}" class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-indigo-600 hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition-colors duration-150" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('job-notification-letters.destroy', $letter) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-100 rounded-lg transition-colors duration-150" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16">
                                    <div class="text-center">
                                        <div class="mb-4 flex justify-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="text-slate-700 font-semibold text-lg mb-2">Belum ada surat</p>
                                        <p class="text-slate-600 text-sm mb-6">Mulai dengan membuat surat notifikasi pekerjaan pertama Anda</p>
                                        <a href="{{ route('job-notification-letters.create') }}" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition-colors">
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
                            @forelse($letters as $letter)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-medium text-gray-900">{{ $letter->instansi_tujuan }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">{{ $letter->jenis_pekerjaan }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700">{{ is_string($letter->hari_tanggal_pelaksanaan) ? $letter->hari_tanggal_pelaksanaan : ($letter->hari_tanggal_pelaksanaan ? $letter->hari_tanggal_pelaksanaan->format('d M Y') : '-') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($letter->status === 'menunggu_acc')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Menunggu</span>
                                    @elseif($letter->status === 'disetujui')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Disetujui</span>
                                    @elseif($letter->status === 'ditolak')
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <!-- View Buttons with Paper Size Options -->
                                        <div class="relative inline-block text-left">
                                            <button onclick="toggleDropdown({{ $letter->id }})" class="inline-flex items-center px-4 py-2 text-xs font-medium text-blue-600 hover:bg-blue-50 border border-gray-300 rounded-lg shadow-sm bg-white transition">
                                                📄 Lihat Surat
                                                <svg class="ml-2 -mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <div id="dropdown-{{ $letter->id }}" class="hidden absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                                <div class="py-1">
                                                    <div class="px-4 py-2 text-xs font-semibold text-gray-700 border-b">Dengan Kop</div>
                                                    <a href="{{ route('job-notification-letters.previewFormat', $letter) }}?kop=1&paper=F4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-blue-50">
                                                        <span class="mr-2">📄</span> F4 (Folio)
                                                    </a>
                                                    <a href="{{ route('job-notification-letters.previewFormat', $letter) }}?kop=1&paper=A4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-blue-50">
                                                        <span class="mr-2">📄</span> A4
                                                    </a>
                                                    <div class="px-4 py-2 text-xs font-semibold text-gray-700 border-b border-t mt-1">Tanpa Kop</div>
                                                    <a href="{{ route('job-notification-letters.previewFormat', $letter) }}?kop=0&paper=F4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                                        <span class="mr-2">📋</span> F4 (Folio)
                                                    </a>
                                                    <a href="{{ route('job-notification-letters.previewFormat', $letter) }}?kop=0&paper=A4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                                        <span class="mr-2">📋</span> A4
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @if($letter->status === 'menunggu_acc')
                                        <a href="{{ route('job-notification-letters.edit', $letter) }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition" title="Edit surat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('job-notification-letters.destroy', $letter) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus surat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                        @endif
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
                                        <p class="text-gray-700 font-medium mb-2">Belum ada surat notifikasi pekerjaan</p>
                                        <p class="text-gray-600 text-sm mb-4">Mulai dengan membuat surat pertama Anda</p>
                                        <a href="{{ route('job-notification-letters.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
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
            $('#jobNotificationTable').DataTable({
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

        // F4 shortcut untuk view pertama dengan kop F4
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
