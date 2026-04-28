<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pendaftaran;

class PendaftaranPolicy
{
    // Admin boleh melihat semua
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    // Asesi hanya boleh lihat miliknya
    public function view(User $user, Pendaftaran $p)
    {
        return $user->role === 'admin' || $p->user_id === $user->id;
    }

    // Update status hanya admin
    public function update(User $user, Pendaftaran $p)
    {
        return $user->role === 'admin';
    }

    // Cetak sertifikat: admin atau pemilik (jika lulus)
    public function cetak(User $user, Pendaftaran $p)
    {
        return $p->status === 'lulus' &&
            ($user->role === 'admin' || $p->user_id === $user->id);
    }
}