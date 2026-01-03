<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'tipe',
        'referensi'
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }
}
