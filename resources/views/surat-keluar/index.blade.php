<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Surat Keluar</h2>
                <p class="text-sm text-gray-500">Kelola dan buat surat keluar dari template yang tersedia</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Template List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col flex-1">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Template Surat Keluar</h3>
                            <p class="text-sm text-gray-600 mt-1">Kelola dan buat surat keluar dari template yang tersedia</p>
                        </div>
                        <!-- Search Input -->
                        <div class="w-full sm:w-64 relative">
                            <input type="text" id="suratKeluarSearch" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto px-4 pt-4">
                    <table id="templatesTable" class="w-full text-sm">
                        <thead>
                            <tr class="bg-blue-100 border-b border-gray-200">
                                <th class="px-6 py-4 text-left">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Template</span>
                                </th>
                                <th class="px-6 py-4 text-left">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</span>
                                </th>
                                <th class="px-6 py-4 text-center">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</span>
                                </th>
                                <th class="px-6 py-4 text-center">
                                    <span class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Payroll</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat gaji/payroll karyawan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">{{ $payrollCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('payroll-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('payroll-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Pemberitahuan Pekerjaan</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat pemberitahuan penugasan pekerjaan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">{{ $jobNotificationCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('job-notification-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('job-notification-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Ketersediaan Air</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat penegasan ketersediaan air bersih</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-cyan-100 text-cyan-800">{{ $waterAvailabilityCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('water-availability-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('water-availability-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Rekomendasi</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat rekomendasi untuk pihak ketiga</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-amber-100 text-amber-800">{{ $recommendationCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('recommendation-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('recommendation-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Perintah Tugas (SPT)</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat perintah tugas untuk kegiatan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-orange-100 text-orange-800">{{ $taskOrderCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('task-order-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('task-order-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Kuasa Pelimpahan</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat kuasa untuk pelimpahan kewenangan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-purple-100 text-purple-800">{{ $delegationCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('delegation-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('delegation-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Pelimpahan Rekening</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat pelimpahan rekening bank</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">{{ $internalTransferCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('internal-transfer-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('internal-transfer-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Surat Izin Magang/PKL</td>
                                <td class="px-6 py-4 text-sm text-gray-700">Surat izin magang atau praktek kerja lapangan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center"><span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800">{{ $internshipCount }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('internship-permission-letters.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('internship-permission-letters.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-900 hover:bg-emerald-50 rounded transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Buat
                                        </a>
                                    </div>
                                </td>
                            </tr>
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
            // Prevent reinitializing DataTable
            if (!$.fn.DataTable.isDataTable('#templatesTable')) {
                $('#templatesTable').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ template per halaman",
                    zeroRecords: "Tidak ada template yang ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ template",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(disaring dari _MAX_ total template)",
                    search: "Cari template:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                },
                pageLength: 10,
                ordering: false,
                searching: true,
                paging: false,
                info: true,
                dom: '<"flex justify-between items-center mb-4"f>rt',
                columnDefs: [
                    { className: "text-center", targets: [2, 3] }
                ]
            });
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
        
        .dataTables_wrapper .dataTables_info {
            padding: 1rem 0;
            font-size: 0.875rem;
            color: #6b7280;
        }
    </style>
</x-app-layout>
