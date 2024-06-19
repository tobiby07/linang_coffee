<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_menu')->insert([
            ['name' => 'Minuman'],
            ['name' => 'Makanan'],
            ['name' => 'Snack'],
        ]);
    }
}
