<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $menus = [
        ['name' => 'Ayam Geprek', 'price' => 20000, 'category' => 'best-seller', 'description' => 'Ayam krispi sambal korek', 'image' => '1769282412.jpg'],
        ['name' => 'Ayam Teriyaki', 'price' => 25000, 'category' => 'best-seller', 'description' => 'Ayam saus manis khas jepang', 'image' => '1769282537.jpg'],
        ['name' => 'Telur Crispy', 'price' => 15000, 'category' => 'hemat', 'description' => 'Double telur krispi gurih', 'image' => '1769282569.jpg'],
        ['name' => 'Sosis BBQ', 'price' => 18000, 'category' => 'hemat', 'description' => 'Sosis bakar saus bbq', 'image' => '1769282616.jpg'],
        ['name' => 'Ayam Blackpepper', 'price' => 27000, 'category' => 'all', 'description' => 'Ayam tumis lada hitam', 'image' => '1769282683.jpg'],
        ['name' => 'Chicken Katsu', 'price' => 23000, 'category' => 'all', 'description' => 'Fillet ayam goreng tepung', 'image' => '1769282740.jpg'],
    ];

    foreach ($menus as $menu) {
        \App\Models\Menu::create($menu);
    }
}
}
