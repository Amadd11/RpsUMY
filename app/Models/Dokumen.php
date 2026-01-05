<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    //
    protected $fillable = [
        'prodi_id',
        'judul',
        'file'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
