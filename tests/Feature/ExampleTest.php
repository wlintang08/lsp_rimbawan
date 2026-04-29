<?php

it('shows the public landing page for guests', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Dashboard');
    $response->assertSee('News');
    $response->assertSee('Skema Sertifikasi');
    $response->assertSee('Login');
    $response->assertSee('Register');
});
