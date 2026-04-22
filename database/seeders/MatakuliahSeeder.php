<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // TIF (id=1)
            ['nama_matakuliah' => 'Pemrograman Web 2',                  'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Sistem Mikrokontroler',              'sks' => 3, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Data Mining',                        'sks' => 2, 'id_jurusan' => 1],
            ['nama_matakuliah' => 'Metodologi Penelitian Informatika',  'sks' => 3, 'id_jurusan' => 1],
            // TI (id=2)
            ['nama_matakuliah' => 'Pengantar Teknik Industri',          'sks' => 3, 'id_jurusan' => 2],
            ['nama_matakuliah' => 'Keselamatan dan Kesehatan Kerja',    'sks' => 3, 'id_jurusan' => 2],
            // DKV (id=3)
            ['nama_matakuliah' => 'Dasar-dasar Ilustrasi',          'sks' => 3, 'id_jurusan' => 3],
            ['nama_matakuliah' => 'Pengenalan Rekayasa dan Desain', 'sks' => 3, 'id_jurusan' => 3],
        ];
        foreach ($data as $d) Matakuliah::create($d);
    }
}
