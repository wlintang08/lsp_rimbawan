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
                'date' => '12 Okt 2026',
                'title' => 'Kegiatan asesmen pengukuran kayu berlangsung lebih tertib dan terukur.',
                'excerpt' => 'Peserta asesmen mempraktikkan pencatatan dan pengukuran kayu secara langsung sebagai bagian dari pembuktian kompetensi lapangan.',
                'image' => 'image/gambar1.jpeg',
                'image_remote' => false,
                'image_position' => 'center 35%',
                'alt' => 'Peserta asesmen mengukur dan mencatat data kayu',
                'body' => [
                    'LSP Rimbawan melaksanakan asesmen lapangan untuk memastikan peserta mampu menerapkan prosedur pengukuran, pencatatan, dan pemeriksaan kayu secara konsisten.',
                    'Kegiatan ini menekankan ketelitian peserta dalam membaca kondisi bahan, mengisi formulir kerja, dan mengikuti arahan asesor. Setiap proses dinilai berdasarkan bukti kompetensi yang dapat diamati langsung.',
                    'Melalui asesmen praktik seperti ini, peserta tidak hanya diuji dari sisi pengetahuan, tetapi juga dari kesiapan bekerja sesuai standar industri kehutanan dan lingkungan hidup.',
                ],
            ],
            [
                'slug' => 'jadwal-pendaftaran-skema-sertifikasi',
                'category' => 'Pendaftaran',
                'date' => '08 Okt 2026',
                'title' => 'Pendaftaran skema sertifikasi periode terbaru dibuka untuk peserta umum.',
                'excerpt' => 'Calon asesi dapat memilih skema sesuai bidang kompetensi dan melengkapi berkas sebelum jadwal asesmen ditetapkan.',
                'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'image_remote' => true,
                'image_position' => 'center',
                'alt' => 'Area hutan dan jalur lapangan',
                'body' => [
                    'Pendaftaran skema sertifikasi dibuka untuk peserta yang ingin mengikuti proses asesmen kompetensi di bidang kehutanan dan lingkungan hidup.',
                    'Peserta disarankan membaca persyaratan setiap skema, menyiapkan identitas, dan memastikan dokumen pendukung sudah sesuai sebelum mengirimkan pendaftaran.',
                    'Informasi lanjutan mengenai jadwal asesmen akan diberikan setelah data peserta diverifikasi oleh tim administrasi.',
                ],
            ],
            [
                'slug' => 'verifikasi-sertifikat-digital',
                'category' => 'Verifikasi',
                'date' => '05 Okt 2026',
                'title' => 'Sertifikat digital dapat diverifikasi lebih cepat melalui halaman pemeriksaan.',
                'excerpt' => 'Fitur verifikasi membantu lembaga, perusahaan, dan pemegang sertifikat memastikan keabsahan data secara mandiri.',
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'image_remote' => true,
                'image_position' => 'center',
                'alt' => 'Dokumen kerja dan proses verifikasi',
                'body' => [
                    'Halaman verifikasi sertifikat disiapkan agar data kelulusan dapat diperiksa dengan mudah oleh pihak yang membutuhkan.',
                    'Setiap sertifikat memiliki data rujukan yang membantu proses pengecekan status, nama peserta, dan skema yang telah diikuti.',
                    'Fitur ini mendukung transparansi sekaligus memperkuat kepercayaan terhadap hasil sertifikasi yang diterbitkan.',
                ],
            ],
            [
                'slug' => 'persiapan-asesor-sebelum-penilaian',
                'category' => 'Asesor',
                'date' => '30 Sep 2026',
                'title' => 'Asesor menyiapkan instrumen penilaian sebelum pelaksanaan asesmen.',
                'excerpt' => 'Koordinasi asesor dilakukan untuk menjaga objektivitas, kelengkapan dokumen, dan kesesuaian standar penilaian.',
                'image' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'image_remote' => true,
                'image_position' => 'center',
                'alt' => 'Tim asesor berdiskusi sebelum penilaian',
                'body' => [
                    'Sebelum asesmen dilaksanakan, asesor meninjau kembali instrumen penilaian dan kebutuhan administrasi peserta.',
                    'Persiapan ini bertujuan memastikan proses penilaian berjalan objektif, terdokumentasi, dan mengikuti standar yang berlaku.',
                    'Koordinasi antarasesor juga membantu menyamakan persepsi terhadap indikator kompetensi yang akan dinilai.',
                ],
            ],
            [
                'slug' => 'alur-sertifikasi-untuk-asesi-baru',
                'category' => 'Panduan',
                'date' => '24 Sep 2026',
                'title' => 'Alur sertifikasi membantu asesi baru memahami proses dari daftar sampai hasil.',
                'excerpt' => 'Panduan alur dibuat agar peserta mengetahui tahapan pendaftaran, verifikasi, asesmen, dan penerbitan sertifikat.',
                'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'image_remote' => true,
                'image_position' => 'center',
                'alt' => 'Peserta mempelajari dokumen panduan',
                'body' => [
                    'Asesi baru dapat mengikuti alur sertifikasi untuk memahami tahapan yang harus dilalui sejak pendaftaran awal.',
                    'Setiap tahapan memiliki dokumen dan tindak lanjut yang perlu diperhatikan agar proses tidak tertunda.',
                    'Dengan panduan yang jelas, peserta dapat mempersiapkan diri lebih baik sebelum memasuki jadwal asesmen.',
                ],
            ],
            [
                'slug' => 'penguatan-kompetensi-lingkungan-hidup',
                'category' => 'Kompetensi',
                'date' => '18 Sep 2026',
                'title' => 'Penguatan kompetensi lingkungan hidup menjadi bagian penting sertifikasi.',
                'excerpt' => 'Sertifikasi mendorong tenaga kerja memahami praktik kerja yang bertanggung jawab terhadap hutan dan lingkungan.',
                'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'image_remote' => true,
                'image_position' => 'center',
                'alt' => 'Kawasan hutan sebagai konteks kompetensi lingkungan',
                'body' => [
                    'Kompetensi lingkungan hidup menjadi salah satu aspek penting dalam mendukung praktik kerja yang bertanggung jawab.',
                    'Melalui sertifikasi, tenaga kerja didorong memahami standar, risiko, dan prosedur yang relevan dengan kegiatan di lapangan.',
                    'Peningkatan kompetensi ini diharapkan memberi dampak positif bagi kualitas pekerjaan dan perlindungan lingkungan.',
                ],
            ],
        ];
    }
}
