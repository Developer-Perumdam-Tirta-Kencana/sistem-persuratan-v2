<?php

namespace App\Http\Controllers;

use App\Models\WaterAvailabilityLetter;
use Illuminate\Http\Request;

class WaterAvailabilityLetterController extends Controller
{
    public function index()
    {
        $letters = WaterAvailabilityLetter::latest()->paginate(15);
        return view('water-availability-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('water-availability-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_ketersediaan' => 'required|boolean',
            'nama_pengembang' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'alamat_proyek' => 'required|string',
            'nomor_surat_masuk' => 'required|string|max:255',
            'tanggal_surat_masuk' => 'required|date',
        ]);

        WaterAvailabilityLetter::create($validated);

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil dibuat.');
    }

    public function show(WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        return view('water-availability-letters.show', compact('waterAvailabilityLetter'));
    }

    public function edit(WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        return view('water-availability-letters.edit', compact('waterAvailabilityLetter'));
    }

    public function update(Request $request, WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        $validated = $request->validate([
            'status_ketersediaan' => 'required|boolean',
            'nama_pengembang' => 'required|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'alamat_proyek' => 'required|string',
            'nomor_surat_masuk' => 'required|string|max:255',
            'tanggal_surat_masuk' => 'required|date',
        ]);

        $waterAvailabilityLetter->update($validated);

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil diperbarui.');
    }

    public function destroy(WaterAvailabilityLetter $waterAvailabilityLetter)
    {
        $waterAvailabilityLetter->delete();

        return redirect()->route('water-availability-letters.index')
            ->with('success', 'Surat Informasi Ketersediaan Air berhasil dihapus.');
    }
}
