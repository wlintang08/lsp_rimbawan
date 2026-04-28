<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Pendaftaran;
use App\Policies\PendaftaranPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Pendaftaran::class => PendaftaranPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}