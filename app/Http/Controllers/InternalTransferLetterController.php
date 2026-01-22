<?php

namespace App\Http\Controllers;

use App\Models\InternalTransferLetter;
use Illuminate\Http\Request;

class InternalTransferLetterController extends Controller
{
    public function index()
    {
        $letters = InternalTransferLetter::latest()->paginate(15);
        return view('internal-transfer-letters.index', compact('letters'));
    }

    public function create()
    {
        return view('internal-transfer-letters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_sumber' => 'required|string|max:255',
            'no_rek_sumber' => 'required|string|max:255',
            'bank_tujuan' => 'required|string|max:255',
            'no_rek_tujuan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        InternalTransferLetter::create($validated);

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil dibuat.');
    }

    public function show(InternalTransferLetter $internalTransferLetter)
    {
        return view('internal-transfer-letters.show', compact('internalTransferLetter'));
    }

    public function edit(InternalTransferLetter $internalTransferLetter)
    {
        return view('internal-transfer-letters.edit', compact('internalTransferLetter'));
    }

    public function update(Request $request, InternalTransferLetter $internalTransferLetter)
    {
        $validated = $request->validate([
            'bank_sumber' => 'required|string|max:255',
            'no_rek_sumber' => 'required|string|max:255',
            'bank_tujuan' => 'required|string|max:255',
            'no_rek_tujuan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $internalTransferLetter->update($validated);

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil diperbarui.');
    }

    public function destroy(InternalTransferLetter $internalTransferLetter)
    {
        $internalTransferLetter->delete();

        return redirect()->route('internal-transfer-letters.index')
            ->with('success', 'Surat Pelimpahan Rekening berhasil dihapus.');
    }
}
