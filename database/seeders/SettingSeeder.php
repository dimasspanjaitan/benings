<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Settings
};
use Faker\Provider\Lorem;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate();

        $setting = array( 
            [
                'id' => 1,
                'description' => "PT. Bening’s Indonesia merupakan perusahaan yang bergerak di bidang penjualan produk skincare maupun bodycare dan kebutuhan untuk perawatan kulit dan kecantikan lainnya dengan nama brand  Bening’s Indonesia yang didirikan pada awal tahun 2021 oleh seorang dokter kecantikan yaitu dr. Oky Pratama. PT. Bening’s Indonesia ini telah memiliki mitra di hampir seluruh Indonesia, terutama di Sumatera Utara. Di Sumatera Utara sendiri telah ada mitra PT. Bening’s Indonesia yaitu Distributor Bening’s Medan SUMUT yang sudah memiliki 40 lebih mitra yang tersebar di Provinsi Sumatera Utara bahkan ke provinsi lainnya mulai dari Kota Medan, Siantar Simalungun, Tapanuli Utara, Aceh, Jambi bahkan ke pulau Nias dan daerah lainnya.  Bening's Distributor Medan SUMUT sendiri dibawah naungan TEAM BRILIANT dari Distributor Karawang.

Bening's Distributor Medan SUMUT ini sendiri sudah menjadi mitra dari PT. Bening’s Indonesia sejak akhir tahun 2021 dan saat ini sudah mempunyai 44 mitra yang tersebar di daerah Sumatera Utara bahkan hingga ke Provinsi Jambi dan Aceh.

Bening's Distributor Medan SUMUT ini dibawah manajemen Digna Simbolon (ibu Geraldine) dan suaminya Ade Jhon Panjaitan (bapak Geraldine).

Untuk produk segera cek di menu produk dan segera Order.
Untuk info lebih lanjut mengenai kemitraan, langsung hubungi ke No. WA yang ada di menu Contact Us.

Bening's Indonesia:
1. Sudah terdaftar BPOM
2. Skincare Halal
3. Tidak membuat ketergantungan
4. Memiliki produk khusus yang aman bagi ibu hamil dan menyusui
5. Sudah dipercaya jutaan masyarakat Indonesia",
                'short_des' => "Bening's Distributor Medan SUMUT adalah distributor resmi terdaftar di PT. Bening's Indonesia yang mencakup area Medan Sumatera Utara dan sekitarnya.",
                'logo' => 'http://127.0.0.1:8000/uploads/settings/logo.jpg',
                'photo' => 'http://127.0.0.1:8000/uploads/settings/benings-dist-medan-sumut.jpg',
                'address' => 'Jl. Madio Santoso Gg. Tello No. 6 Pulo Brayan I, Kec. Medan Timur',
                'phone' => '081916657999',
                'email' => 'beningsdistributormedansumut@gmail.com'
            ],
        );

        Settings::insert($setting);
    }
}
