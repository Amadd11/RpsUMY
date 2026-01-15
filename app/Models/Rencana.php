<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'subcpmk_id',
        'week',
        'indikator',
        'kriteria_teknik',
        'materi_pembelajaran',
        'luring',
        'daring',
        'bobot'
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }

    public function subCpmk()
    {
        return $this->belongsTo(Subcpmk::class, 'subcpmk_id');
    }
}
