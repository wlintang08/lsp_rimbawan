<?php

use App\Models\Kriteria;
use App\Models\NilaiKriteria;
use App\Models\Pendaftaran;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('asesor can view dashboard and score accepted registration', function () {
    $asesor = User::factory()->create(['role' => 'asesor']);
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skema = Skema::create([
        'nama_skema' => 'Skema Nilai',
        'deskripsi' => 'Deskripsi nilai',
    ]);

    $k1 = Kriteria::create(['skema_id' => $skema->id, 'nama' => 'Kriteria 1', 'bobot' => 1]);
    $k2 = Kriteria::create(['skema_id' => $skema->id, 'nama' => 'Kriteria 2', 'bobot' => 2]);

    $pendaftaran = Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skema->id,
        'status' => Pendaftaran::STATUS_DITERIMA,
    ]);

    $this->actingAs($asesor)->get(route('asesor.dashboard'))->assertOk()->assertSee('Skema Nilai');
    $this->actingAs($asesor)->get(route('asesor.nilai.form', $pendaftaran->id))->assertOk();

    $response = $this->actingAs($asesor)->post(route('asesor.nilai', $pendaftaran->id), [
        'nilai' => [
            $k1->id => 80,
            $k2->id => 70,
        ],
    ]);

    $response->assertRedirect(route('asesor.dashboard'));
    $response->assertSessionHas('success');

    $pendaftaran->refresh();

    expect($pendaftaran->nilai)->toBe(73.33)
        ->and($pendaftaran->status)->toBe(Pendaftaran::STATUS_LULUS)
        ->and($pendaftaran->asesor_id)->toBe($asesor->id);

    $this->assertDatabaseHas('nilai_kriterias', [
        'pendaftaran_id' => $pendaftaran->id,
        'kriteria_id' => $k1->id,
        'nilai' => 80,
    ]);

    $this->assertDatabaseHas('nilai_kriterias', [
        'pendaftaran_id' => $pendaftaran->id,
        'kriteria_id' => $k2->id,
        'nilai' => 70,
    ]);
});

it('asesor cannot score registration without criteria', function () {
    $asesor = User::factory()->create(['role' => 'asesor']);
    $asesi = User::factory()->create(['role' => 'asesi']);
    $skema = Skema::create([
        'nama_skema' => 'Tanpa Kriteria',
        'deskripsi' => 'Belum ada kriteria',
    ]);

    $pendaftaran = Pendaftaran::create([
        'user_id' => $asesi->id,
        'skema_id' => $skema->id,
        'status' => Pendaftaran::STATUS_DITERIMA,
    ]);

    $response = $this->actingAs($asesor)->post(route('asesor.nilai', $pendaftaran->id), [
        'nilai' => [1 => 80],
    ]);

    $response->assertRedirect(route('asesor.dashboard'));
    $response->assertSessionHas('error');

    expect(NilaiKriteria::count())->toBe(0);
});
