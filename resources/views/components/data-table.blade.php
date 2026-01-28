@props(['headers', 'rows', 'actions', 'emptyMessage' => 'Tidak ada data', 'emptyIcon' => true])

<div class="bg-white shadow-lg rounded-xl border border-gray-100">
    <!-- Header dengan gradient -->
    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-slate-600 to-slate-700">
        <h3 class="text-lg font-bold text-white tracking-tight">{{ $slot }}</h3>
    </div>

    <!-- Table container dengan scroll responsif -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-gray-200 hover:bg-slate-100 transition-colors">
                    @foreach($headers as $header)
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold text-slate-700 uppercase tracking-widest">{{ $header }}</span>
                    </th>
                    @endforeach
                    @if($actions)
                    <th class="px-6 py-4 text-center">
                        <span class="text-xs font-bold text-slate-700 uppercase tracking-widest">Aksi</span>
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($rows as $row)
                <tr class="hover:bg-slate-50 transition-colors duration-150 group">
                    {{ $row }}
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($headers) + ($actions ? 1 : 0) }}" class="px-6 py-16">
                        <div class="text-center">
                            @if($emptyIcon)
                            <div class="mb-4 flex justify-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            @endif
                            <p class="text-slate-700 font-semibold text-lg mb-2">{{ $emptyMessage }}</p>
                            <p class="text-slate-500 text-sm">Tidak ada catatan untuk ditampilkan saat ini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
