<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_jurusan' => 'Teknik Informatika', 'akreditasi' => 'A'],
            ['nama_jurusan' => 'Teknik Industri', 'akreditasi' => 'A'],
            ['nama_jurusan' => 'Desain Komunikasi Visual', 'akreditasi' => 'A'],
        ];
        foreach ($data as $j) \App\Models\Jurusan::create($j);
    }
}
