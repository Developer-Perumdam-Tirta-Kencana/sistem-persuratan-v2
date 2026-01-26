<x-app-layout>
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
        <!-- Status Badge -->
        <div class="mb-4">
            @if($internshipPermissionLetter->status === 'menunggu_acc')
                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-semibold">Status: Menunggu Approval</span>
            @elseif($internshipPermissionLetter->status === 'disetujui')
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">Status: Disetujui</span>
                @if($internshipPermissionLetter->approver)
                    <p class="text-sm text-gray-600 mt-2">Disetujui oleh: {{ $internshipPermissionLetter->approver->name }} pada {{ $internshipPermissionLetter->approved_at ? $internshipPermissionLetter->approved_at->translatedFormat('d F Y H:i') : '' }}</p>
                @endif
            @elseif($internshipPermissionLetter->status === 'ditolak')
                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg font-semibold">Status: Ditolak</span>
                @if($internshipPermissionLetter->approver)
                    <p class="text-sm text-gray-600 mt-2">Ditolak oleh: {{ $internshipPermissionLetter->approver->name }} pada {{ $internshipPermissionLetter->approved_at ? $internshipPermissionLetter->approved_at->translatedFormat('d F Y H:i') : '' }}</p>
                    @if($internshipPermissionLetter->approval_notes)
                        <p class="text-sm text-red-600 mt-1">Alasan: {{ $internshipPermissionLetter->approval_notes }}</p>
                    @endif
                @endif
            @endif
        </div>

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

                <!-- Document Viewer Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pratinjau Dokumen</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                        <iframe src="{{ route('internship-permission-letters.previewFormat', $internshipPermissionLetter) }}" 
                                class="w-full border-0" 
                                style="height: 600px;"
                                frameborder="0">
                        </iframe>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-2 flex-wrap">
                    <a href="{{ route('internship-permission-letters.exportPdf', $internshipPermissionLetter) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </a>
                    <a href="{{ route('internship-permission-letters.exportDocx', $internshipPermissionLetter) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download DOCX
                    </a>
                    @if($internshipPermissionLetter->status === 'menunggu_acc')
                    <a href="{{ route('internship-permission-letters.edit', $internshipPermissionLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    @endif

                    @php
                        $isApprover = auth()->user() && (
                            auth()->user()->role_id === null || 
                            (auth()->user()->role && in_array(auth()->user()->role->name, ['Direktur', 'Kepala Divisi', 'Staf']))
                        );
                    @endphp

                    @if($isApprover && $internshipPermissionLetter->status === 'menunggu_acc')
                    <button onclick="document.getElementById('approveModal').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">
                        Setujui
                    </button>
                    <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        Tolak
                    </button>
                    @endif

                    @if($internshipPermissionLetter->status === 'menunggu_acc')
                    <form action="{{ route('internship-permission-letters.destroy', $internshipPermissionLetter) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Setujui Surat</h3>
        <form action="{{ route('internship-permission-letters.approveAction', $internshipPermissionLetter) }}" method="POST">
            @csrf
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Apakah Anda yakin ingin menyetujui surat ini?</p>
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (opsional)</label>
                <textarea name="approval_notes" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3"></textarea>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('approveModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">Setujui</button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tolak Surat</h3>
        <form action="{{ route('internship-permission-letters.rejectAction', $internshipPermissionLetter) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-600">*</span></label>
                <textarea name="approval_notes" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" required></textarea>
                @error('approval_notes')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Tolak</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
