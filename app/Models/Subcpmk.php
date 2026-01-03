<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcpmk extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'cpmk_id',
        'code',
        'description'
    ];

    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class);
    }

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }

    public function evaluasis()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function rencanas()
    {
        return $this->hasMany(Rencana::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
