# Implementasi PDF Preview Stream dengan Dompdf

## Ringkasan Perubahan

Sistem preview PDF telah diubah dari menampilkan HTML biasa menjadi PDF streaming yang ditampilkan di iframe seperti PDF viewer profesional.

---

## 1. Controller Method - PayrollLetterController@previewFormat()

**File:** [app/Http/Controllers/PayrollLetterController.php](app/Http/Controllers/PayrollLetterController.php)

```php
public function previewFormat(PayrollLetter $payrollLetter, Request $request)
{
    $mode = $request->query('mode', 'page');
    $withKop = $request->query('kop', '1') === '1';
    $paperSize = $request->query('paper', 'A4');

    // Mode PDF: Generate & stream PDF menggunakan Dompdf
    if ($mode === 'pdf') {
        $pdf = Pdf::loadView('payroll-letters.pdf', [
            'letter' => $payrollLetter,
            'withKop' => $withKop,
            'paperSize' => $paperSize,
        ]);

        // Set custom paper size untuk F4
        if ($paperSize === 'F4') {
            // F4: 210mm x 330mm = 595.27pt x 935.43pt
            $pdf->setPaper([0, 0, 595.27, 935.43], 'portrait');
        } else {
            $pdf->setPaper($paperSize, 'portrait');
        }

        // Stream PDF inline (bukan download)
        return $pdf->stream('payroll-' . $payrollLetter->nomor_surat . '.pdf');
    }

    // Mode page: Return preview page dengan iframe PDF
    return view('payroll-letters.preview', [
        'letter' => $payrollLetter,
        'payrollLetter' => $payrollLetter,
        'withKop' => $withKop,
    ]);
}
```

### Penjelasan:

- **`$mode === 'pdf'`**: Ketika parameter `mode=pdf` dikirim, controller akan:
  - Load template Blade `payroll-letters.pdf`
  - Generate PDF menggunakan Dompdf
  - Set ukuran kertas F4 (210mm × 330mm)
  - Return `$pdf->stream()` → PDF ditampilkan di browser dengan Content-Type `application/pdf`

- **Mode default (page)**: Ketika tanpa parameter `mode` atau `mode` bukan `pdf`:
  - Return view preview dengan informasi surat
  - View berisi iframe yang menunjuk ke URL dengan `mode=pdf`

---

## 2. View Preview - Blade Template untuk Halaman Preview

**File:** [resources/views/payroll-letters/preview.blade.php](resources/views/payroll-letters/preview.blade.php)

### Bagian Penting: PDF Viewer Container

```blade
<!-- PDF Viewer Section -->
<div class="mt-8 pt-6 border-t border-gray-200">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pratinjau Dokumen</h3>
    
    <!-- PDF Viewer Container - Gray background with white paper effect -->
    <div class="bg-gray-300 rounded-lg p-4" style="min-height: 850px;">
        <div class="flex items-center justify-center h-full">
            <div class="w-full max-w-2xl">
                <iframe 
                    src="{{ route('payroll-letters.previewFormat', [$payrollLetter, 'mode' => 'pdf', 'kop' => $withKop ? '1' : '0', 'paper' => 'F4']) }}"
                    class="w-full rounded-lg shadow-2xl"
                    style="
                        height: 800px;
                        border: none;
                        background: white;
                    "
                    frameborder="0"
                    allow="fullscreen">
                </iframe>
            </div>
        </div>
    </div>
</div>
```

### Styling Breakdown:

| Element | Deskripsi |
|---------|-----------|
| **Outer Container** | `bg-gray-300` = Background abu-abu untuk efek "workspace" |
| **Centering** | `flex items-center justify-center` = Menempatkan PDF di tengah |
| **Max Width** | `max-w-2xl` = Membatasi width agar proporsional seperti kertas A4/F4 |
| **Shadow** | `shadow-2xl` = Shadow berat untuk efek depth document |
| **Rounded** | `rounded-lg` = Corner yang sedikit membulat |
| **Height** | `height: 800px` = Tinggi preview yang cukup untuk melihat dokumen |

---

## 3. PDF Template - Blade Template untuk Konten PDF

**File:** [resources/views/payroll-letters/pdf.blade.php](resources/views/payroll-letters/pdf.blade.php)

Template ini berisi struktur HTML/CSS untuk konten PDF yang akan di-render oleh Dompdf.

```blade
@php
    $kopBase64 = null;
    if ($withKop) {
        $kopPath = public_path('kop.png');
        if (file_exists($kopPath)) {
            $kopBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($kopPath));
        }
    }
@endphp

@if($kopBase64)
    <div class="kop-surat">
        <img src="{{ $kopBase64 }}" alt="Kop Surat">
    </div>
@endif

<div class="content">
    <!-- Konten surat... -->
</div>
```

---

## 4. URL & Parameter

### Route Definition
```php
Route::get('payroll-letters/{payrollLetter}/preview-format', 
    [PayrollLetterController::class, 'previewFormat']
)->name('payroll-letters.previewFormat');
```

### URL Examples

