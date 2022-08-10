<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RulespenyakitController extends Controller
{
      public function index()
      {
        return view('rules.penyakit',[
          'title' => 'Rules Penyakit',
        ]);
      }
}
