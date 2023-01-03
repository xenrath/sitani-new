<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'judul' => 'Cabai kompak turun',
                'isi' => 'Berdasarkan data dalam Sistem Pemantauan Pasar dan Kebutuhan Pokok (SP2KP) Kementerian Perdagangan, hampir seluruh komoditas berada dalam posisi stabil, kecuali cabai dan minyak goreng mengalami penurunan Harga cabai merah besar hari ini turun Rp200 menjadi Rp37.000 per kilogram (kg) dibanding hari kemarin. Cabai merah keriting mengalami penurunan terjauh sebesar 1,89 persen setara Rp300, dari Rp37.100 menjadi Rp36.400 per kg. Adapun, harga cabai rawit merah turun Rp100 dari Rp47.900 menjadi Rp47.800/kg.',
                'gambar' => 'berita/cabainaik.jpg',
                'date' => '05/11/22',
            ],
            [
                'judul' => 'Program Pembinaan UMKM Pertanian',
                'isi' => 'Sektor pertanian merupakan salah satu yang mendukung peningkatan perekonomian. Salah satu sektor tersebut adalah komoditas hortikultura.Yayasan Dharma Bhakti Astra (YDBA) bersama Pusat Investasi Pemerintah (PIP), Kementerian Keuangan RI berkolaborasi melakukan pembinaan UMKM di wilayah Puncak Dua, Jawa Barat, dengan fokus pada pembinaan UMKM pertanian hortikultura. YDBA terus berupaya untuk mengembangkan UMKM di Indonesia agar naik kelas, mandiri dan dapat bersaing hingga berdampak pada peningkatan ekonomi dan terciptanya lapangan kerja.',
                'gambar' => 'berita/program.jpg',
                'date' => '01/11/22',
            ],
            [
                'judul' => 'Harga bawang turun',
                'isi' => 'merah mengalami kenaikan Rp 347 dibandingkan harga hari sebelumnya Rp 36.085 menjadi Rp 36.456 per kilogram. Kemudian, harga bawang putih juga naik menjadi Rp 29.914 per kilogram Selanjutnya ada cabai merah keriting naik tipis Rp 574 dari sebelumnya Rp 52.511 per kilogram menjadi Rp 53.085 per kilogram. Cabai rawit merah juga naik Rp 617 menjadi Rp 53.319 per kilogram, sebelumnya Rp 52.702 per kilogram. Sementara harga cabai rawit hijau turun Rp 667 menjadi Rp 36.630 per kilogram. Disisi lain bahan kebutuhan pokok lainnya yang mengalami kenaikan ada telur ayam ras naik Rp 212 menjadi RP 26.797 per kilogram, ayam broiler/ras Rp 37.822 per ekor, bawang putih Rp29.914 per kilogram, dan harga beras premium juga naik menjadi Rp 12.207 per kilogram.',
                'gambar' => 'berita/hargabawang.jpg',
                'date' => '23/10/22',
            ],
            [
                'judul' => 'Anak Muda Daerah Didorong Manfaatkan Lahan "Tidur" Jadi Begini',
                'isi' => 'nak muda di daerah didorong untuk bisa memanfaatkan lahan tidur menjadi lahan pertanian produktif. Salah satu contohnya ialah anak muda di Kabupaten Teluk Bintuni, Papua Barat, yang didorong BIN untuk jadi penggerak pertanian. Bekerjasama dengan Pemkab Teluk Bintuni, BIN mendorong anak muda yang tergabung dalam Papua Muda Inspiratif (PMI) untuk memanfaatkan lahan tidur menjadi lahan pertanian produktif. Pada tahap awal, mereka akan memanfaatkan lahan seluas 500 hektar milik Pemkab Teluk Bintuni di kawasan Padang Agoda, Distrik Aroba.',
                'gambar' => 'berita/anakmuda.jpg',
                'date' => '19/10/22',
            ],
            [
                'judul' => 'Pemerintah Genjot Modernisasi Pertanian Lewat Penyaluran KUR',
                'isi' => 'Menteri Koordinator Bidang Perekonomian Airlangga Hartarto mengatakan penguatan sektor pangan menjadi salah satu prioritas utama pemerintah dalam menjaga stabilitas perekonomian nasional. Hal ini dilakukan untuk menghadapi ancaman perubahan iklim dan dinamika geopolitik global yang berdampak pada krisis pangan, krisis energi, dan krisis finansial yang terjadi pada saat ini.Menurutnya, pemerintah secara konsisten berupaya meningkatkan ketahanan pangan dengan mendorong produktivitas hasil pertanian melalui mekanisme modernisasi taksi alat dan mesin pertanian (Alsintan). Pemerintah juga terus mendorong peningkatan fasilitas pembiayaan bagi petani melalui Kredit Usaha Rakyat (KUR).',
                'gambar' => 'berita/pemerintah.jpg',
                'date' => '18/10/22',
            ],
        ];

        Berita::insert($data);
    }
}
