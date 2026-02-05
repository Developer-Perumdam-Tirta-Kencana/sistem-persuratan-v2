<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Pelimpahan Rekening') }}
        </h2>
        <a href="{{ route('internal-transfer-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Bank Asal</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internalTransferLetter->bank_sumber }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">No. Rekening Asal</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internalTransferLetter->no_rek_sumber }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Nominal</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($internalTransferLetter->nominal, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Bank Tujuan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internalTransferLetter->bank_tujuan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">No. Rekening Tujuan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $internalTransferLetter->no_rek_tujuan }}</dd>
                    </div>
                </dl>

                <!-- Document Viewer Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pratinjau Dokumen</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                        @php($withKop = $withKop ?? true)
                        <iframe src="{{ route('internal-transfer-letters.previewFormat', [$internalTransferLetter, 'mode' => 'pdf', 'kop' => $withKop ? '1' : '0']) }}" 
                                class="w-full border-0" 
                                style="height: 600px;"
                                frameborder="0">
                        </iframe>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-2 flex-wrap">
                    <a href="{{ route('internal-transfer-letters.exportPdf', $internalTransferLetter) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </a>
                    <a href="{{ route('internal-transfer-letters.exportDocx', $internalTransferLetter) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download DOCX
                    </a>
                    <a href="{{ route('internal-transfer-letters.edit', $internalTransferLetter) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('internal-transfer-letters.destroy', $internalTransferLetter) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition" onclick="return confirm('Yakin ingin menghapus?')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>