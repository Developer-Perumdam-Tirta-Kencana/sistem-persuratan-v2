# Standard Action Buttons Template untuk Semua Letters

## Pattern untuk Tombol View & Export dengan Opsi Kop

Ganti tombol aksi pada setiap template index dengan pattern ini:

```html
<div class="flex justify-center gap-2 flex-wrap">
    <!-- View Buttons Group -->
    <div class="inline-flex rounded-lg border border-gray-300 bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <a href="{{ route('[ROUTE].show', $letter) }}?kop=1" title="Lihat dengan kop (F4)" class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50 border-r border-gray-200 transition">📄 Kop</a>
        <a href="{{ route('[ROUTE].show', $letter) }}?kop=0" title="Lihat tanpa kop" class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-100 transition">📋 Tanpa</a>
    </div>

    <!-- Export PDF Group -->
    <div class="inline-flex rounded-lg border border-gray-300 bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <a href="{{ route('[ROUTE].exportPdf', $letter) }}?kop=1" title="Export PDF dengan kop" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 border-r border-gray-200 transition">
            <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>Kop
        </a>
        <a href="{{ route('[ROUTE].exportPdf', $letter) }}?kop=0" title="Export PDF tanpa kop" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 transition">
            Tanpa
        </a>
    </div>

    <!-- Export DOCX Group -->
    <div class="inline-flex rounded-lg border border-gray-300 bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <a href="{{ route('[ROUTE].exportDocx', $letter) }}?kop=1" title="Export Word dengan kop" class="px-3 py-1.5 text-xs font-medium text-orange-600 hover:bg-orange-50 border-r border-gray-200 transition">
            <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Kop
        </a>
        <a href="{{ route('[ROUTE].exportDocx', $letter) }}?kop=0" title="Export Word tanpa kop" class="px-3 py-1.5 text-xs font-medium text-orange-600 hover:bg-orange-50 transition">
            Tanpa
        </a>
    </div>

    <!-- Edit Button -->
    @if($letter->status === 'menunggu_acc' || auth()->user()->role->name === 'manager')
    <a href="{{ route('[ROUTE].edit', $letter) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition" title="Edit surat">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
    </a>
    @endif

    <!-- Delete Button -->
    @if(auth()->user()->role->name === 'manager')
    <form action="{{ route('[ROUTE].destroy', $letter) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition" onclick="return confirm('Yakin ingin menghapus surat ini?')" title="Hapus surat">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </form>
    @endif
</div>
```

## JavaScript untuk F4 Shortcut

Tambahkan script ini di bawah setiap halaman index:

```javascript
<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'F4') {
            event.preventDefault();
            // Cari tombol pertama dengan class "kop-button" atau link first
            const firstViewButton = document.querySelector('a[title*="dengan kop"]');
            if (firstViewButton) {
                firstViewButton.click();
            }
        }
    });
</script>
```

## List Template yang Perlu Diupdate:
1. ✅ payroll-letters/index.blade.php
2. ✅ job-notification-letters/index.blade.php
3. ✅ task-order-letters/index.blade.php
4. ✅ delegation-letters/index.blade.php
5. ✅ internal-transfer-letters/index.blade.php
6. ✅ internship-permission-letters/index.blade.php
7. ✅ recommendation-letters/index.blade.php
8. ✅ water-availability-letters/index.blade.php
9. ✅ approval-letters/index.blade.php

## Notes:
- Ganti `[ROUTE]` dengan nama route masing-masing (misal: payroll-letters, delegation-letters, dll)
- Pastikan controller sudah support `exportPdf` dan `exportDocx` dengan parameter `?kop=1` atau `?kop=0`
- F4 akan trigger click pada tombol "Lihat dengan kop" (default dengan kop)
