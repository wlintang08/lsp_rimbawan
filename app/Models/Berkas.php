<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $fillable = ['pendaftaran_id', 'nama_berkas', 'file'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}