<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profil Saya</h2>
                <p class="text-sm text-gray-500">Kelola informasi profil dan keamanan akun Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Information -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Profil</h3>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi profil dan alamat email Anda</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center space-x-6">
                        <div class="h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-3xl">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500 mb-1">Role Anda</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-800">
                                {{ ucfirst(str_replace('_', ' ', auth()->user()->role->name)) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                                   class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                   class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">Bergabung sejak {{ $user->created_at->format('d M Y') }}</p>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Ubah Password</h3>
                    <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang kuat dan aman</p>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required 
                               class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                               autocomplete="current-password">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="password" required 
                                   class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   autocomplete="new-password">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required 
                                   class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   autocomplete="new-password">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow-sm sm:rounded-lg border-2 border-rose-200">
                <div class="p-6 border-b border-rose-200">
                    <h3 class="text-lg font-semibold text-rose-900">Hapus Akun</h3>
                    <p class="text-sm text-rose-600 mt-1">Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <div class="p-6">
                    <button onclick="openDeleteModal()" class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition">
                        Hapus Akun Saya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-rose-100">
                        <svg class="h-6 w-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 ml-3">Konfirmasi Hapus Akun</h3>
                </div>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan dan semua data Anda akan dihapus secara permanen.
                </p>
                <p class="text-sm text-gray-600">
                    Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
                </p>
            </div>

            <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full border-gray-300 rounded-md focus:ring-rose-500 focus:border-rose-500"
                           placeholder="Masukkan password Anda">
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-rose-600 text-white rounded-lg text-sm font-semibold hover:bg-rose-700">
                        Ya, Hapus Akun Saya
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
