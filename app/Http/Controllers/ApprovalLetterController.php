<?php

namespace App\Http\Controllers;

use App\Models\PayrollLetter;
use App\Models\JobNotificationLetter;
use App\Models\WaterAvailabilityLetter;
use App\Models\RecommendationLetter;
use App\Models\TaskOrderLetter;
use App\Models\DelegationLetter;
use App\Models\InternalTransferLetter;
use App\Models\InternshipPermissionLetter;
use Illuminate\Http\Request;

class ApprovalLetterController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $template = $request->input('template', 'all');
        $letterType = $request->input('letter_type', 'all');
        $status = $request->input('status', 'all');
        $search = $request->input('search', '');

        // Collect all letters
        $allLetters = [];

        // Define letter templates
        $templates = [
            'payroll' => PayrollLetter::class,
            'job_notification' => JobNotificationLetter::class,
            'water_availability' => WaterAvailabilityLetter::class,
            'recommendation' => RecommendationLetter::class,
            'task_order' => TaskOrderLetter::class,
            'delegation' => DelegationLetter::class,
            'internal_transfer' => InternalTransferLetter::class,
            'internship_permission' => InternshipPermissionLetter::class,
        ];

        $templateNames = [
            'payroll' => 'Surat Payroll',
            'job_notification' => 'Notifikasi Pekerjaan',
            'water_availability' => 'Ketersediaan Air',
            'recommendation' => 'Surat Rekomendasi',
            'task_order' => 'Surat Perintah Tugas',
            'delegation' => 'Surat Penugasan',
            'internal_transfer' => 'Surat Transfer Internal',
            'internship_permission' => 'Surat Izin Magang',
        ];

        // Get letters based on selected template
        if ($template === 'all') {
            foreach ($templates as $key => $model) {
                $query = $model::query();

                // Apply status filter
                if ($status !== 'all') {
                    if ($status === 'approved') {
                        $query->where('status', 'disetujui');
                    } elseif ($status === 'pending') {
                        $query->where('status', 'menunggu_acc');
                    } elseif ($status === 'rejected') {
                        $query->where('status', 'ditolak');
                    } elseif ($status === 'draft') {
                        $query->where('status', 'draft');
                    } elseif ($status === 'need_revision') {
                        $query->where('status', 'perlu_revisi');
                    }
                }

                // Apply search filter
                if ($search) {
                    $query->where('nomor_surat', 'like', "%{$search}%")
                        ->orWhere('perihal', 'like', "%{$search}%");
                }

                $letters = $query->latest()->get();
                foreach ($letters as $letter) {
                    $letter->template = $key;
                    $letter->template_name = $templateNames[$key];
                    $allLetters[] = $letter;
                }
            }
        } else {
            // Get specific template
            if (isset($templates[$template])) {
                $model = $templates[$template];
                $query = $model::query();

                // Apply status filter
                if ($status !== 'all') {
                    if ($status === 'approved') {
                        $query->where('status', 'disetujui');
                    } elseif ($status === 'pending') {
                        $query->where('status', 'menunggu_acc');
                    } elseif ($status === 'rejected') {
                        $query->where('status', 'ditolak');
                    } elseif ($status === 'draft') {
                        $query->where('status', 'draft');
                    } elseif ($status === 'need_revision') {
                        $query->where('status', 'perlu_revisi');
                    }
                }

                // Apply search filter
                if ($search) {
                    $query->where('nomor_surat', 'like', "%{$search}%")
                        ->orWhere('perihal', 'like', "%{$search}%");
                }

                $allLetters = $query->latest()->get();
                foreach ($allLetters as $letter) {
                    $letter->template = $template;
                    $letter->template_name = $templateNames[$template];
                }
            }
        }

        // Sort letters by creation date (newest first)
        usort($allLetters, function ($a, $b) {
            return strtotime($b->created_at) - strtotime($a->created_at);
        });

        // Convert to collection (no pagination, DataTables will handle it)
        $letters = collect($allLetters);
        $total = $letters->count();

        // Get statistics
        $stats = [
            'total_pending' => $this->countLettersByStatus('menunggu_acc'),
            'total_approved' => $this->countLettersByStatus('disetujui'),
            'total_rejected' => $this->countLettersByStatus('ditolak'),
            'total_draft' => $this->countLettersByStatus('draft'),
            'total_revision' => $this->countLettersByStatus('perlu_revisi'),
        ];

        return view('approval-letters.index', compact(
            'letters',
            'template',
            'letterType',
            'status',
            'search',
            'stats',
            'templateNames',
            'total'
        ));
    }

    private function countLettersByStatus($status)
    {
        $templates = [
            PayrollLetter::class,
            JobNotificationLetter::class,
            WaterAvailabilityLetter::class,
            RecommendationLetter::class,
            TaskOrderLetter::class,
            DelegationLetter::class,
            InternalTransferLetter::class,
            InternshipPermissionLetter::class,
        ];

        $count = 0;
        foreach ($templates as $model) {
            $count += $model::where('status', $status)->count();
        }
        return $count;
    }
}
