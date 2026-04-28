<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_skema',
        'deskripsi'
    ];

    public function asesi()
    {
        return $this->hasMany(Asesi::class);
    }

    public function pendaftaran()
    {
    return $this->hasMany(\App\Models\Pendaftaran::class);
    }
}