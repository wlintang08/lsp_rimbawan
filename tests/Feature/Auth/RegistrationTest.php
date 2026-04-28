<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@gmail.com',
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('verification.notice', absolute: false));
});
