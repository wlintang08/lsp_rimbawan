<?php

use App\Models\User;

it('admin create pages are reachable', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get('/admin/asesi/create')->assertOk();
    $this->actingAs($admin)->get('/admin/asesor/create')->assertOk();
    $this->actingAs($admin)->get('/admin/skema/create')->assertOk();
});
