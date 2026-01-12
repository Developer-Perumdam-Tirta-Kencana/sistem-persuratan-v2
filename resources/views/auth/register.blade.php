<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-cyan-50 flex items-center justify-center px-4 py-10">
        <div class="max-w-5xl w-full grid lg:grid-cols-2 gap-8 items-center">
            <div class="hidden lg:block">
                <div class="relative p-10 rounded-2xl bg-white shadow-2xl border border-sky-100 overflow-hidden">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-sky-100 blur-3xl opacity-60"></div>
                    <div class="absolute -bottom-12 -right-6 w-44 h-44 bg-cyan-100 blur-3xl opacity-70"></div>
                    <div class="relative">
                        <p class="text-sm text-sky-700 font-semibold mb-3">Tirta Kencana e-Surat</p>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Buat akun untuk mulai mengalirkan surat</h2>
                        <p class="text-slate-700 mb-6">Registrasi aman dengan penetapan role default sebagai pengguna. Hak akses bisa ditingkatkan oleh admin.</p>
                        <ul class="space-y-3 text-sm text-slate-700">
                            <li class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-sky-600"></span><span>Audit trail otomatis setiap tindakan</span></li>
                            <li class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-sky-600"></span><span>Template surat resmi Tirta Kencana</span></li>
                            <li class="flex items-center space-x-2"><span class="w-2 h-2 rounded-full bg-sky-600"></span><span>Notifikasi status disposisi</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-2xl border border-sky-100 rounded-2xl p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-semibold">TK</div>
                        <div>
                            <p class="text-xs text-sky-700 uppercase tracking-wide font-semibold">Portal</p>
                            <h3 class="text-xl font-semibold text-slate-900">Registrasi e-Surat</h3>
                        </div>
                    </div>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <x-label for="name" :value="__('Name')" class="text-slate-700" />
                            <x-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div>
                            <x-label for="email" :value="__('Email')" class="text-slate-700" />
                            <x-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div>
                            <x-label for="password" :value="__('Password')" class="text-slate-700" />
                            <x-input id="password" class="block mt-2 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div>
                            <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700" />
                            <x-input id="password_confirmation" class="block mt-2 w-full" type="password" name="password_confirmation" required />
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full cta-ripple text-white py-3 rounded-lg font-semibold">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <div class="text-sm text-center text-slate-700">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-sky-700 hover:text-sky-900 font-semibold">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
