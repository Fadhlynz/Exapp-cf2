<?php

namespace App\Http\Controllers;

use App\Models\Gejalahama;
use App\Models\Hama;
use App\Models\Hasilhama;
use App\Models\Kondisihama;
use App\Models\Ruleshama;
use App\Models\Setting;
use Illuminate\Http\Request;

class DiagnosahamaController extends Controller
{
    public function diagnosa_hama()
    {
        $evidences = Gejalahama::all();

        return view('diagnosa_hama',[
            'title' => 'Diagnosa Hama',
            'evidences' => $evidences,
            'setting_type_input' => Setting::find(1),
            'values' => Kondisihama::orderby('value','asc')->get(),
            'min' => Kondisihama::where('value', 0)->first(),
            'max' => Kondisihama::where('value', 1)->first(),
        ]);
    }

    public function hasildiagnosa_hama(Request $request){

        $request->validate([
            'name' => 'required',
        ]); 

        $hypothesyes = Hama::all();
        $roles = Ruleshama::all();
        $evidences = Gejalahama::all();

        foreach ($hypothesyes as $hypothesis){
            $arrid = 0;
            $cf_old = 0;
            foreach ($roles as $key => $role){
                if ($hypothesis->id == $role->hama_id ){
                    $ard = $arrid++; 
                    if ($request->evidance_value[$ard] != 0){
                        $cfhe = $role->value * $request->evidance_value[$ard];
                        $cf_old === 1 ? $cfhe : $cf_old = $cf_old + $cfhe * (1- $cf_old);
                    }
                }
            }
            $menu[] = array(
                'id' => $hypothesis->id,
                'nama' => $hypothesis->name,
                'hsl' => number_format($cf_old * 100,2, '.', ''),
                'slsi' => $hypothesis->srn_hama
            );
        }

        $b = 0;
        foreach ($menu as $index => $record) {
            if ($record['hsl'] > $b) { 
                $a = $record['id'];
                $b = $record['hsl'];
                $c = $record['nama'];
                $d = $record['slsi'];
            }
        }

        if($b == 0){
            return redirect()->back()->with('status', 'At least fill in one of the following!');
        }

        // dd($request->all());
        // dd($a);

        Hasilhama::create([
            'hama_id' => $a,
            'name' => $request->name,
            'description' => $request->description,
            'value' => $b,
        ]);

        return view('hasildiagnosa_hama',[
            'title' => 'Diagnosa Hama',
            'hypothesyes' => $hypothesyes,
            'roles' => $roles,
            'evidences' => $evidences,
            'request' => $request
            ]
        );
    }
}
