<?php

namespace App\Http\Controllers;

use App\Models\RecommendationLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class RecommendationLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = RecommendationLetter::latest()->paginate(15);
        return view('recommendation-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('recommendation-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'nama_perumahan' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:1',
            'lokasi' => 'required|string',
        ]);

        $validated['status'] = 'menunggu_acc';

        RecommendationLetter::create($validated);

        return redirect()->route('recommendation-letters.index')
            ->with('success', 'Surat Rekomendasi berhasil dibuat.');
    }

    public function show(RecommendationLetter $recommendationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('recommendation-letters.show', [
            'letter' => $recommendationLetter,
            'recommendationLetter' => $recommendationLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(RecommendationLetter $recommendationLetter)
    {
        return view('recommendation-letters.edit', compact('recommendationLetter'));
    }

    public function update(Request $request, RecommendationLetter $recommendationLetter)
    {
        $validated = $request->validate([
            'nama_pt' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'nama_perumahan' => 'required|string|max:255',
            'jumlah_unit' => 'required|integer|min:1',
            'lokasi' => 'required|string',
        ]);

        $recommendationLetter->update($validated);

        return redirect()->route('recommendation-letters.index')
            ->with('success', 'Surat Rekomendasi berhasil diperbarui.');
    }

    public function destroy(RecommendationLetter $recommendationLetter)
    {
        $recommendationLetter->delete();

        return redirect()->route('recommendation-letters.index')
            ->with('success', 'Surat Rekomendasi berhasil dihapus.');
    }

    public function exportPdf(RecommendationLetter $recommendationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $pdf = Pdf::loadView('recommendation-letters.pdf', [
            'letter' => $recommendationLetter,
            'withKop' => $withKop,
            'paperSize' => $request->query('paper', 'A4')
        ]);
        
        $pdf->setPaper($request->query('paper', 'A4'), 'portrait');
        
        $filename = 'Surat_Rekomendasi_' . $recommendationLetter->nama_pt . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(RecommendationLetter $recommendationLetter, Request $request)
    {
        $mode = $request->query('mode', 'page');
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');

        if ($mode === 'pdf') {
            return view('recommendation-letters.pdf', [
                'letter' => $recommendationLetter,
                'withKop' => $withKop,
                'paperSize' => $paperSize,
            ]);
        }

        return view('recommendation-letters.preview', [
            'letter' => $recommendationLetter,
            'recommendationLetter' => $recommendationLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(RecommendationLetter $recommendationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('recommendation-letters.pdf', [
            'letter' => $recommendationLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Rekomendasi_' . $recommendationLetter->nama_pt . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(RecommendationLetter $recommendationLetter, Request $request)
    {
        return $this->approve($recommendationLetter, $request);
    }

    public function rejectAction(RecommendationLetter $recommendationLetter, Request $request)
    {
        return $this->reject($recommendationLetter, $request);
    }
}
