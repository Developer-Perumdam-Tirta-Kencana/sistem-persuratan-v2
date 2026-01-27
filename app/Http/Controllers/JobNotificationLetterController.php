<?php

namespace App\Http\Controllers;

use App\Models\JobNotificationLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class JobNotificationLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = JobNotificationLetter::latest()->paginate(15);
        return view('job-notification-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('job-notification-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instansi_tujuan' => 'required|string|max:255',
            'lokasi_pekerjaan' => 'required|string',
            'hari_tanggal_pelaksanaan' => 'required|string|max:255',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'jenis_pekerjaan' => 'required|string|max:255',
        ]);

        $validated['status'] = 'menunggu_acc';

        JobNotificationLetter::create($validated);

        return redirect()->route('job-notification-letters.index')
            ->with('success', 'Surat Pemberitahuan Pekerjaan berhasil dibuat.');
    }

    public function show(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('job-notification-letters.show', [
            'letter' => $jobNotificationLetter,
            'jobNotificationLetter' => $jobNotificationLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(JobNotificationLetter $jobNotificationLetter)
    {
        return view('job-notification-letters.edit', compact('jobNotificationLetter'));
    }

    public function update(Request $request, JobNotificationLetter $jobNotificationLetter)
    {
        $validated = $request->validate([
            'instansi_tujuan' => 'required|string|max:255',
            'lokasi_pekerjaan' => 'required|string',
            'hari_tanggal_pelaksanaan' => 'required|string|max:255',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'jenis_pekerjaan' => 'required|string|max:255',
        ]);

        $jobNotificationLetter->update($validated);

        return redirect()->route('job-notification-letters.index')
            ->with('success', 'Surat Pemberitahuan Pekerjaan berhasil diperbarui.');
    }

    public function destroy(JobNotificationLetter $jobNotificationLetter)
    {
        $jobNotificationLetter->delete();

        return redirect()->route('job-notification-letters.index')
            ->with('success', 'Surat Pemberitahuan Pekerjaan berhasil dihapus.');
    }

    public function exportPdf(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        
        $pdf = Pdf::loadView('job-notification-letters.pdf', [
            'letter' => $jobNotificationLetter,
            'withKop' => $withKop
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'Surat_Pemberitahuan_Pekerjaan_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('job-notification-letters.pdf', [
            'letter' => $jobNotificationLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('job-notification-letters.pdf', [
            'letter' => $jobNotificationLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Pemberitahuan_Pekerjaan_' . date('Y-m-d') . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        return $this->approve($jobNotificationLetter, $request);
    }

    public function rejectAction(JobNotificationLetter $jobNotificationLetter, Request $request)
    {
        return $this->reject($jobNotificationLetter, $request);
    }
}
