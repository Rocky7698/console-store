<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Check if products exist
        $products = Product::all();

        if ($products->count() == 0) {
            return;
        }

        foreach ($products as $product) {

            // Kitni images chaho utni generate ho sakti hain  (3 images)
            for ($i = 1; $i <= 3; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => "website/uploads/products/" . rand(1,5) . ".jpg",
                ]);
            }
        }
    }
}
