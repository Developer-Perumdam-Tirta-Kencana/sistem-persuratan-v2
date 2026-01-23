<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Surat Kuasa Pelimpahan') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('delegation-letters.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="pemberi_kuasa_1_id" class="block text-gray-700 text-sm font-bold mb-2">Pemberi Kuasa 1 (Direktur) *</label>
                        <select name="pemberi_kuasa_1_id" id="pemberi_kuasa_1_id" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pemberi_kuasa_1_id') border-red-500 @enderror" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('pemberi_kuasa_1_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('pemberi_kuasa_1_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pemberi_kuasa_2_id" class="block text-gray-700 text-sm font-bold mb-2">Pemberi Kuasa 2 (Kabag Keu) *</label>
                        <select name="pemberi_kuasa_2_id" id="pemberi_kuasa_2_id" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pemberi_kuasa_2_id') border-red-500 @enderror" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('pemberi_kuasa_2_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('pemberi_kuasa_2_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="penerima_kuasa_id" class="block text-gray-700 text-sm font-bold mb-2">Penerima Kuasa (Staf) *</label>
                        <select name="penerima_kuasa_id" id="penerima_kuasa_id" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('penerima_kuasa_id') border-red-500 @enderror" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('penerima_kuasa_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('penerima_kuasa_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tujuan_transaksi" class="block text-gray-700 text-sm font-bold mb-2">Untuk Keperluan *</label>
                        <textarea name="tujuan_transaksi" id="tujuan_transaksi" rows="4" 
                            placeholder="Contoh: Melakukan pencairan cek..."
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tujuan_transaksi') border-red-500 @enderror" required>{{ old('tujuan_transaksi') }}</textarea>
                        @error('tujuan_transaksi')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                        <a href="{{ route('delegation-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
