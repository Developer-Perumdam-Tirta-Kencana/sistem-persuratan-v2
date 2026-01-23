<?php

namespace App\Http\Controllers;

use App\Models\RecommendationLetter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RecommendationLetterController extends Controller
{
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

        RecommendationLetter::create($validated);

        return redirect()->route('recommendation-letters.index')
            ->with('success', 'Surat Rekomendasi berhasil dibuat.');
    }

    public function show(RecommendationLetter $recommendationLetter)
    {
        return view('recommendation-letters.show', compact('recommendationLetter'));
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
            'withKop' => $withKop
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'Surat_Rekomendasi_' . $recommendationLetter->nama_pt . '.pdf';
        return $pdf->download($filename);
    }
}
