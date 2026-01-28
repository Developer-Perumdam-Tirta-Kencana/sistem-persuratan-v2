<?php

namespace App\Http\Controllers;

use App\Models\WaterAvailabilityLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class WaterAvailabilityLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = WaterAvailabilityLetter::latest()->paginate(15);
        return view('water-availability-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('water-availability-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_ketersediaan' => 'required|boolean',
            'nama_pengembang' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'alamat_proyek' => 'required|string',
            'nomor_surat_masuk' => 'required|string|max:255',
            'tanggal_surat_masuk' => 'required|date',
        ]);

        $validated['status'] = 'menunggu_acc';

        WaterAvailabilityLetter::create($validated);

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil dibuat.');
    }

    public function show(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('water-availability-letters.show', [
            'letter' => $waterAvailabilityLetter,
            'waterAvailabilityLetter' => $waterAvailabilityLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        return view('water-availability-letters.edit', compact('waterAvailabilityLetter'));
    }

    public function update(Request $request, WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        $validated = $request->validate([
            'status_ketersediaan' => 'required|boolean',
            'nama_pengembang' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'alamat_proyek' => 'required|string',
            'nomor_surat_masuk' => 'required|string|max:255',
            'tanggal_surat_masuk' => 'required|date',
        ]);

        $waterAvailabilityLetter->update($validated);

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil diperbarui.');
    }

    public function destroy(WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        $waterAvailabilityLetter->delete();

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil dihapus.');
    }

    public function exportPdf(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');
        
        $pdf = Pdf::loadView('water-availability-letters.pdf', [
            'letter' => $waterAvailabilityLetter,
            'withKop' => $withKop,
            'paperSize' => $paperSize
        ]);
        
        $pdf->setPaper($paperSize, 'portrait');
        
        $filename = 'Surat_Ketersediaan_Air_' . $waterAvailabilityLetter->nama_proyek . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        $mode = $request->query('mode', 'page');
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');

        if ($mode === 'pdf') {
            return view('water-availability-letters.pdf', [
                'letter' => $waterAvailabilityLetter,
                'withKop' => $withKop,
                'paperSize' => $paperSize,
            ]);
        }

        return view('water-availability-letters.preview', [
            'letter' => $waterAvailabilityLetter,
            'waterAvailabilityLetter' => $waterAvailabilityLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('water-availability-letters.pdf', [
            'letter' => $waterAvailabilityLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Ketersediaan_Air_' . $waterAvailabilityLetter->nama_proyek . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        return $this->approve($waterAvailabilityLetter, $request);
    }

    public function rejectAction(WaterAvailabilityLetter $waterAvailabilityLetter, Request $request)
    {
        return $this->reject($waterAvailabilityLetter, $request);
    }
}
