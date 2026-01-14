@php
    $roleName = optional(Auth::user()->role)->name;
    $roleLabel = $roleName ? ucwords(str_replace('_', ' ', $roleName)) : 'User';
@endphp

<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="Tirta Kencana Logo" class="h-12 w-12 object-contain">
                    <div>
                        <p class="text-sm text-slate-500">Tirta Kencana</p>
                        <p class="text-base font-semibold text-slate-900">e-Surat Dashboard</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-3 text-sm">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Dashboard</a>
                    <a href="#" class="px-3 py-2 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100">Surat Masuk</a>
                    <a href="#" class="px-3 py-2 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100">Surat Keluar</a>
                    <a href="{{ route('admin.user-management') }}" class="px-3 py-2 rounded-md {{ request()->routeIs('admin.user-management') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">User</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">{{ $roleLabel }}</span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 transition duration-150 ease-in-out">
                            <div class="text-left leading-tight">
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="ml-3 h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-700 font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <svg class="ml-2 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.207l3.71-3.976a.75.75 0 111.08 1.04l-4.24 4.54a.75.75 0 01-1.08 0l-4.24-4.54a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ $roleLabel }}</p>
                        </div>
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profil Saya
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 bg-white/95 backdrop-blur">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">Surat Masuk</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Surat Keluar</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.user-management')" :active="request()->routeIs('admin.user-management')">User</x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200">
            <div class="px-4">
                <div class="font-medium text-base text-slate-900">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                <div class="mt-1 inline-flex px-2 py-1 text-xs rounded-md bg-slate-100 text-slate-700">{{ $roleLabel }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
