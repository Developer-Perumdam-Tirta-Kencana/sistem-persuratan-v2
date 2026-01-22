<?php

namespace App\Http\Controllers;

use App\Models\JobNotificationLetter;
use Illuminate\Http\Request;

class JobNotificationLetterController extends Controller
{
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

        JobNotificationLetter::create($validated);

        return redirect()->route('job-notification-letters.index')
            ->with('success', 'Surat Pemberitahuan Pekerjaan berhasil dibuat.');
    }

    public function show(JobNotificationLetter $jobNotificationLetter)
    {
        return view('job-notification-letters.show', compact('jobNotificationLetter'));
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
}
