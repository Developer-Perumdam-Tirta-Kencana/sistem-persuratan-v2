<x-app-layout class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Surat</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payrollLetter->nomor_surat }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Surat</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payrollLetter->tanggal_surat->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Periode/Bulan Gaji</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payrollLetter->bulan_gaji }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tujuan Bank</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payrollLetter->bank_tujuan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Total Nominal</dt>
                        <dd class="mt-1 text-sm text-gray-900">Rp. {{ number_format($payrollLetter->total_nominal, 2, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Rekening Sumber</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payrollLetter->nomor_rekening_sumber }}</dd>
                    </div>
                </dl>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('payroll-letters.edit', $payrollLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <a href="{{ route('payroll-letters.export-pdf', $payrollLetter) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Export PDF
                    </a>
                    <form action="{{ route('payroll-letters.destroy', $payrollLetter) }}" method="POST" class="inline">
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
</x-app-layout>
