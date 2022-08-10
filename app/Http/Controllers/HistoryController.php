<?php

namespace App\Http\Controllers;

use App\Models\Hama;
use App\Models\Hasilhama;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Hypothesis;

class HistoryController extends Controller
{
    public function index()
    { 
        return view('history.index',[
            'title' => 'Riwayat Diagnosa Hama',
            'histores' => Hasilhama::orderby('id','desc')->get(),
            'hypotesis' => Hama::all(),
            'history' => Hasilhama::all(),
        ]);
    } 
}
