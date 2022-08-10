<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiagnosapenyakitController extends Controller
{
     public function index()
     {
      return view('diagnosa.penyakit',[
        'title' => 'Diagnosa Penyakit',
      ]);
     }
}
