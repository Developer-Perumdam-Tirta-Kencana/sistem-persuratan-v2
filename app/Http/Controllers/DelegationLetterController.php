<?php

namespace App\Http\Controllers;

use App\Models\DelegationLetter;
use App\Models\User;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class DelegationLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = DelegationLetter::with(['pemberiKuasaPertama', 'pemberiKuasaKedua', 'penerimaKuasa'])
            ->latest()
            ->paginate(15);
        return view('delegation-letters.index', compact('letters'));
    }

    public function create()
    {
        $users = User::all();
        return view('delegation-letters.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemberi_kuasa_1_id' => 'required|exists:users,id',
            'pemberi_kuasa_2_id' => 'required|exists:users,id',
            'penerima_kuasa_id' => 'required|exists:users,id',
            'tujuan_transaksi' => 'required|string',
        ]);

        $validated['status'] = 'menunggu_acc';

        DelegationLetter::create($validated);

        return redirect()->route('delegation-letters.index')
            ->with('success', 'Surat Kuasa Pelimpahan berhasil dibuat.');
    }

    public function show(DelegationLetter $delegationLetter)
    {
        $delegationLetter->load(['pemberiKuasaPertama', 'pemberiKuasaKedua', 'penerimaKuasa']);
        return view('delegation-letters.show', compact('delegationLetter'));
    }

    public function edit(DelegationLetter $delegationLetter)
    {
        $users = User::all();
        return view('delegation-letters.edit', compact('delegationLetter', 'users'));
    }

    public function update(Request $request, DelegationLetter $delegationLetter)
    {
        $validated = $request->validate([
            'pemberi_kuasa_1_id' => 'required|exists:users,id',
            'pemberi_kuasa_2_id' => 'required|exists:users,id',
            'penerima_kuasa_id' => 'required|exists:users,id',
            'tujuan_transaksi' => 'required|string',
        ]);

        $delegationLetter->update($validated);

        return redirect()->route('delegation-letters.index')
            ->with('success', 'Surat Kuasa Pelimpahan berhasil diperbarui.');
    }

    public function destroy(DelegationLetter $delegationLetter)
    {
        $delegationLetter->delete();

        return redirect()->route('delegation-letters.index')
            ->with('success', 'Surat Kuasa Pelimpahan berhasil dihapus.');
    }

    public function exportPdf(DelegationLetter $delegationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $delegationLetter->load(['pemberiKuasaPertama', 'pemberiKuasaKedua', 'penerimaKuasa']);
        
        $pdf = Pdf::loadView('delegation-letters.pdf', [
            'letter' => $delegationLetter,
            'withKop' => $withKop
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'Surat_Kuasa_Pelimpahan_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(DelegationLetter $delegationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $delegationLetter->load(['pemberiKuasaPertama', 'pemberiKuasaKedua', 'penerimaKuasa']);
        return view('delegation-letters.pdf', [
            'letter' => $delegationLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(DelegationLetter $delegationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $delegationLetter->load(['pemberiKuasaPertama', 'pemberiKuasaKedua', 'penerimaKuasa']);
        $html = view('delegation-letters.pdf', [
            'letter' => $delegationLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Kuasa_Pelimpahan_' . date('Y-m-d') . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(DelegationLetter $delegationLetter, Request $request)
    {
        return $this->approve($delegationLetter, $request);
    }

    public function rejectAction(DelegationLetter $delegationLetter, Request $request)
    {
        return $this->reject($delegationLetter, $request);
    }
}
