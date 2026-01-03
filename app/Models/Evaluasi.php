<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'cpl_id',
        'cpmk_id',
        'subcpmk_id',
        'week',
        'bobot_sub_cpmk',
        'indikator',
        'bentuk_penilaian',
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }

    public function subCpmk()
    {
        return $this->belongsTo(SubCpmk::class, 'subcpmk_id');
    }

    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class);
    }

    public function cpls()
    {
        return $this->belongsTo(Cpl::class);
    }
}
