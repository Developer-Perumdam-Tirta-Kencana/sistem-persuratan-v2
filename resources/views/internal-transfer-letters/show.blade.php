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

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('internal-transfer-letters.edit', $internalTransferLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <form action="{{ route('internal-transfer-letters.destroy', $internalTransferLetter) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>