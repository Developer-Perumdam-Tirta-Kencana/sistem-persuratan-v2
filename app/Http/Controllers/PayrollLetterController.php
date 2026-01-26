<?php

namespace App\Http\Controllers;

use App\Models\PayrollLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class PayrollLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = PayrollLetter::latest()->paginate(15);
        return view('payroll-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('payroll-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_tujuan' => 'required|in:Jatim,BRI',
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'bulan_gaji' => 'required|string|max:255',
            'total_nominal' => 'required|numeric|min:0',
            'nomor_rekening_sumber' => 'required|string|max:255',
        ]);

        $validated['status'] = 'menunggu_acc';

        PayrollLetter::create($validated);

        return redirect()->route('payroll-letters.index')
            ->with('success', 'Surat Payroll berhasil dibuat.');
    }

    public function show(PayrollLetter $payrollLetter)
    {
        return view('payroll-letters.show', compact('payrollLetter'));
    }

    public function edit(PayrollLetter $payrollLetter)
    {
        return view('payroll-letters.edit', compact('payrollLetter'));
    }

    public function update(Request $request, PayrollLetter $payrollLetter)
    {
        $validated = $request->validate([
            'bank_tujuan' => 'required|in:Jatim,BRI',
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'bulan_gaji' => 'required|string|max:255',
            'total_nominal' => 'required|numeric|min:0',
            'nomor_rekening_sumber' => 'required|string|max:255',
        ]);

        $payrollLetter->update($validated);

        return redirect()->route('payroll-letters.index')
            ->with('success', 'Surat Payroll berhasil diperbarui.');
    }

    public function destroy(PayrollLetter $payrollLetter)
    {
        $payrollLetter->delete();

        return redirect()->route('payroll-letters.index')
            ->with('success', 'Surat Payroll berhasil dihapus.');
    }

    public function exportPdf(PayrollLetter $payrollLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $pdf = Pdf::loadView('payroll-letters.pdf', [
            'letter' => $payrollLetter,
            'withKop' => $withKop
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'Surat_Payroll_' . $payrollLetter->nomor_surat . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(PayrollLetter $payrollLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('payroll-letters.pdf', [
            'letter' => $payrollLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(PayrollLetter $payrollLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('payroll-letters.pdf', [
            'letter' => $payrollLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Payroll_' . $payrollLetter->nomor_surat . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(PayrollLetter $payrollLetter, Request $request)
    {
        return $this->approve($payrollLetter, $request);
    }

    public function rejectAction(PayrollLetter $payrollLetter, Request $request)
    {
        return $this->reject($payrollLetter, $request);
    }
}
