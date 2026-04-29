<?php

namespace App\Policies;

use App\Models\Pendaftaran;
use App\Models\User;

class PendaftaranPolicy
{
    private function canManage(User $user): bool
    {
        return in_array($user->role, ['admin', 'superadmin'], true);
    }

    public function viewAny(User $user): bool
    {
        return $this->canManage($user);
    }

    public function view(User $user, Pendaftaran $p): bool
    {
        return $this->canManage($user) || $p->user_id === $user->id;
    }

    public function update(User $user, Pendaftaran $p): bool
    {
        return $this->canManage($user);
    }

    public function cetak(User $user, Pendaftaran $p): bool
    {
        return $p->status === 'lulus' && ($this->canManage($user) || $p->user_id === $user->id);
    }
}
