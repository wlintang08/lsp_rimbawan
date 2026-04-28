<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'skema_id'
    ];

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }
}