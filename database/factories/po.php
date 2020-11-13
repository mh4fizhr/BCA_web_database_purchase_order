<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

// $factory->define(\App\pejabat::class, function (Faker $faker) {
$factory->define(\App\tpo::class, function (Faker $faker) {
    return [
    	// 'nama' => $faker->sentence(1),
    	// 'jabatan_id' => $faker->sentence(1),
    	// 'unitkerja_id' => $faker->sentence(1),
    	// 'active' => $faker->sentence(1)

        // ~~~~~~~~~~~~~ PO ~~~~~~~~~~~~~~
    	'Sewa' => $faker->sentence(1),
    	'CP' => $faker->sentence(1),
    	'Cabang_id' => 1,
    	'Ump_id' => $faker->sentence(1),
    	'Mobil_id' => 6,
    	'Sewa' => $faker->sentence(1),
    	'Type' => $faker->sentence(1),
    	'Nopol' => $faker->sentence(1),
    	'Vendor_mobil' => 1,
    	'Vendor_Driver' => 1,
    	'Driver_id' => null,
    	'UserPengguna' => $faker->sentence(1),
    	'NoPo' => $faker->sentence(1),
    	'MulaiSewa' => null,
    	'MulaiSewa2' => null,
    	'Tgl_bastk' => null,
    	'Tgl_bastd' => null,
    	'Nopo_relokasi' => $faker->sentence(1),
    	'Efisien_relokasi' => null,
    	'Cabang_relokasi' => null,
    	'Hargasewadriver_relokasi' => $faker->sentence(1),
    	'Pengurangan' => $faker->sentence(1),
    	'Sewa_sementara' => $faker->sentence(1),
    	'Nopo_pengurangan' => $faker->sentence(1),
    	'Hargasewamobil_pengurangan' => $faker->sentence(1),
    	'Tgl_cutoff' => null,
    	'SelesaiSewa' => null,
    	'SelesaiSewa2' => null,
    	'HargaSewaMobil' => $faker->sentence(1),
    	'HargaSewaDriver2019' => $faker->sentence(1),
    	'HargaSewaMobilDriver' => $faker->sentence(1),
    	'status' => '1',
    	'NoRegister' => $faker->sentence(1),
    	'Po_multiple_start' => null,
    	'Po_multiple_end' => null,
    	'Nopo_permanent' => $faker->sentence(1),
    	'Cabang_permanent' => 1,
    	'Sewa_permanent' => $faker->sentence(1),
    	'bbm' => $faker->randomDigit,
    	'jenis_bbm' => 'Pertalite',
    	'data_pairing_baru' => null,
    	'tgl_efektif_perubahan' => null

        // // ~~~~~~~~~~~~~ TEMPLATE RELOKASI ~~~~~~~~~~~~~~
        
        // 'no_surat' => '1234/JS/BPD/KPS/2020',     
        // 'tgl_surat' => 'Jakarta, 30 Agustus 2020',    
        // 'nama_vendor' => 'Damira',      
        // 'pic_vendor' => 'Budi',   
        // 'jabatan_vendor' => 'uknown',   
        // 'alamat_vendor' => 'Jl. Gedung Hijau Raya Pondok Indah No.41',    
        // 'sewa' => 'Mobil dan Pengemudi',     
        // 'pks' => 'pengehentian',      
        // 'no_pks' => '12345',   
        // 'tgl_pks' => '08/26/2020',      
        // 'jml_mobil' => '1',    
        // 'jml_driver' => '1',   
        // 'unitkerja_pb1' => 'Biro IT',    
        // 'unitkerja_pb2' => 'Biro pengadaan logistik',    
        // 'nama_pb1' => 'Heru pangestu',     
        // 'nama_pb2' => 'Muhammad Hafizh Ramadhan',     
        // 'jabatan_pb1' => 'karyawan',      
        // 'jabatan_pb2' => 'karyawan',      
        // 'status' => '',   
        // 'created_at' => '2020-08-30 03:09:47',   
        // 'updated_at' => '2020-08-30 03:09:47',   
    ];
});
