<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Pemberitahuan Pekerjaan') }}
        </h2>
        <a href="{{ route('job-notification-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Status Badge -->
        <div class="mb-4">
            @if($jobNotificationLetter->status === 'menunggu_acc')
                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg font-semibold">Status: Menunggu Approval</span>
            @elseif($jobNotificationLetter->status === 'disetujui')
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">Status: Disetujui</span>
                @if($jobNotificationLetter->approver)
                    <p class="text-sm text-gray-600 mt-2">Disetujui oleh: {{ $jobNotificationLetter->approver->name }} pada {{ $jobNotificationLetter->approved_at ? $jobNotificationLetter->approved_at->translatedFormat('d F Y H:i') : '' }}</p>
                @endif
            @elseif($jobNotificationLetter->status === 'ditolak')
                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg font-semibold">Status: Ditolak</span>
                @if($jobNotificationLetter->approver)
                    <p class="text-sm text-gray-600 mt-2">Ditolak oleh: {{ $jobNotificationLetter->approver->name }} pada {{ $jobNotificationLetter->approved_at ? $jobNotificationLetter->approved_at->translatedFormat('d F Y H:i') : '' }}</p>
                    @if($jobNotificationLetter->approval_notes)
                        <p class="text-sm text-red-600 mt-1">Alasan: {{ $jobNotificationLetter->approval_notes }}</p>
                    @endif
                @endif
            @endif
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Instansi Tujuan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $jobNotificationLetter->instansi_tujuan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Jenis Pekerjaan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $jobNotificationLetter->jenis_pekerjaan }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Lokasi Pekerjaan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $jobNotificationLetter->lokasi_pekerjaan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Pelaksanaan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $jobNotificationLetter->hari_tanggal_pelaksanaan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Waktu</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $jobNotificationLetter->waktu_mulai ? $jobNotificationLetter->waktu_mulai->format('H:i') : '-' }}
                            s/d
                            {{ $jobNotificationLetter->waktu_selesai ? $jobNotificationLetter->waktu_selesai->format('H:i') : '-' }}
                        </dd>
                    </div>
                </dl>

                <!-- Document Viewer Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pratinjau Dokumen</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                        <iframe src="{{ route('job-notification-letters.previewFormat', $jobNotificationLetter) }}" 
                                class="w-full border-0" 
                                style="height: 600px;"
                                frameborder="0">
                        </iframe>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-2 flex-wrap">
                    <a href="{{ route('job-notification-letters.exportPdf', $jobNotificationLetter) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </a>
                    <a href="{{ route('job-notification-letters.exportDocx', $jobNotificationLetter) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download DOCX
                    </a>
                
                    @if($jobNotificationLetter->status === 'menunggu_acc')
                    <a href="{{ route('job-notification-letters.edit', $jobNotificationLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    @endif
                    
                    @php
                        $isApprover = auth()->user() && (
                            auth()->user()->role_id === null || 
                            (auth()->user()->role && in_array(auth()->user()->role->name, ['Direktur', 'Kepala Divisi', 'Staf']))
                        );
                    @endphp

                    @if($isApprover && $jobNotificationLetter->status === 'menunggu_acc')
                        <button onclick="document.getElementById('approveModal').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded">
                            Setujui
                        </button>
                        <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                            Tolak
                        </button>

                    @endif

                    @if($jobNotificationLetter->status === 'menunggu_acc')
                    <form action="{{ route('job-notification-letters.destroy', $jobNotificationLetter) }}" method="POST" class="inline">
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
        <form action="{{ route('job-notification-letters.approveAction', $jobNotificationLetter) }}" method="POST">
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
        <form action="{{ route('job-notification-letters.rejectAction', $jobNotificationLetter) }}" method="POST">
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