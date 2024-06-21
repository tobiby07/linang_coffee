<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Americano Hot',
                'kategori_menu_id' => 2,
                'description' => 'Americano Hot dengan citarasa yang khas',
                'price' => 15000,
                'image' => 'images/americano hot.jpeg',
            ],
            [
                'name' => 'Americano Ice',
                'kategori_menu_id' => 2,
                'description' => 'Americano Ice yang menyegarkan dengan es batu',
                'price' => 15000,
                'image' => 'images/americano ice.jpg',
            ],
            [
                'name' => 'Ayam Ricebowl',
                'kategori_menu_id' => 3,
                'description' => 'Nasi dengan potongan ayam yang lezat',
                'price' => 25000,
                'image' => 'images/ayam ricebowl.jpg',
            ],
            [
                'name' => 'Caffelatte',
                'kategori_menu_id' => 2,
                'description' => 'Kopi dengan campuran susu yang lembut',
                'price' => 18000,
                'image' => 'images/caffelatte.jpg',
            ],
            [
                'name' => 'Cappucino',
                'kategori_menu_id' => 2,
                'description' => 'Kopi dengan busa susu yang kental',
                'price' => 20000,
                'image' => 'images/cappucino.jpg',
            ],
            [
                'name' => 'Es Jeruk',
                'kategori_menu_id' => 1,
                'description' => 'Es jeruk segar dengan rasa yang manis',
                'price' => 10000,
                'image' => 'images/es jeruk.jpg',
            ],
            [
                'name' => 'Es Teh',
                'kategori_menu_id' => 1,
                'description' => 'Es teh dingin yang menyegarkan',
                'price' => 8000,
                'image' => 'images/es teh.jpg',
            ],
            [
                'name' => 'Expresso',
                'kategori_menu_id' => 2,
                'description' => 'Kopi hitam pekat dengan rasa yang khas',
                'price' => 15000,
                'image' => 'images/expresso.jpg',
            ],
            [
                'name' => 'French Fries',
                'kategori_menu_id' => 4,
                'description' => 'Kentang goreng yang renyah dan lezat',
                'price' => 12000,
                'image' => 'images/french fries.jpeg',
            ],
            [
                'name' => 'Mie Goreng',
                'kategori_menu_id' => 3,
                'description' => 'Mie goreng dengan bumbu yang sedap',
                'price' => 20000,
                'image' => 'images/mie goreng.jpeg',
            ],
            [
                'name' => 'Milkshake Chocolate',
                'kategori_menu_id' => 1,
                'description' => 'Minuman krim cokelat yang lezat',
                'price' => 15000,
                'image' => 'images/milkshake chocolate.jpg',
            ],
            [
                'name' => 'Milkshake Red Velvet',
                'kategori_menu_id' => 1,
                'description' => 'Minuman krim red velvet yang manis',
                'price' => 18000,
                'image' => 'images/milkshake red valvet.jpeg',
            ],
            [
                'name' => 'Milkshake Strawberry',
                'kategori_menu_id' => 1,
                'description' => 'Minuman krim strawberry yang segar',
                'price' => 17000,
                'image' => 'images/milkshake strawberry.jpeg',
            ],
            [
                'name' => 'Nasi Goreng',
                'kategori_menu_id' => 3,
                'description' => 'Nasi goreng spesial dengan bumbu yang lezat',
                'price' => 22000,
                'image' => 'images/nasi goreng.jpg',
            ],
            [
                'name' => 'Onion Ring',
                'kategori_menu_id' => 4,
                'description' => 'Cincin bawang yang digoreng garing',
                'price' => 10000,
                'image' => 'images/onion ring.jpg',
            ],
            [
                'name' => 'Pisang Goreng',
                'kategori_menu_id' => 4,
                'description' => 'Pisang goreng yang renyah dan manis',
                'price' => 8000,
                'image' => 'images/pisang goreng.jpg',
            ],
            [
                'name' => 'Roti Bakar',
                'kategori_menu_id' => 3,
                'description' => 'Roti tawar yang dipanggang dengan selai favorit Anda',
                'price' => 10000,
                'image' => 'images/roti bakar.jpg',
            ],
            [
                'name' => 'V60',
                'kategori_menu_id' => 2,
                'description' => 'Metode penyeduhan kopi dengan V60',
                'price' => 25000,
                'image' => 'images/v60.jpeg',
            ],
            [
                'name' => 'Vietnam Drip',
                'kategori_menu_id' => 2,
                'description' => 'Metode penyeduhan kopi ala Vietnam',
                'price' => 18000,
                'image' => 'images/vietnam drip.jpg',
            ],
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert($menu);
        }
    }
}