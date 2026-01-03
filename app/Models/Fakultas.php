<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'deskripsi'
    ];

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
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
