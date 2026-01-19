<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function index()
    {
        return view('pemberitahuan.index');
    }
}
