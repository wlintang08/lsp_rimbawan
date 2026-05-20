<?php

it('shows the public landing page for guests', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('LSP RIMBAWAN');
    $response->assertSee('Home');
    $response->assertSee('News');
    $response->assertSee('Skema Sertifikasi');
    $response->assertSee('Login');
    $response->assertSee('Cari Skema Sertifikasi');
});
