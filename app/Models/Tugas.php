<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'sub_cpmk_id',
        'bentuk_penilaian',
        'judul',
        'deskripsi',
        'metode',
        'luaran',
        'indikator',
        'petunjuk',
        'lain_lain'
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }

    public function subCpmks()
    {
        return $this->belongsTo(SubCpmk::class);
    }
}
