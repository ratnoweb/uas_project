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
            ['email' => 'admin@lomboknews.com'],
            [
                'name' => 'Admin Redaksi',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Kategori
        $categories = ['News', 'Kriminal', 'Politik', 'Olahraga', 'Budaya', 'Wisata', 'Ekonomi', 'Pendidikan'];
        $catMap = []; // Untuk mapping nama kategori ke ID
        foreach ($categories as $cat) {
            $c = Category::firstOrCreate(['slug' => Str::slug($cat)], ['name' => $cat]);
            $catMap[$cat] = $c->id;
        }

        // 3. DATA CERDAS (Mapping Judul ke Isi Konten Spesifik)
        // Format: [Kategori, Judul, [Array Paragraf Khusus Topik Ini]]
        $smartArticles = [
            [
                'Olahraga',
                "Sirkuit Mandalika Siap Gelar MotoGP 2026, Logistik Mulai Tiba",
                [
                    "Aktivitas di Sirkuit Internasional Mandalika semakin padat menjelang perhelatan akbar MotoGP musim 2026. Truk-truk kontainer pembawa logistik tim balap mulai berdatangan di Bandara BIZAM sejak pagi tadi.",
                    "Direktur MGPA memastikan kesiapan lintasan sudah mencapai 100 persen. Pengecatan ulang kerb dan perbaikan drainase telah rampung dilakukan minggu lalu.",
                    "Antusiasme warga lokal sangat tinggi. Warung-warung di sekitar sirkuit mulai berbenah menyambut ribuan wisatawan mancanegara yang diprediksi akan membanjiri Lombok Tengah.",
                    "Pihak Dorna Sports memuji kesiapan panitia lokal yang dinilai jauh lebih profesional dibandingkan tahun-tahun sebelumnya.",
                ]
            ],
            [
                'Ekonomi',
                "Harga Cabai di Pasar Mandalika Mataram Melonjak Jelang Ramadhan",
                [
                    "Para ibu rumah tangga di Kota Mataram mulai mengeluhkan kenaikan harga bahan pokok. Pantauan di Pasar Mandalika, harga cabai rawit merah kini menembus angka Rp 80.000 per kilogram.",
                    "Salah satu pedagang, Ibu Sumiati, mengaku omzetnya menurun karena pembeli mengurangi jumlah belanjaan. 'Biasanya beli sekilo, sekarang cuma beli seperempat ons,' keluhnya.",
                    "Kepala Dinas Perdagangan menduga kenaikan ini akibat gagal panen di tingkat petani karena cuaca ekstrem yang melanda Lombok Timur minggu lalu.",
                    "Pemerintah berjanji akan segera menggelar operasi pasar murah di tiga titik kelurahan untuk menstabilkan harga sebelum bulan puasa tiba.",
                ]
            ],
            [
                'Kriminal',
                "Polres Lombok Tengah Gagalkan Penyelundupan Benih Lobster",
                [
                    "Tim Opsnal Polres Lombok Tengah berhasil menggagalkan upaya penyelundupan 5.000 ekor benih lobster (benur) yang rencananya akan dikirim ke luar negeri secara ilegal.",
                    "Kapolres dalam konferensi pers menjelaskan bahwa pelaku ditangkap di sebuah gudang tersembunyi di wilayah Praya Barat. Barang bukti berupa box sterofoam dan tabung oksigen turut diamankan.",
                    "Pelaku berinisial AR mengaku hanya sebagai kurir dengan upah Rp 500 ribu per pengiriman. Polisi kini tengah memburu otak utama di balik sindikat ini.",
                    "Akibat perbuatannya, pelaku terancam hukuman penjara maksimal 5 tahun sesuai UU Perikanan yang berlaku.",
                ]
            ],
            [
                'Wisata',
                "Wisatawan Mancanegara Padati Gili Trawangan di Awal Tahun",
                [
                    "Suasana di pelabuhan Bangsal pagi ini terlihat sangat ramai. Ribuan wisatawan asing antre menaiki fast boat menuju tiga gili, terutama Gili Trawangan.",
                    "Okupansi hotel dan villa di Gili Trawangan dilaporkan mencapai 90 persen. Ketua Asosiasi Hotel mengatakan ini adalah rekor tertinggi pasca pemulihan ekonomi.",
                    "Para turis tampak menikmati aktivitas snorkeling dan bersepeda mengelilingi pulau. Cuaca cerah membuat air laut terlihat jernih kebiruan.",
                    "Pihak keamanan desa adat setempat meningkatkan patroli untuk memastikan kenyamanan pengunjung dari gangguan pedagang asongan yang memaksa.",
                ]
            ],
            [
                'Pendidikan',
                "Unram Wisuda 1.500 Mahasiswa, Rektor Pesan Jaga Nama Baik",
                [
                    "Universitas Mataram (Unram) kembali menggelar wisuda periode Januari 2026 di Auditorium M. Yusuf Abubakar. Sebanyak 1.500 wisudawan resmi menyandang gelar sarjana.",
                    "Dalam pidatonya, Rektor menekankan pentingnya soft skill di era digital. 'IPK tinggi saja tidak cukup, kalian harus punya kemampuan adaptasi,' tegasnya.",
                    "Suasana haru menyelimuti acara saat wisudawan terbaik dari Fakultas Pertanian dipanggil ke atas panggung bersama kedua orang tuanya yang bekerja sebagai petani.",
                    "Lulusan diharapkan dapat membuka lapangan kerja baru dan tidak hanya bergantung pada lowongan PNS.",
                ]
            ],
            [
                'Budaya',
                "Festival Peresean Kembali Digelar di Taman Budaya Mataram",
                [
                    "Suara gamelan bertalu-talu mengiringi pertarungan dua pepadu di arena Peresean Taman Budaya NTB. Ribuan penonton bersorak memberikan semangat.",
                    "Tradisi adu ketangkasan menggunakan rotan dan perisai kulit kerbau ini digelar dalam rangka melestarikan budaya suku Sasak.",
                    "Meskipun pertarungan terlihat keras, kedua petarung langsung berpelukan usai laga, menjunjung tinggi nilai sportivitas dan persaudaraan.",
                    "Dinas Kebudayaan berharap event ini bisa masuk dalam kalender pariwisata nasional untuk menarik lebih banyak turis.",
                ]
            ],
            [
                'News',
                "Gubernur NTB Resmikan Jembatan Penghubung Desa Terpencil",
                [
                    "Warga Desa Batu Rotok akhirnya bisa tersenyum lega. Jembatan gantung yang menghubungkan desa mereka dengan pusat kecamatan resmi dibuka oleh Gubernur NTB hari ini.",
                    "Sebelumnya, warga harus menyeberangi sungai deras atau memutar sejauh 10 kilometer untuk menjual hasil bumi ke pasar.",
                    "Dalam sambutannya, Gubernur menegaskan komitmen pemerataan pembangunan infrastruktur hingga ke pelosok desa tanpa terkecuali.",
                    "Anak-anak sekolah kini tidak perlu lagi bertaruh nyawa menyeberang sungai saat musim hujan tiba.",
                ]
            ],
            [
                'News',
                "Warga Mataram Antusias Ikuti Car Free Day Udayana",
                [
                    "Jalan Udayana Mataram pagi ini berubah menjadi lautan manusia. Ribuan warga tumpah ruah menikmati udara bebas polusi di ajang Car Free Day (CFD).",
                    "Berbagai komunitas turut meramaikan acara, mulai dari komunitas sepeda tua, senam zumba, hingga pecinta reptil.",
                    "Para pedagang kuliner lokal di sepanjang jalan juga ketiban rezeki. Jajanan khas seperti sate bulayak dan pelecing kangkung laris manis diserbu pengunjung.",
                    "Dinas Perhubungan menutup akses kendaraan bermotor sejak pukul 06.00 hingga 09.00 WITA untuk menjamin keamanan warga yang berolahraga.",
                ]
            ],
            [
                'Politik',
                "DPRD NTB Soroti Lambatnya Perbaikan Jalan di Sekotong",
                [
                    "Komisi IV DPRD NTB melakukan inspeksi mendadak (sidak) ke wilayah Sekotong, Lombok Barat, menyusul banyaknya laporan warga tentang jalan rusak.",
                    "Anggota dewan menemukan banyak lubang besar yang membahayakan pengendara motor, terutama saat malam hari karena minim penerangan.",
                    "DPRD mendesak Dinas PUPR segera melakukan tambal sulam sebelum jatuh korban jiwa, mengingat jalur ini adalah akses pariwisata.",
                    "Warga setempat mengancam akan menanam pohon pisang di tengah jalan jika tuntutan perbaikan tidak segera dipenuhi.",
                ]
            ],
            [
                'Kriminal',
                "Polisi Razia Knalpot Brong di Jalan Langko Mataram",
                [
                    "Satlantas Polresta Mataram menggelar razia besar-besaran terhadap penggunaan knalpot tidak standar (brong) yang meresahkan warga.",
                    "Puluhan sepeda motor terjaring dalam operasi ini. Pengendara diwajibkan mengganti knalpot di tempat dan menghancurkan knalpot brong mereka sendiri.",
                    "Kasat Lantas menegaskan tidak ada toleransi bagi pelanggar karena suara bising sangat mengganggu ketertiban umum dan istirahat warga di malam hari.",
                    "Operasi ini akan terus dilakukan secara rutin setiap malam minggu di titik-titik rawan balap liar.",
                ]
            ]
        ];

        // 4. GENERATE DATA (Looping agar jadi banyak, tapi konten RELEVAN)
        // Kita ulangi array di atas 5 kali (10 artikel x 5 = 50 artikel total)
        for ($loop = 1; $loop <= 5; $loop++) {
            
            foreach ($smartArticles as $index => $data) {
                $categoryName = $data[0];
                $titleBase = $data[1];
                $paragraphs = $data[2]; // Ini paragraf KHUSUS untuk judul ini

                // Tambahkan variasi judul sedikit biar slug beda
                $title = $titleBase . ($loop > 1 ? " - Update #" . $loop : "");
                
                // RAKIT BODY DARI PARAGRAF KHUSUS
                $bodyHtml = "<p class='lead font-bold'><strong>MATARAM (Lombok News)</strong> - " . $title . ".</p>";
                
                // Ulangi paragraf khusus tersebut agar artikel jadi PANJANG
                for ($i = 0; $i < 4; $i++) { // 4 kali pengulangan blok paragraf
                    foreach ($paragraphs as $p) {
                         $bodyHtml .= "<p class='mb-4 text-justify'>" . $p . "</p>";
                    }
                    // Tambah sub-judul pemanis di tengah
                    if ($i == 1) {
                        $bodyHtml .= "<h3 class='text-xl font-bold mt-6 mb-4'>Tanggapan dan Analisis Situasi</h3>";
                    }
                }
                
                $bodyHtml .= "<p class='mt-6 italic text-gray-500'>Laporan Tim Redaksi Lombok News dari lokasi kejadian.</p>";

                Post::create([
                    'user_id' => $user->id,
                    'category_id' => $catMap[$categoryName], // Pastikan masuk kategori yang benar
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::random(5),
                    'excerpt' => Str::limit($paragraphs[0], 120), // Excerpt ambil dari paragraf pertama yang relevan
                    'body' => $bodyHtml,
                    'image' => 'https://picsum.photos/seed/lombok' . $index . $loop . '/800/600',
                    'views' => 0,
                    'is_headline' => ($loop == 1 && $index < 3), // Set Headline hanya untuk batch pertama
                    'is_editor_choice' => ($loop == 1 && $index >= 3 && $index < 8),
                    'published_at' => now()->subHours(rand(1, 168)),
                ]);
            }
        }
        
        echo "SUKSES: 50 Berita Cerdas Berhasil Dibuat (Judul & Isi Sesuai)!";
    }
}