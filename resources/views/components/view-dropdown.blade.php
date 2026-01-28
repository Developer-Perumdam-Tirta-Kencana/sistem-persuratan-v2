@props(['route', 'id'])

<div class="relative inline-block text-left">
    <button onclick="toggleDropdown({{ $id }})" type="button" class="inline-flex items-center px-4 py-2 text-xs font-medium text-blue-600 hover:bg-blue-50 border border-gray-300 rounded-lg shadow-sm bg-white transition">
        📄 Lihat Surat
        <svg class="ml-2 -mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
    <div id="dropdown-{{ $id }}" class="hidden absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
        <div class="py-1">
            <div class="px-4 py-2 text-xs font-semibold text-gray-700 border-b">Dengan Kop</div>
            <a href="{{ $route }}?kop=1&paper=F4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-blue-50">
                <span class="mr-2">📄</span> F4 (Folio)
            </a>
            <a href="{{ $route }}?kop=1&paper=A4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-blue-50">
                <span class="mr-2">📄</span> A4
            </a>
            <div class="px-4 py-2 text-xs font-semibold text-gray-700 border-b border-t mt-1">Tanpa Kop</div>
            <a href="{{ $route }}?kop=0&paper=F4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">
                <span class="mr-2">📋</span> F4 (Folio)
            </a>
            <a href="{{ $route }}?kop=0&paper=A4" target="_blank" class="flex items-center px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">
                <span class="mr-2">📋</span> A4
            </a>
        </div>
    </div>
</div>
