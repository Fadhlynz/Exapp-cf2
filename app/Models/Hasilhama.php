<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasilhama extends Model
{
    use HasFactory;

    protected $fillable = [
        'hama_id',
        'name',
        'description',
        'value',
    ];

    public function hama(){
        return $this->belongsTo(Hama::class);
    }
}