#### Preview Page (Menampilkan halaman dengan informasi + iframe)
```
GET /payroll-letters/1/preview-format?kop=1&paper=F4
```
**Response**: HTML page dengan iframe PDF

#### PDF Stream (Menampilkan PDF langsung di browser)
```
GET /payroll-letters/1/preview-format?mode=pdf&kop=1&paper=F4
```
**Response**: PDF binary stream dengan `Content-Type: application/pdf`

### Query Parameters

| Parameter | Nilai | Deskripsi |
|-----------|-------|-----------|
| `mode` | `page` (default) | Tampilkan halaman preview |
| `mode` | `pdf` | Stream PDF langsung |
| `kop` | `1` (default) | Tampilkan dengan kop surat |
| `kop` | `0` | Tampilkan tanpa kop surat |
| `paper` | `F4` | Ukuran kertas F4 (210mm × 330mm) |
| `paper` | `A4` | Ukuran kertas A4 (default) |

---

## 5. Flow Diagram

```
User Access Preview Page
↓
GET /payroll-letters/1/preview-format?kop=1&paper=F4
↓
Controller (mode='page')
  ↓ Returns view('payroll-letters.preview')
  ↓
HTML Page Loaded
  ├─ Display Surat Info (Title, Status, Details)
  ├─ Toggle Buttons (Dengan Kop / Tanpa Kop)
  ├─ PDF Viewer Container (Gray background)
  │  └─ iframe src = /preview-format?mode=pdf&kop=1&paper=F4
  └─ Action Buttons (Download PDF, DOCX, etc.)

When iframe loads:
↓
GET /payroll-letters/1/preview-format?mode=pdf&kop=1&paper=F4
↓
Controller (mode='pdf')
  ├─ Load view('payroll-letters.pdf')
  ├─ Generate PDF with Dompdf
  ├─ Set paper size F4
  └─ return $pdf->stream()
  ↓
PDF Binary Response
  ├─ Content-Type: application/pdf
  └─ Displayed in iframe inline
↓
User sees PDF in beautiful viewer with:
  - Gray background
  - White paper effect
  - Shadow for depth
  - Centered & proportional
```

---

## 6. Perbedaan dengan Implementasi Lama

### Sebelum (Lama)
```php
if ($mode === 'pdf') {
    return view('payroll-letters.pdf', [...]);  // ❌ Returns HTML
}
```
- Menampilkan view PHP/HTML di browser
- Content-Type: `text/html`
- Tidak real PDF

### Sesudah (Baru)
```php
if ($mode === 'pdf') {
    $pdf = Pdf::loadView('payroll-letters.pdf', [...]);
    return $pdf->stream('file.pdf');  // ✅ Returns PDF binary
}
```
- Menampilkan PDF binary stream
- Content-Type: `application/pdf`
- Browser render dengan PDF reader built-in
- User bisa download/print dari PDF reader

---

## 7. Persyaratan & Konfigurasi

### Package yang Diperlukan
```composer
barryvdh/laravel-dompdf
```

### Verify Installation
```bash
composer require barryvdh/laravel-dompdf
```

### Configuration File: `config/dompdf.php`
Pastikan sudah publish:
```bash
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

---

## 8. Testing

### Test di Browser
```
http://127.0.0.1:8000/payroll-letters/1/preview-format?kop=1&paper=F4
```

**Expected Output**:
1. ✅ Page dengan informasi surat
2. ✅ Iframe menampilkan PDF
3. ✅ Background abu-abu dengan kertas putih di tengah
4. ✅ PDF scrollable & zoomable
5. ✅ Tombol download PDF/DOCX berfungsi

---

## 9. Customization

### Mengubah Ukuran Viewer
Di `preview.blade.php`, ubah style iframe:
```blade
<iframe 
    src="..."
    style="
        height: 900px;  <!-- Ubah tinggi -->
        ...
    "
>
</iframe>
```

### Mengubah Warna Background
```blade
<div class="bg-gray-300 rounded-lg p-4">  <!-- Ubah bg-gray-300 -->
```

### Custom Paper Size
Di controller, tambah case baru:
```php
if ($paperSize === 'LEGAL') {
    $pdf->setPaper([0, 0, 612, 1008], 'portrait'); // 8.5" × 13"
}
```

---

## 10. Troubleshooting

### PDF tidak tampil di iframe
- ✅ Pastikan route benar di detail halaman
- ✅ Check console browser untuk error
- ✅ Verify `mode=pdf` parameter dikirim

### PDF download bukan stream
- ✅ Gunakan `$pdf->stream()` bukan `$pdf->download()`
- ✅ Pastikan tidak ada redirect sebelumnya

### Jenis kertas tidak benar
- ✅ Verify `$paperSize` parameter
- ✅ Pastikan `setPaper()` menggunakan ukuran points yang benar
  - A4: 595.27 × 841.89
  - F4: 595.27 × 935.43

---

## Summary

✅ **PDF Preview Stream Implementation Complete**
- Controller menggunakan Dompdf dengan `stream()`
- View preview menampilkan iframe dengan styling professional
- PDF tampil inline di browser bukan HTML
- Flow: Preview Page → iframe loads → PDF Stream Response

