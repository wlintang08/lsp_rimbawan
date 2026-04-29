<?php

use App\Models\Pendaftaran;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('asesi can view dashboard and register for a skema once', function () {
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skema = Skema::create([
        'nama_skema' => 'Skema Asesi',
        'deskripsi' => 'Uji daftar',
    ]);

    $this->actingAs($asesi)->get(route('asesi.dashboard'))->assertOk();
    $this->actingAs($asesi)->get(route('asesi.skema'))->assertOk();

    $response = $this->actingAs($asesi)->post(route('asesi.daftar', $skema->id));

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('pendaftarans', [
        'user_id' => $asesi->id,
        'skema_id' => $skema->id,
        'status' => Pendaftaran::STATUS_PENDING,
    ]);

    $duplicate = $this->actingAs($asesi)->post(route('asesi.daftar', $skema->id));
    $duplicate->assertRedirect();
    $duplicate->assertSessionHas('error');
});

it('asesi can filter their own registrations', function () {
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skemaA = Skema::create(['nama_skema' => 'Skema A', 'deskripsi' => 'A']);
    $skemaB = Skema::create(['nama_skema' => 'Skema B', 'deskripsi' => 'B']);

    Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skemaA->id,
        'status' => Pendaftaran::STATUS_PENDING,
    ]);

    Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skemaB->id,
        'status' => Pendaftaran::STATUS_LULUS,
    ]);

    $this->actingAs($asesi)
        ->get(route('asesi.pendaftaran', ['status' => Pendaftaran::STATUS_LULUS, 'search' => 'Skema B']))
        ->assertOk()
        ->assertSee('Skema B')
        ->assertDontSee('Skema A');
});
