<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Surat Perintah Tugas (SPT)') }}
        </h2>
        <a href="{{ route('task-order-letters.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dasar Surat</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->dasar_surat }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Daftar Petugas</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ol class="list-decimal list-inside">
                                @foreach($taskOrderLetter->list_petugas as $petugas)
                                <li>{{ $petugas }}</li>
                                @endforeach
                            </ol>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal Tugas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->hari_tanggal_tugas }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Waktu Tugas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->waktu_tugas }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tempat Tugas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->tempat_tugas }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Keperluan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->keperluan_tugas }}</dd>
                    </div>
                    @if($taskOrderLetter->pakaian)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dresscode/Pakaian</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $taskOrderLetter->pakaian }}</dd>
                    </div>
                    @endif
                </dl>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('task-order-letters.edit', $taskOrderLetter) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <form action="{{ route('task-order-letters.destroy', $taskOrderLetter) }}" method="POST" class="inline">
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