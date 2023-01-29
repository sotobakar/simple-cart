<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Doremi Thomas and Friends Mist Cologne',
                'image' => 'products/cologne.jfif',
                'price' => 15000,
            ],
            [
                'name' => 'Moisturizer',
                'image' => 'products/moisturizer.jpg',
                'price' => 40000,
            ],
            [
                'name' => 'Senka Perfect Whip Facial Foam 120gr',
                'image' => 'products/senka.jpg',
                'price' => 39000,
            ],
            [
                'name' => 'Azarine Aqua Essence Sunshield Serum SPF 50',
                'image' => 'products/sunshield.webp',
                'price' => 53000,
            ],
            [
                'name' => 'Wardah UV Shield Aqua Fresh Essence SPF 50',
                'image' => 'products/wardah_sunscreen.jpg',
                'price' => 55000,
            ],
            [
                'name' => 'Azarine Multi Acids Glowing Toner',
                'image' => 'products/toner.jpg',
                'price' => 62000,
            ],
        ];

        foreach($products as $product)
        {
            Product::create($product);
        }
    }
}
