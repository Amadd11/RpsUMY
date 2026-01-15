<?php

namespace App\Models;

use App\Models\Cpl;
use App\Models\Rps;
use Illuminate\Database\Eloquent\Model;

class Cpmk extends Model
{
    //
    protected $fillable = [
        'rps_id',
        'cpl_id',
        'code',
        'description',
        'bobot'
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class);
    }

    public function cpl()
    {
        return $this->belongsTo(Cpl::class);
    }

    public function subCpmks()
    {
        return $this->hasMany(Subcpmk::class);
    }
}
