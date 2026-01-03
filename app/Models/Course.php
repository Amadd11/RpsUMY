<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    //
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'code',
        'sks',
        'semester',
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
