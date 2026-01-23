<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\PayrollLetter;
use App\Models\JobNotificationLetter;
use App\Models\WaterAvailabilityLetter;
use App\Models\RecommendationLetter;
use App\Models\TaskOrderLetter;
use App\Models\DelegationLetter;
use App\Models\InternalTransferLetter;
use App\Models\InternshipPermissionLetter;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrollCount = PayrollLetter::count();
        $jobNotificationCount = JobNotificationLetter::count();
        $waterAvailabilityCount = WaterAvailabilityLetter::count();
        $recommendationCount = RecommendationLetter::count();
        $taskOrderCount = TaskOrderLetter::count();
        $delegationCount = DelegationLetter::count();
        $internalTransferCount = InternalTransferLetter::count();
        $internshipCount = InternshipPermissionLetter::count();
        
        return view('surat-keluar.index', compact(
            'payrollCount',
            'jobNotificationCount',
            'waterAvailabilityCount',
            'recommendationCount',
            'taskOrderCount',
            'delegationCount',
            'internalTransferCount',
            'internshipCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat-keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        return view('surat-keluar.show', compact('suratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        return view('surat-keluar.edit', compact('suratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        //
    }
}
