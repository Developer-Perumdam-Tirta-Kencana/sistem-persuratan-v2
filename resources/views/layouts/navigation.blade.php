@php
    $roleName = optional(Auth::user()->role)->name;
    $roleLabel = $roleName ? ucwords(str_replace('_', ' ', $roleName)) : 'User';
@endphp

<nav class="bg-white border-b border-blue-200 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo & Brand -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('logo.png') }}" alt="Tirta Kencana Logo" class="h-12 w-12 object-contain transform group-hover:scale-110 transition-transform duration-300">
                <div>
                    <p class="text-xs text-blue-500 uppercase tracking-widest font-semibold">Perumda</p>
                    <p class="text-lg font-bold text-blue-900">Tirta Kencana</p>
                </div>
            </a>

            <!-- Right Navigation -->
            <div class="flex items-center space-x-6">
                <!-- Desktop Sidebar Toggle (Hidden on Mobile) -->
                <button id="sidebarToggle" class="hidden md:block p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-100 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400" aria-label="Toggle Sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Role Badge -->
                <span class="hidden sm:inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-blue-400 to-blue-500 text-white border border-blue-300 shadow-lg">{{ $roleLabel }}</span>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-blue-700 hover:text-blue-900 transition duration-150 ease-in-out">
                            <div class="text-right leading-tight hidden sm:block">
                                <p class="font-semibold text-blue-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-blue-600">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="ml-3 h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center text-white font-bold shadow-lg hover:shadow-xl transition-shadow duration-300">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <svg class="ml-2 h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.207l3.71-3.976a.75.75 0 111.08 1.04l-4.24 4.54a.75.75 0 01-1.08 0l-4.24-4.54a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-blue-200 bg-gradient-to-r from-blue-50 to-blue-100">
                            <p class="text-sm font-bold text-blue-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-blue-700">{{ $roleLabel }}</p>
                        </div>
                        <a href="{{ route('profile.show') }}" class="block px-4 py-3 text-sm text-blue-800 hover:bg-blue-100 transition-colors border-l-4 border-transparent hover:border-blue-500">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="font-medium">Profil Saya</span>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors border-l-4 border-transparent hover:border-red-500">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span class="font-medium">Keluar</span>
                                </div>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300 opacity-0 pointer-events-none" aria-hidden="true"></div>

<!-- Sidebar Navigation -->
<aside id="navigationSidebar" class="fixed top-16 left-0 h-[calc(100vh-4rem)] z-50 -translate-x-full transition-transform duration-300 ease-in-out bg-gradient-to-b from-blue-50 to-blue-100 shadow-2xl rounded-r-lg p-5 w-[280px] sm:w-[320px] overflow-y-auto" role="dialog" aria-label="Navigation sidebar">
    <button id="closeSidebar" class="absolute top-4 right-4 text-blue-400 hover:text-blue-600 transition-colors z-10 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg p-1" aria-label="Close Sidebar">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <div class="flex items-center gap-3 mb-6">
        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 text-white flex items-center justify-center font-bold text-lg shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs uppercase text-blue-600 font-semibold tracking-wider">Menu Surat</p>
            <p class="font-semibold text-blue-900">{{ Auth::user()->name }}</p>
        </div>
    </div>

    <nav class="space-y-5 text-sm text-blue-800">
        <div>
            <p class="text-xs uppercase text-blue-600 font-bold tracking-wider mb-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda
            </p>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('dashboard') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a href="{{ route('surat-keluar.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('surat-keluar.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm">Surat Keluar</span>
                </a>
            </div>
        </div>

        <div>
            <p class="text-xs uppercase text-blue-600 font-bold tracking-wider mb-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Template Surat
            </p>
            <div class="space-y-1">
                <a href="{{ route('payroll-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('payroll-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm">Surat Payroll</span>
                </a>
                <a href="{{ route('job-notification-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('job-notification-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm">Notifikasi Pekerjaan</span>
                </a>
                <a href="{{ route('water-availability-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('water-availability-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    <span class="text-sm">Ketersediaan Air</span>
                </a>
                <a href="{{ route('recommendation-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('recommendation-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm">Surat Rekomendasi</span>
                </a>
                <a href="{{ route('task-order-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('task-order-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span class="text-sm">Surat Perintah Tugas</span>
                </a>
                <a href="{{ route('delegation-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('delegation-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="text-sm">Surat Penugasan</span>
                </a>
                <a href="{{ route('internal-transfer-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('internal-transfer-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span class="text-sm">Transfer Internal</span>
                </a>
                <a href="{{ route('internship-permission-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('internship-permission-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-sm">Surat Izin Magang</span>
                </a>
            </div>
        </div>

        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('direktur'))
        <div>
            <p class="text-xs uppercase text-blue-600 font-bold tracking-wider mb-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Admin
            </p>
            <div class="space-y-1">
                <a href="{{ route('approval-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-200 transition-all duration-200 touch-manipulation {{ request()->routeIs('approval-letters.*') ? 'bg-blue-300 text-blue-900 font-semibold' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm">Persetujuan Surat</span>
                </a>
            </div>
        </div>
        @endif
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('navigationSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebarFunc() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100');
            document.body.classList.remove('overflow-hidden');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', openSidebar);
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', closeSidebarFunc);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebarFunc);
        }
    });
</script>
