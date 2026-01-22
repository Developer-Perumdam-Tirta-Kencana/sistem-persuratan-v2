<?php

namespace App\Http\Controllers;

use App\Models\InternshipPermissionLetter;
use Illuminate\Http\Request;

class InternshipPermissionLetterController extends Controller
{
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

        InternshipPermissionLetter::create($validated);

        return redirect()->route('internship-permission-letters.index')
            ->with('success', 'Surat Izin Magang/PKL berhasil dibuat.');
    }

    public function show(InternshipPermissionLetter $internshipPermissionLetter)
    {
        return view('internship-permission-letters.show', compact('internshipPermissionLetter'));
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
}
