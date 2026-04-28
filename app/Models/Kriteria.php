<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'skema_id',
        'nama',
        'bobot'
    ];

    // relasi ke skema
    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    // relasi ke nilai
    public function nilaiKriterias()
    {
        return $this->hasMany(NilaiKriteria::class);
    }
}