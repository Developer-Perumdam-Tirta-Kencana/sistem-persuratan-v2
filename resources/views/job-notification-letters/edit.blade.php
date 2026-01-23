<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Surat Pemberitahuan Pekerjaan') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('job-notification-letters.update', $jobNotificationLetter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="instansi_tujuan" class="block text-gray-700 text-sm font-bold mb-2">Instansi Tujuan *</label>
                        <input type="text" name="instansi_tujuan" id="instansi_tujuan" value="{{ old('instansi_tujuan', $jobNotificationLetter->instansi_tujuan) }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('instansi_tujuan') border-red-500 @enderror" required>
                        @error('instansi_tujuan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis_pekerjaan" class="block text-gray-700 text-sm font-bold mb-2">Jenis Pekerjaan *</label>
                        <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" value="{{ old('jenis_pekerjaan', $jobNotificationLetter->jenis_pekerjaan) }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_pekerjaan') border-red-500 @enderror" required>
                        @error('jenis_pekerjaan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="lokasi_pekerjaan" class="block text-gray-700 text-sm font-bold mb-2">Lokasi *</label>
                        <textarea name="lokasi_pekerjaan" id="lokasi_pekerjaan" rows="3" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi_pekerjaan') border-red-500 @enderror" required>{{ old('lokasi_pekerjaan', $jobNotificationLetter->lokasi_pekerjaan) }}</textarea>
                        @error('lokasi_pekerjaan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="hari_tanggal_pelaksanaan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pelaksanaan *</label>
                        <input type="text" name="hari_tanggal_pelaksanaan" id="hari_tanggal_pelaksanaan" value="{{ old('hari_tanggal_pelaksanaan', $jobNotificationLetter->hari_tanggal_pelaksanaan) }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hari_tanggal_pelaksanaan') border-red-500 @enderror" required>
                        @error('hari_tanggal_pelaksanaan')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="waktu_mulai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" 
                                value="{{ old('waktu_mulai', $jobNotificationLetter->waktu_mulai ? $jobNotificationLetter->waktu_mulai->format('H:i') : '') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('waktu_mulai') border-red-500 @enderror">
                            @error('waktu_mulai')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="waktu_selesai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" 
                                value="{{ old('waktu_selesai', $jobNotificationLetter->waktu_selesai ? $jobNotificationLetter->waktu_selesai->format('H:i') : '') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('waktu_selesai') border-red-500 @enderror">
                            @error('waktu_selesai')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update
                        </button>
                        <a href="{{ route('job-notification-letters.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>