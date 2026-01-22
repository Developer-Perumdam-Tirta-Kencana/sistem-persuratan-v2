<?php

namespace App\Http\Controllers;

use App\Models\TaskOrderLetter;
use Illuminate\Http\Request;

class TaskOrderLetterController extends Controller
{
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

        TaskOrderLetter::create($validated);

        return redirect()->route('task-order-letters.index')
            ->with('success', 'Surat Perintah Tugas berhasil dibuat.');
    }

    public function show(TaskOrderLetter $taskOrderLetter)
    {
        return view('task-order-letters.show', compact('taskOrderLetter'));
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
}
