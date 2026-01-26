<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApprovalTrait
{
    public function approve($model, Request $request)
    {
        $model->update([
            'status' => 'disetujui',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_notes' => $request->input('approval_notes'),
        ]);

        return redirect()->back()
            ->with('success', 'Surat berhasil disetujui.');
    }

    public function reject($model, Request $request)
    {
        $request->validate([
            'approval_notes' => 'required|string|max:500',
        ]);

        $model->update([
            'status' => 'ditolak',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_notes' => $request->input('approval_notes'),
        ]);

        return redirect()->back()
            ->with('success', 'Surat berhasil ditolak.');
    }
}
