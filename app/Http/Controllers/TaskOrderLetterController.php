<?php

namespace App\Http\Controllers;

use App\Models\TaskOrderLetter;
use App\Traits\ApprovalTrait;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html as PhpWordHtml;

class TaskOrderLetterController extends Controller
{
    use ApprovalTrait;
    public function index()
    {
        $letters = TaskOrderLetter::latest()->paginate(15);
        return view('task-order-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('task-order-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dasar_surat' => 'required|string',
            'list_petugas' => 'required|array|min:1',
            'list_petugas.*' => 'required|string',
            'hari_tanggal_tugas' => 'required|string|max:255',
            'waktu_tugas' => 'required|string|max:255',
            'tempat_tugas' => 'required|string|max:255',
            'keperluan_tugas' => 'required|string',
            'pakaian' => 'nullable|string|max:255',
        ]);

        $validated['status'] = 'menunggu_acc';

        TaskOrderLetter::create($validated);

        return redirect()->route('task-order-letters.index')
            ->with('success', 'Surat Perintah Tugas berhasil dibuat.');
    }

    public function show(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        return view('task-order-letters.show', [
            'letter' => $taskOrderLetter,
            'taskOrderLetter' => $taskOrderLetter,
            'withKop' => $withKop
        ]);
    }

    public function edit(TaskOrderLetter $taskOrderLetter)
    {
        return view('task-order-letters.edit', compact('taskOrderLetter'));
    }

    public function update(Request $request, TaskOrderLetter $taskOrderLetter)
    {
        $validated = $request->validate([
            'dasar_surat' => 'required|string',
            'list_petugas' => 'required|array|min:1',
            'list_petugas.*' => 'required|string',
            'hari_tanggal_tugas' => 'required|string|max:255',
            'waktu_tugas' => 'required|string|max:255',
            'tempat_tugas' => 'required|string|max:255',
            'keperluan_tugas' => 'required|string',
            'pakaian' => 'nullable|string|max:255',
        ]);

        $taskOrderLetter->update($validated);

        return redirect()->route('task-order-letters.index')
            ->with('success', 'Surat Perintah Tugas berhasil diperbarui.');
    }

    public function destroy(TaskOrderLetter $taskOrderLetter)
    {
        $taskOrderLetter->delete();

        return redirect()->route('task-order-letters.index')
            ->with('success', 'Surat Perintah Tugas berhasil dihapus.');
    }

    public function exportPdf(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');
        
        $pdf = Pdf::loadView('task-order-letters.pdf', [
            'letter' => $taskOrderLetter,
            'withKop' => $withKop,
            'paperSize' => $paperSize
        ]);
        
        $pdf->setPaper($paperSize, 'portrait');
        
        $filename = 'Surat_Perintah_Tugas_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function previewFormat(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        $mode = $request->query('mode', 'page');
        $withKop = $request->query('kop', '1') === '1';
        $paperSize = $request->query('paper', 'A4');

        if ($mode === 'pdf') {
            return view('task-order-letters.pdf', [
                'letter' => $taskOrderLetter,
                'withKop' => $withKop,
                'paperSize' => $paperSize,
            ]);
        }

        return view('task-order-letters.preview', [
            'letter' => $taskOrderLetter,
            'taskOrderLetter' => $taskOrderLetter,
            'withKop' => $withKop,
        ]);
    }

    public function exportDocx(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        $withKop = $request->query('kop', '1') === '1';
        $html = view('task-order-letters.pdf', [
            'letter' => $taskOrderLetter,
            'withKop' => $withKop,
        ])->render();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        PhpWordHtml::addHtml($section, $html, false, false);

        $filename = 'Surat_Perintah_Tugas_' . date('Y-m-d') . '.docx';
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }
        $tempFile = $tempDir . '/' . $filename;
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function approveAction(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        return $this->approve($taskOrderLetter, $request);
    }

    public function rejectAction(TaskOrderLetter $taskOrderLetter, Request $request)
    {
        return $this->reject($taskOrderLetter, $request);
    }
}
