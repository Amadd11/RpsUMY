<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'deskripsi',
        'logo',
        'fakultas_id'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }

    public function cpls()
    {
        return $this->hasMany(Cpl::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
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
