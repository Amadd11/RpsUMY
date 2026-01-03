<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    //
    protected $fillable = [
        'prodi_id',
        'code',
        'taksonomi',
        'description',
        'bg_color'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function cpmk()
    {
        return $this->hasMany(Cpmk::class);
    }

    public function rps()
    {
        return $this->belongsToMany(Rps::class, 'rps_cpl');
    }
}
