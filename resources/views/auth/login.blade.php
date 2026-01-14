<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-cyan-50 flex items-center justify-center px-4 py-10">
        <div class="max-w-5xl w-full grid lg:grid-cols-2 gap-8 items-center">
            <div class="hidden lg:block">
                <div class="relative p-10 rounded-2xl bg-white shadow-2xl border border-sky-100 overflow-hidden">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-sky-100 blur-3xl opacity-60"></div>
                    <div class="absolute -bottom-12 -right-6 w-44 h-44 bg-cyan-100 blur-3xl opacity-70"></div>
                    <div class="relative">
                        <p class="text-sm text-sky-700 font-semibold mb-3">Tirta Kencana e-Surat</p>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Login aman untuk alur persuratan formal</h2>
                        <p class="text-slate-700 mb-6">Masuk dengan kredensial Anda untuk mengelola surat masuk, disposisi, dan surat keluar dengan jejak audit lengkap.</p>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="p-4 rounded-xl bg-gradient-to-br from-sky-50 to-sky-100 border border-sky-200">
                                <p class="text-slate-700 font-medium">Keamanan</p>
                                <p class="text-lg font-bold text-sky-800">2FA Ready</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-sky-50 to-sky-100 border border-sky-200">
                                <p class="text-slate-700 font-medium">Peran</p>
                                <p class="text-lg font-bold text-sky-800">Admin/Staff/User</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-2xl border border-sky-100 rounded-2xl p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('logo.png') }}" alt="Tirta Kencana Logo" class="w-16 h-16 object-contain">
                        <div>
                            <p class="text-xs text-sky-700 uppercase tracking-wide font-semibold">Portal</p>
                            <h3 class="text-xl font-semibold text-slate-900">Login e-Surat</h3>
                        </div>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <x-label for="email" :value="__('Email')" class="text-slate-700" />
                            <x-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div>
                            <x-label for="password" :value="__('Password')" class="text-slate-700" />
                            <x-input id="password" class="block mt-2 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center text-sm text-slate-700">
                                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-sky-600 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-sky-700 hover:text-sky-900 font-medium" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full cta-ripple text-white py-3 rounded-lg font-semibold">
                                {{ __('Log in') }}
                            </button>
                        </div>

                        <div class="text-sm text-center text-slate-700">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-sky-700 hover:text-sky-900 font-semibold">Daftar sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
