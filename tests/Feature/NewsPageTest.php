<?php

it('shows news cards with readable detail links', function () {
    $response = $this->get('/news');

    $response->assertOk();
    $response->assertSee('Informasi Terbaru');
    $response->assertSee('Kegiatan asesmen pengukuran kayu berlangsung lebih tertib dan terukur.');
    $response->assertSee(route('news.detail', 'asesmen-pengukuran-kayu-lapangan'));
    $response->assertSee('Baca selengkapnya');
});

it('shows a public news detail page', function () {
    $response = $this->get('/news/asesmen-pengukuran-kayu-lapangan');

    $response->assertOk();
    $response->assertSee('Kegiatan asesmen pengukuran kayu berlangsung lebih tertib dan terukur.');
    $response->assertSee('Kembali ke berita');
    $response->assertSee('Berita lainnya');
});
