<?php

namespace App\Http\Controllers;

use App\Models\PayrollLetter;
use Illuminate\Http\Request;

class PayrollLetterController extends Controller
{
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
}
