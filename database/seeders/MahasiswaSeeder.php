<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nim' => '2601001', 'nama' => 'Bill Gates',        'id_jurusan' => 1],
            ['nim' => '2601002', 'nama' => 'Elon Musk',         'id_jurusan' => 1],
            ['nim' => '2601003', 'nama' => 'Mark Zuckerberg',   'id_jurusan' => 1],
            ['nim' => '2602001', 'nama' => 'Donald Trump',      'id_jurusan' => 2],
            ['nim' => '2602002', 'nama' => 'Jeff Bezos',        'id_jurusan' => 2],
            ['nim' => '2603001', 'nama' => 'Pablo Picasso',     'id_jurusan' => 3],
            ['nim' => '2603002', 'nama' => 'Vincent van Gogh',  'id_jurusan' => 3],
            ['nim' => '2603003', 'nama' => 'Leonardo da Vinci', 'id_jurusan' => 3],
        ];
        foreach ($data as $d) Mahasiswa::create($d);
    }
}
