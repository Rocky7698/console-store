<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nindendo switch OLED',
                'price' => 129999,
                'discount_price' => 119999,
                'stock' => 50,
                'category_id' => 1,
                'image' => 'website/img/NS.jpg',
                'description' => 'Latest Apple flagship phone.'
            ],
            [
                'name' => 'Samsung S23 Ultra',
                'price' => 124000,
                'discount_price' => 112000,
                'stock' => 40,
                'category_id' => 1,
                'image' => 's23ultra.jpg',
                'description' => 'Samsung premium smartphone.'
            ],
            [
                'name' => 'MacBook Air M2',
                'price' => 114999,
                'discount_price' => 105999,
                'stock' => 30,
                'category_id' => 2,
                'image' => 'macbookairm2.jpg',
                'description' => 'Apple M2 chip laptop.'
            ],
            [
                'name' => 'Sony Headphones WH-1000XM5',
                'price' => 29999,
                'discount_price' => 24999,
                'stock' => 100,
                'category_id' => 3,
                'image' => 'sonyxm5.jpg',
                'description' => 'Noise cancelling headphones.'
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'price' => $product['price'],
                'discount_price' => $product['discount_price'],
                'stock' => $product['stock'],
                'category_id' => $product['category_id'],
                'image' => $product['image'],
                'description' => $product['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
