<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Rps extends Model
{
    //
    protected $fillable = [
        'course_id',
        'dosen_id',
        'slug',
        'deskripsi',
        'materi_pembelajaran',
        'tgl_penyusunan',
        'tahun_ajaran',
        'file_pdf'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setCourseIdAttribute($value)
    {
        $this->attributes['course_id'] = $value;

        if ($course = Course::find($value)) {
            $this->attributes['slug'] = Str::slug($course->name);
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function cpmks()
    {
        return $this->hasMany(Cpmk::class);
    }

    public function referensi()
    {
        return $this->hasMany(Referensi::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function evaluasis()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function rencanas()
    {
        return $this->hasMany(Rencana::class);
    }

    public function subCpmks()
    {
        return $this->hasMany(Subcpmk::class);
    }

    public function cpls()
    {
        return $this->belongsToMany(Cpl::class, 'rps_cpl')
            ->withPivot('bobot');
    }
}
