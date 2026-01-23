<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button id="toggleSidebar" class="lg:hidden text-gray-600 hover:text-indigo-600 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg p-1" aria-label="Toggle Sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
                    <p class="text-sm text-gray-500 hidden sm:block">Ringkasan aktivitas dan navigasi cepat</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.user-management') }}" class="text-sm text-indigo-600 hover:text-indigo-700 transition-colors hidden sm:inline">Kelola User</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 lg:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden transition-opacity duration-300 opacity-0 pointer-events-none" aria-hidden="true"></div>
            
            <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-6 relative">
                <aside id="sidebar" class="fixed lg:relative top-0 left-0 h-full lg:h-auto z-50 lg:z-0 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out bg-white shadow-2xl lg:shadow-sm rounded-none lg:rounded-lg p-5 w-[280px] sm:w-[320px] lg:w-[280px] overflow-y-auto lg:sticky lg:top-20 lg:self-start max-h-screen" role="dialog" aria-label="Navigation sidebar">
                    <!-- Close button for mobile -->
                    <button id="closeSidebar" class="lg:hidden absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg p-1" aria-label="Close Sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="flex items-center gap-3 mb-6 animate-fadeIn">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700 text-white flex items-center justify-center font-bold text-lg shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Manager PDAM</p>
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <nav class="space-y-5 text-sm text-gray-700">
                        <div class="animate-slideIn" style="animation-delay: 0.1s;">
                            <p class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Utama
                            </p>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 touch-manipulation {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'hover:bg-gray-50 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span class="text-sm sm:text-base">Dashboard</span>
                            </a>
                        </div>

                        <div class="animate-slideIn" style="animation-delay: 0.2s;">
                            <p class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Modul Surat
                            </p>
                            <div class="space-y-1">
                                <a href="{{ route('surat-keluar.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('surat-keluar.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="text-sm">Surat Keluar</span>
                                </a>
                            </div>
                        </div>

                        <div class="animate-slideIn" style="animation-delay: 0.25s;">
                            <p class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Template Surat
                            </p>
                            <div class="space-y-1">
                                <a href="{{ route('payroll-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('payroll-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm">Surat Payroll</span>
                                </a>
                                <a href="{{ route('job-notification-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('job-notification-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <span class="text-sm">Surat Pemberitahuan</span>
                                </a>
                                <a href="{{ route('water-availability-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('water-availability-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm">Surat Ketersediaan Air</span>
                                </a>
                                <a href="{{ route('recommendation-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('recommendation-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm">Surat Rekomendasi</span>
                                </a>
                                <a href="{{ route('task-order-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('task-order-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-sm">Surat Tugas</span>
                                </a>
                                <a href="{{ route('delegation-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('delegation-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                    <span class="text-sm">Surat Delegasi</span>
                                </a>
                                <a href="{{ route('internal-transfer-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('internal-transfer-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                    <span class="text-sm">Surat Mutasi Internal</span>
                                </a>
                                <a href="{{ route('internship-permission-letters.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation {{ request()->routeIs('internship-permission-letters.*') ? 'bg-gray-100 text-indigo-600 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <span class="text-sm">Surat Izin Magang</span>
                                </a>
                            </div>
                        </div>

                        <div class="animate-slideIn" style="animation-delay: 0.3s;">
                            <p class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Surat Masuk
                            </p>
                            <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:translate-x-1 touch-manipulation">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-sm sm:text-base">Daftar Surat Masuk</span>
                            </a>
                        </div>

                        <div class="animate-slideIn" style="animation-delay: 0.4s;">
                            <p class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Management User
                            </p>
                            <a href="{{ route('admin.user-management') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg transition-all duration-200 touch-manipulation {{ request()->routeIs('admin.user-management') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'hover:bg-gray-50 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm sm:text-base">Kelola User & Role</span>
                            </a>
                        </div>
                    </nav>
                </aside>

                <main class="space-y-6 w-full">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 flex flex-col gap-2">
                            <h3 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-gray-600">Anda login sebagai <span class="font-semibold text-indigo-600">Administrator</span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Users</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                                </div>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Surat Masuk</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Surat Keluar</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Pending</p>
                                    <p class="text-2xl font-semibold text-gray-900">0</p>
                                </div>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <a href="{{ route('admin.user-management') }}" class="group flex items-center justify-between bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-4 px-5 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <span>Kelola User</span>
                                    </div>
                                    <span class="text-xs bg-white/20 px-2.5 py-1 rounded-full">Akses</span>
                                </a>
                                <button class="group flex items-center justify-between bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold py-4 px-5 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span>Lihat Laporan</span>
                                    </div>
                                    <span class="text-xs bg-white/20 px-2.5 py-1 rounded-full">Baru</span>
                                </button>
                                <button class="group flex items-center justify-between bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-4 px-5 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>Pengaturan</span>
                                    </div>
                                    <span class="text-xs bg-white/20 px-2.5 py-1 rounded-full">Config</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 500px;
            }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
        
        .animate-slideIn {
            animation: slideIn 0.6s ease-out;
            animation-fill-mode: both;
        }
        
        .animate-slideDown {
            animation: slideDown 0.3s ease-out;
            overflow: hidden;
        }

        /* Prevent body scroll when sidebar is open on mobile */
        body.sidebar-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100vh;
        }

        @media (min-width: 1024px) {
            body.sidebar-open {
                overflow: auto;
                position: static;
                width: auto;
                height: auto;
            }
        }

        /* Sidebar improvements */
        #sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.7);
        }

        /* Overlay transitions */
        #sidebarOverlay {
            transition: opacity 0.3s ease-in-out;
        }

        #sidebarOverlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Touch optimization for mobile */
        @media (max-width: 1023px) {
            .touch-manipulation {
                -webkit-tap-highlight-color: rgba(99, 102, 241, 0.1);
            }
        }
    </style>

    <script>
        // Toggle sidebar for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const closeSidebar = document.getElementById('closeSidebar');

        // Initialize: Ensure sidebar is closed on mobile by default
        function initSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            }
        }

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            // Use setTimeout to ensure the transition happens
            setTimeout(() => {
                sidebarOverlay.classList.add('active');
            }, 10);
            document.body.classList.add('sidebar-open');
            // Set focus to close button for accessibility
            if (closeSidebar) {
                closeSidebar.focus();
            }
        }

        function closeSidebarMenu() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }

        // Event listeners
        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', (e) => {
                e.stopPropagation();
                openSidebar();
            });
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', (e) => {
                e.stopPropagation();
                closeSidebarMenu();
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebarMenu);
        }

        // Close sidebar when clicking on a link (mobile only)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebarMenu();
                }
            });
        });

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                initSidebar();
            }, 250);
        });

        // Handle escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && window.innerWidth < 1024) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    closeSidebarMenu();
                }
            }
        });

        // Prevent scrolling on touch devices when sidebar is open
        let touchStartY = 0;
        
        if (sidebar) {
            sidebar.addEventListener('touchstart', (e) => {
                touchStartY = e.touches[0].clientY;
            }, { passive: true });

            sidebar.addEventListener('touchmove', (e) => {
                const sidebar = e.currentTarget;
                const scrollTop = sidebar.scrollTop;
                const scrollHeight = sidebar.scrollHeight;
                const height = sidebar.clientHeight;
                const deltaY = e.touches[0].clientY - touchStartY;

                // Prevent overscroll bounce
                if ((scrollTop === 0 && deltaY > 0) || 
                    (scrollTop + height >= scrollHeight && deltaY < 0)) {
                    e.preventDefault();
                }
            }, { passive: false });
        }

        // Initialize on page load
        initSidebar();
    </script>
</x-app-layout>
