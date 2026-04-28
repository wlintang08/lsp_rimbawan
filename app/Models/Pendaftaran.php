<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // KONSTANTA HARUS DI DALAM CLASS
    const STATUS_PENDING = 'pending';
    const STATUS_DITERIMA = 'diterima';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_LULUS = 'lulus';
    const STATUS_TIDAK_LULUS = 'tidak_lulus';

    protected $fillable = [
        'user_id',
        'skema_id',
        'status',
        'validated_by',
        'validated_at',
        'no_sertifikat',
    ];

    protected $casts = [
        'validated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skema()
    {
         return $this->belongsTo(\App\Models\Skema::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function berkas()
    {
        return $this->hasMany(\App\Models\Berkas::class);
    }
}