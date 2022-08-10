<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'det_penyakit',
        'srn_penyakit'
    ];

    // public function history(){
    //     return $this->hasMany(History::class);
    // }

    // public function role(){
    //     return $this->hasMany(Rulespenyakit::class);
    // }
}