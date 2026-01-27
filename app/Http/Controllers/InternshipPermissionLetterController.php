<?php

namespace App\Http\Controllers;

use App\Models\InternshipPermissionLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class InternshipPermissionLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = InternshipPermissionLetter::latest()->paginate(15);
        return view('internship-permission-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('internship-permission-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instansi_pendidikan' => 'required|string|max:255',
            'nomor_surat_permohonan' => 'required|string|max:255',
            'list_mahasiswa' => 'required|array|min:1',
            'list_mahasiswa.*.nama' => 'required|string',
            'list_mahasiswa.*.nim' => 'required|string',
            'list_mahasiswa.*.prodi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $validated['status'] = 'menunggu_acc';

        InternshipPermissionLetter::create($validated);

        return redirect()->route('internship-permission-letters.index')
            ->with('success', 'Surat Izin Magang/PKL berhasil dibuat.');
    }

    public function show(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('internship-permission-letters.show', [
            'letter' => $internshipPermissionLetter,
            'internshipPermissionLetter' => $internshipPermissionLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(InternshipPermissionLetter $internshipPermissionLetter)
    {
        return view('internship-permission-letters.edit', compact('internshipPermissionLetter'));
    }

    public function update(Request $request, InternshipPermissionLetter $internshipPermissionLetter)
    {
        $validated = $request->validate([
            'instansi_pendidikan' => 'required|string|max:255',
            'nomor_surat_permohonan' => 'required|string|max:255',
            'list_mahasiswa' => 'required|array|min:1',
            'list_mahasiswa.*.nama' => 'required|string',
            'list_mahasiswa.*.nim' => 'required|string',
            'list_mahasiswa.*.prodi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $internshipPermissionLetter->update($validated);

        return redirect()->route('internship-permission-letters.index')
            ->with('success', 'Surat Izin Magang/PKL berhasil diperbarui.');
    }

    public function destroy(InternshipPermissionLetter $internshipPermissionLetter)
    {
        $internshipPermissionLetter->delete();

        return redirect()->route('internship-permission-letters.index')
            ->with('success', 'Surat Izin Magang/PKL berhasil dihapus.');
    }

    public function exportPdf(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $pdf = Pdf::loadView('internship-permission-letters.pdf', [
            'letter' => $internshipPermissionLetter,
            'withKop' => $withKop
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'Surat_Izin_Magang_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('internship-permission-letters.pdf', [
            'letter' => $internshipPermissionLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('internship-permission-letters.pdf', [
            'letter' => $internshipPermissionLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Izin_Magang_' . date('Y-m-d') . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        return $this->approve($internshipPermissionLetter, $request);
    }

    public function rejectAction(InternshipPermissionLetter $internshipPermissionLetter, Request $request)
    {
        return $this->reject($internshipPermissionLetter, $request);
    }
}
