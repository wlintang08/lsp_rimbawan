<?php

namespace App\Http\Controllers;

use App\Models\Skema;

class FrontController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'homeNews' => array_slice(self::newsItems(), 0, 3),
        ]);
    }

    public function news()
    {
        return view('front.news', [
            'featuredNews' => self::newsItems()[0],
            'newsItems' => array_slice(self::newsItems(), 1),
        ]);
    }

    public function newsDetail(string $slug)
    {
        $news = collect(self::newsItems())->firstWhere('slug', $slug);

        abort_if(! $news, 404);

        $relatedNews = collect(self::newsItems())
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('front.news-detail', compact('news', 'relatedNews'));
    }

    public function alur()
    {
        return view('front.alur');
    }

    public function skema()
    {
        $skema = Skema::with('kriterias')->get();

        // Pre-build JSON data for the modal (avoid complex expressions in Blade @json)
        $skemaJson = [];
        foreach ($skema as $s) {
            $kriterias = [];
            foreach ($s->kriterias as $k) {
                $kriterias[] = ['nama' => $k->nama, 'bobot' => $k->bobot];
            }
            $skemaJson[$s->id] = [
                'id'         => $s->id,
                'nama_skema' => $s->nama_skema,
                'deskripsi'  => $s->deskripsi ?? 'Skema ini dirancang untuk memastikan tenaga profesional memiliki kompetensi yang sesuai dengan standar nasional dalam ruang lingkup kehutanan dan pelestarian alam.',
                'kriterias'  => $kriterias,
            ];
        }

        return view('front.skema', compact('skema', 'skemaJson'));
    }

    public static function newsItems(): array
    {
        return [
            [
                'slug' => 'asesmen-pengukuran-kayu-lapangan',
                'category' => 'Asesmen',
                'date' => '16 Apr 2025',
                'title' => 'Kegiatan asesmen GANISPH Pengujian Kayu Bulat',
                'excerpt' => 'Peserta sedang mendemontrasikan pengukuran dan pengujian kayu bulat',
                'image' => 'image/gambar1.jpeg',
                'image_remote' => false,
                'image_position' => 'center 35%',
                'alt' => 'Peserta asesmen mengukur dan mencatat data kayu',
                'body' => [
                    'LSP Rimbawan melaksanakan asesmen GANISPH PKB dengan metode observasi langsung. Peserta uji kompetensi mendemontrasikan pengukuran dan pengujian kayu bulat yang telah ditetapkan di tempat uji kompetensi (TUK), dengan metode tersebut diperoleh gambaran terhadap knowledge, skill dan attitude dari peserta uji kompetensi.',
                ],
            ],
            [
                'slug' => 'Asesmen-GANISPH-perencanaan-hutan',
                'category' => 'Asesmen',
                'date' => '09 Apr 2026',
                'title' => 'Asesmen GANISPH Perencanaan Hutan',
                'excerpt' => 'Demontrasi pada kelompok pekerjaan inventarisasi hutan',
                'image' => 'image/gambar3.jpeg',
                'image_remote' => false,
                'image_position' => 'center',
                'alt' => 'Area hutan dan jalur lapangan',
                'body' => [
                    'Salah satu tugas GANISPH Canghut adalah melaksanakan inventarisasi hutan. Untuk memastikan peserta kompeten pada kelompok pekerjaan tersebut maka peserta mendemontrasikan pelaksanaan inventarisasi hutan. Nampak pada gambar tersebut peserta sedang mendemontrasikan kegiatan pengukuran diameter pohon, dan pengenalan jenis.',
                ],
            ],
            [
                'slug' => 'verifikasi-sertifikat-digital',
                'category' => 'Verifikasi',
                'date' => '15 Juli 2023',
                'title' => 'Uji Kompetensi GANISPH PKB di industri kehutanan',
                'excerpt' => 'Akurasi dan presisi pengukuran serta pengujian kayu bulat sangat diperlukan di industri kehutanan. Untuk memastikan akurasi dan presisi seorang GANISPH PKB maka dapat dilakukan dengan demontrasi  pengukuran dan pengujian kayu bulat yanng ada di TPK (Tempat Penimbunan Kayu).',
                'image' => 'image/gambar4.jpeg',
                'image_remote' => false,
                'image_position' => 'center',
                'alt' => 'Dokumen kerja dan proses verifikasi',
                'body' => [
                    'Seorang peserta uji kompetensi GANISPH PKB sedang mendemontrasikan penngukuran dan pengujian kayu bulat.  Metode tersebut digunakan oleh asesor dalam rangka memastikan pencapaian kompetensi GANISPH PKB. Biasanya didalam uji kompetensi selain demontrasi peserta digali penngetahuannnya menggunakan metode tanya jawab. Kombinasi metode tersebut digunakan oleh asesor kompetensi untuk mengambil keputusan terhadap peserta uji, apakah peserta telah KOMPETEN atau BELUM KOMPETEN. ',

                ],
            ],
            [
                'slug' => 'persiapan-asesor-sebelum-penilaian',
                'category' => 'Asesor',
                'date' => '30 Sep 2026',
                'title' => 'Peningkatan Kompetensi Teknis Asesor LSP Rimbawan dan Lingkungan Bidang Nilai Ekonomi Karbon',
                'excerpt' => 'Kompetensi teknis para asesor perlu terjaga guna meningkatkan penjaminan mutu pelaksanaan sertifikasi oleh LSP Rimbawan dan Lingkungan.',
                'image' => 'image/gambar5.jpeg',
                'image_remote' => false,
                'image_position' => 'center',
                'alt' => 'Tim asesor berdiskusi sebelum penilaian',
                'body' => [
                    'LSP Rimbawan dan Lingkungan menyelenggarakan bimbingan teknis (Bimtek) guna meningkatkan kompetensi teknis para asesor. Bimtek dilakukan di Pusdiklat SDM Kehutanan Gunung Batu, Bogor. Bimtek kali ini terkait bidang Nilai Ekonomi Karbon (NEK) mencakup skema: Penyusunan DRAM, Verifikator dan Validator Nilai Ekonomi Karbon (NEK) dan Penyusunan Laporan Capaian Aksi Mitigasi (LCAM). Bimtek juga termasuk praktik dilapangan untuk perhitungan karbon yang berlokasi di hutan pendidikan CIFOR.',
                ],
            ],
            [
                'slug' => 'alur-sertifikasi-untuk-asesi-baru',
                'category' => 'Panduan',
                'date' => '24 Sep 2026',
                'title' => 'Bimtek Asesor LSP Rimbawan dan Lingkungan terkait perhitungan karbon.',
                'excerpt' => 'Peningkatan kompetensi teknis asesor bidang Nilai Ekonomi Karbon.',
                'image' => 'image/gambar6.jpeg',
                'image_remote' => false,
                'image_position' => 'center',
                'alt' => 'Peserta mempelajari dokumen panduan',
                'body' => [
                    'Asesor LSP Rimbawan dan Lingkungan sedang melakukan praktik inventarisasi hutan dalam rangka perhitungan cadangan karbon',
                ],
            ],
            [
                'slug' => 'penguatan-kompetensi-lingkungan-hidup',
                'category' => 'Kompetensi',
                'date' => '18 Sep 2026',
                'title' => 'Penguatan Kompetensi Teknis Asesor untuk Meningkatkan Penjaminan Mutu Sertifikasi LSP Rimbawan dan Lingkungan',
                'excerpt' => 'Praktik pengambilan sempel untuk perhitungan cadangan karbon hutan',
                'image' => 'image/gambar7.jpeg',
                'image_remote' => false,
                'image_position' => 'center 5%',
                'alt' => 'Kawasan hutan sebagai konteks kompetensi lingkungan',
                'body' => [
                    'Praktik pengambilan sempel di hutan pendidikan CIFOR',
                ],
            ],
        ];
    }
}
