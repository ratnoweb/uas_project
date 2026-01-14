<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. User Admin
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Redaksi',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Kategori (LENGKAP)
        $categories = [
            'News', 'Kriminal', 'Politik', 'Olahraga', 
            'Budaya', 'Wisata', 'Ekonomi', 'Pendidikan',
            'Kesehatan', 'Teknologi'
        ];
        
        $catMap = []; 
        foreach ($categories as $cat) {
            $c = Category::firstOrCreate(
                ['slug' => Str::slug($cat)], 
                ['name' => $cat]
            );
            $catMap[$cat] = $c->id;
        }

        // 3. BANK DATA CERDAS (Mapping Judul ke Isi Konten Spesifik)
        // Format: [Nama Kategori, Judul Dasar, [List Paragraf Relevan]]
        $smartArticles = [
            [
                'Olahraga',
                "Sirkuit Mandalika Siap Gelar MotoGP 2026",
                [
                    "Aktivitas di Sirkuit Internasional Mandalika semakin padat. Truk logistik tim balap mulai berdatangan di Bandara BIZAM.",
                    "Direktur MGPA memastikan kesiapan lintasan sudah 100 persen. Pengecatan kerb dan perbaikan drainase telah rampung.",
                    "Antusiasme warga lokal sangat tinggi menyambut ribuan wisatawan mancanegara yang diprediksi membanjiri Lombok Tengah.",
                ]
            ],
            [
                'Ekonomi',
                "Harga Cabai di Pasar Mandalika Melonjak Drastis",
                [
                    "Ibu rumah tangga di Mataram mengeluhkan kenaikan harga bahan pokok. Cabai rawit kini tembus Rp 90.000 per kilogram.",
                    "Pedagang mengaku omzet menurun karena pembeli mengurangi belanjaan. Stok dari petani menipis akibat cuaca buruk.",
                    "Pemerintah Provinsi NTB berjanji segera menggelar operasi pasar murah untuk menstabilkan harga jelang hari raya.",
                ]
            ],
            [
                'Kriminal',
                "Polres Loteng Gagalkan Penyelundupan Benih Lobster",
                [
                    "Tim Opsnal Polres Lombok Tengah berhasil menggagalkan pengiriman 5.000 ekor benih lobster ilegal tujuan luar negeri.",
                    "Pelaku ditangkap di sebuah gudang tersembunyi di Praya Barat. Barang bukti box sterofoam diamankan polisi.",
                    "Pelaku terancam hukuman penjara 5 tahun sesuai UU Perikanan. Polisi masih memburu otak sindikat ini.",
                ]
            ],
            [
                'Wisata',
                "Gili Trawangan Dipadati Turis Asing Akhir Pekan Ini",
                [
                    "Pelabuhan Bangsal terlihat padat merayap. Ribuan wisatawan antre menyeberang ke Gili Trawangan sejak pagi buta.",
                    "Okupansi hotel dilaporkan mencapai 95 persen. Ini rekor tertinggi pasca pemulihan pariwisata daerah.",
                    "Wisatawan tampak menikmati snorkeling dan bersepeda. Pihak keamanan desa adat meningkatkan patroli kenyamanan.",
                ]
            ],
            [
                'Pendidikan',
                "Unram Wisuda 1.500 Sarjana Baru Periode Ini",
                [
                    "Universitas Mataram kembali meluluskan ribuan mahasiswa. Rektor berpesan agar alumni siap bersaing di era digital.",
                    "Suasana haru terlihat saat wisudawan terbaik dari Fakultas Pertanian dipanggil ke panggung bersama orang tuanya.",
                    "Diharapkan lulusan baru ini dapat membuka lapangan kerja sendiri dan tidak hanya bergantung pada lowongan PNS.",
                ]
            ],
            [
                'Budaya',
                "Festival Peresean Digelar Meriah di Taman Budaya",
                [
                    "Suara gamelan mengiringi pertarungan pepadu di arena Peresean. Ribuan penonton bersorak memberikan semangat.",
                    "Tradisi adu ketangkasan ini digelar untuk melestarikan budaya Sasak dan menarik minat wisatawan domestik.",
                    "Meski bertarung sengit, para pepadu langsung berpelukan usai laga, menjunjung tinggi nilai persaudaraan.",
                ]
            ],
            [
                'News',
                "Gubernur NTB Resmikan Jembatan Desa Terpencil",
                [
                    "Warga akhirnya bisa tersenyum lega. Jembatan penghubung desa ke pusat kota resmi dibuka oleh Gubernur hari ini.",
                    "Sebelumnya, warga harus menyeberang sungai deras atau memutar 10 km untuk menjual hasil bumi.",
                    "Pemerintah menegaskan komitmen pemerataan pembangunan infrastruktur hingga ke pelosok tanpa terkecuali.",
                ]
            ],
            [
                'News',
                "Car Free Day Udayana Kembali Ramai Pengunjung",
                [
                    "Jalan Udayana Mataram berubah menjadi lautan manusia. Warga antusias berolahraga pagi menikmati udara segar.",
                    "Pedagang kuliner lokal laris manis. Sate bulayak dan pelecing kangkung menjadi primadona sarapan warga.",
                    "Dishub menutup akses kendaraan total selama 3 jam untuk menjamin keamanan pejalan kaki dan pesepeda.",
                ]
            ],
            [
                'Politik',
                "DPRD Soroti Jalan Rusak di Kawasan Sekotong",
                [
                    "Komisi IV DPRD NTB melakukan sidak ke Lombok Barat menyusul laporan warga tentang jalan berlubang.",
                    "Dewan mendesak Dinas PUPR segera melakukan perbaikan sebelum jatuh korban jiwa, apalagi ini jalur wisata.",
                    "Warga mengancam akan menanam pohon pisang di tengah jalan jika perbaikan tidak segera dilakukan.",
                ]
            ],
            [
                'Kriminal',
                "Razia Knalpot Brong di Mataram, Puluhan Motor Diamankan",
                [
                    "Satlantas Polresta Mataram menggelar razia balap liar dan knalpot bising yang meresahkan warga saat malam hari.",
                    "Puluhan remaja terjaring razia. Mereka diwajibkan mengganti knalpot standar dan memusnahkan knalpot brong sendiri.",
                    "Polisi menegaskan tidak ada toleransi bagi pelanggar ketertiban umum di jalan raya.",
                ]
            ],
            [
                'Teknologi',
                "Anak Muda Lombok Ciptakan Aplikasi E-Commerce Lokal",
                [
                    "Sekelompok mahasiswa STMIK di Mataram meluncurkan startup baru yang fokus memasarkan produk UMKM NTB.",
                    "Aplikasi ini diharapkan membantu pengrajin tenun dan mutiara menjangkau pasar internasional dengan mudah.",
                    "Dinas Perindustrian memberikan apresiasi dan janji pendampingan inkubasi bisnis bagi startup lokal ini.",
                ]
            ],
            [
                'Kesehatan',
                "RSUD Provinsi NTB Tambah Fasilitas Operasi Jantung",
                [
                    "Kabar gembira bagi warga NTB. RSUD Provinsi kini memiliki alat canggih untuk operasi pasang ring jantung.",
                    "Pasien tidak perlu lagi dirujuk ke Bali atau Jawa, sehingga biaya pengobatan bisa lebih hemat.",
                    "Gubernur berharap peningkatan layanan ini diimbangi dengan keramahan tenaga medis kepada pasien.",
                ]
            ],
            [
                'Wisata',
                "Pesona Bukit Merese Jadi Spot Sunset Terbaik",
                [
                    "Bukit Merese di Kuta Mandalika tak pernah sepi pengunjung jelang sore hari. Pemandangan laut lepas memukau mata.",
                    "Banyak konten kreator menjadikan lokasi ini sebagai latar video estetik mereka.",
                    "Pengelola parkir menghimbau pengunjung tetap menjaga kebersihan dan tidak membuang sampah plastik sembarangan.",
                ]
            ],
            [
                'Ekonomi',
                "Ekspor Manggis Lombok Tembus Pasar China",
                [
                    "Petani manggis di Narmada sumringah. Hasil panen mereka tahun ini berhasil diekspor langsung ke Tiongkok.",
                    "Kualitas buah lokal dinilai sangat kompetitif. Dinas Pertanian terus melakukan pendampingan SOP pasca panen.",
                    "Nilai transaksi ekspor ini mencapai miliaran rupiah, mendongkrak devisa daerah secara signifikan.",
                ]
            ]
        ];

        // 4. GENERATE 50+ DATA (Looping Cerdas)
        // Kita punya 14 template. Kita loop 4 kali = 56 Berita.
        
        $totalBatch = 4; // Mau berapa kali lipat datanya?

        for ($batch = 1; $batch <= $totalBatch; $batch++) {
            
            foreach ($smartArticles as $index => $data) {
                $categoryName = $data[0];
                $titleBase = $data[1];
                $paragraphs = $data[2];

                // Variasi Judul biar tidak kembar persis
                $variation = "";
                if ($batch == 2) $variation = " - Update Terkini";
                if ($batch == 3) $variation = " - Sorotan Publik";
                if ($batch == 4) $variation = " : Analisis Mendalam";

                $title = $titleBase . $variation;
                
                // Rakit Body Artikel Panjang
                $bodyHtml = "<p class='lead font-bold'><strong>MATARAM (Lombok News)</strong> - " . $title . ".</p>";
                
                // Ulangi paragraf agar artikel terlihat panjang & profesional
                for ($p = 0; $p < 3; $p++) { 
                    foreach ($paragraphs as $par) {
                        $bodyHtml .= "<p class='mb-4 text-justify'>" . $par . " " . $paragraphs[array_rand($paragraphs)] . "</p>";
                    }
                    if ($p == 1) $bodyHtml .= "<h3 class='text-xl font-bold mt-6 mb-4'>Fakta dan Data Lapangan</h3>";
                }
                
                $bodyHtml .= "<p class='mt-6 italic text-gray-500'>Penulis: Tim Redaksi Lombok News (Batch " . $batch . ")</p>";

                // Tentukan Kategori ID (Fallback ke News jika typo)
                $catId = $catMap[$categoryName] ?? $catMap['News'];

                Post::create([
                    'user_id' => $user->id,
                    'category_id' => $catId,
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::random(6),
                    'excerpt' => Str::limit($paragraphs[0], 130) . "...",
                    'body' => $bodyHtml,
                    // Gambar berbeda untuk setiap berita
                    'image' => 'https://picsum.photos/seed/ntb_' . $index . '_' . $batch . '/800/600',
                    'views' => 0, // Reset ke 0
                    'is_headline' => ($batch == 1 && $index < 3), // Hanya batch 1 yang jadi headline awal
                    'is_editor_choice' => ($batch == 1 && $index >= 3 && $index < 8),
                    // Tanggal dibuat acak mundur
                    'published_at' => now()->subHours(rand(1, 300)), 
                ]);
            }
        }
        
        echo "\nSUKSES! 50+ Berita telah dibuat dengan kategori lengkap.\n";
    }
}