<?php

namespace App\Models;

use App\Models\Rps;
use App\Models\Prodi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'prodi_id'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function rps()
    {
        return $this->hasMany(Rps::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
