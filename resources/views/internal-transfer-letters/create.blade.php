@extends('layouts.app')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Surat Pelimpahan Rekening') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('internal-transfer-letters.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="bank_sumber" class="block text-gray-700 text-sm font-bold mb-2">Bank Asal *</label>
                        <input type="text" name="bank_sumber" id="bank_sumber" value="{{ old('bank_sumber') }}" 
                            placeholder="Contoh: Bank BTN"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bank_sumber') border-red-500 @enderror" required>
                        @error('bank_sumber')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_rek_sumber" class="block text-gray-700 text-sm font-bold mb-2">No. Rekening Asal *</label>
                        <input type="text" name="no_rek_sumber" id="no_rek_sumber" value="{{ old('no_rek_sumber') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_rek_sumber') border-red-500 @enderror" required>
                        @error('no_rek_sumber')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nominal" class="block text-gray-700 text-sm font-bold mb-2">Nominal (Rp) *</label>
                        <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}" min="0" step="0.01"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nominal') border-red-500 @enderror" required>
                        @error('nominal')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bank_tujuan" class="block text-gray-700 text-sm font-bold mb-2">Bank Tujuan *</label>
                        <input type="text" name="bank_tujuan" id="bank_tujuan" value="{{ old('bank_tujuan') }}" 
                            placeholder="Contoh: Bank Jatim"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bank_tujuan') border-red-500 @enderror" required>
                        @error('bank_tujuan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_rek_tujuan" class="block text-gray-700 text-sm font-bold mb-2">No. Rekening Tujuan *</label>
                        <input type="text" name="no_rek_tujuan" id="no_rek_tujuan" value="{{ old('no_rek_tujuan') }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_rek_tujuan') border-red-500 @enderror" required>
                        @error('no_rek_tujuan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('internal-transfer-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
