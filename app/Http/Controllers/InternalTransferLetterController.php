<?php

namespace App\Http\Controllers;

use App\Models\InternalTransferLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class InternalTransferLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = InternalTransferLetter::latest()->paginate(15);
        return view('internal-transfer-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('internal-transfer-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_sumber' => 'required|string|max:255',
            'no_rek_sumber' => 'required|string|max:255',
            'bank_tujuan' => 'required|string|max:255',
            'no_rek_tujuan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $validated['status'] = 'menunggu_acc';

        InternalTransferLetter::create($validated);

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil dibuat.');
    }

    public function show(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('internal-transfer-letters.show', [
            'letter' => $internalTransferLetter,
            'internalTransferLetter' => $internalTransferLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(InternalTransferLetter $internalTransferLetter)
    {
        return view('internal-transfer-letters.edit', compact('internalTransferLetter'));
    }

    public function update(Request $request, InternalTransferLetter $internalTransferLetter)
    {
        $validated = $request->validate([
            'bank_sumber' => 'required|string|max:255',
            'no_rek_sumber' => 'required|string|max:255',
            'bank_tujuan' => 'required|string|max:255',
            'no_rek_tujuan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $internalTransferLetter->update($validated);

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil diperbarui.');
    }

    public function destroy(InternalTransferLetter $internalTransferLetter)
    {
        $internalTransferLetter->delete();

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil dihapus.');
    }

    public function exportPdf(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $pdf = Pdf::loadView('internal-transfer-letters.pdf', [
            'letter' => $internalTransferLetter,
            'withKop' => $withKop,
            'paperSize' => $request->query('paper', 'A4')
        ]);
        
        $pdf->setPaper($request->query('paper', 'A4'), 'portrait');
        
        $filename = 'Surat_Pelimpahan_Rekening_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        $mode = $request->query('mode', 'page');
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');

        if ($mode === 'pdf') {
            return view('internal-transfer-letters.pdf', [
                'letter' => $internalTransferLetter,
                'withKop' => $withKop,
                'paperSize' => $paperSize,
            ]);
        }

        return view('internal-transfer-letters.preview', [
            'letter' => $internalTransferLetter,
            'internalTransferLetter' => $internalTransferLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('internal-transfer-letters.pdf', [
            'letter' => $internalTransferLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Pelimpahan_Rekening_' . date('Y-m-d') . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        return $this->approve($internalTransferLetter, $request);
    }

    public function rejectAction(InternalTransferLetter $internalTransferLetter, Request $request)
    {
        return $this->reject($internalTransferLetter, $request);
    }
}
