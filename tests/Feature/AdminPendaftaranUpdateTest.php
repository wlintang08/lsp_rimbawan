<?php

use App\Models\Pendaftaran;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('admin can update pendaftaran status from pending to diterima', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skema = Skema::create([
        'nama_skema' => 'Skema Uji',
        'deskripsi' => 'Deskripsi uji',
    ]);

    $pendaftaran = Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skema->id,
        'status' => Pendaftaran::STATUS_PENDING,
    ]);

    $response = $this->actingAs($admin)->patch(route('admin.pendaftaran.update', $pendaftaran->id), [
        'status' => Pendaftaran::STATUS_DITERIMA,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $pendaftaran->refresh();

    expect($pendaftaran->status)->toBe(Pendaftaran::STATUS_DITERIMA)
        ->and($pendaftaran->validated_by)->toBe($admin->id)
        ->and($pendaftaran->notifikasi)->toBe('Pendaftaran Anda diterima')
        ->and($pendaftaran->is_read)->toBeFalse();
});

it('superadmin can update pendaftaran status from diterima to lulus and get certificate number', function () {
    $superadmin = User::factory()->create(['role' => 'superadmin']);
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skema = Skema::create([
        'nama_skema' => 'Skema Sertifikat',
        'deskripsi' => 'Deskripsi sertifikat',
    ]);

    $pendaftaran = Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skema->id,
        'status' => Pendaftaran::STATUS_DITERIMA,
    ]);

    $response = $this->actingAs($superadmin)->patch(route('admin.pendaftaran.update', $pendaftaran->id), [
        'status' => Pendaftaran::STATUS_LULUS,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $pendaftaran->refresh();

    expect($pendaftaran->status)->toBe(Pendaftaran::STATUS_LULUS)
        ->and($pendaftaran->validated_by)->toBe($superadmin->id)
        ->and($pendaftaran->no_sertifikat)->not->toBeNull();
});
