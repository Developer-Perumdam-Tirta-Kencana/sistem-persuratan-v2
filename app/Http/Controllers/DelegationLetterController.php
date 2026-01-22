<?php

namespace App\Http\Controllers;

use App\Models\DelegationLetter;
use App\Models\User;
use Illuminate\Http\Request;

class DelegationLetterController extends Controller
{
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
}
