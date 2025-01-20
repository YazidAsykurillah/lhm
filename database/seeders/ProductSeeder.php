<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = Product::updateOrcreate(
            ['name'=>'Product 1', 'detail'=>'Product 1 detail'],
            ['name'=>'Product 1', 'detail'=>'Product 1 detail'],
        );
        $product2 = Product::updateOrcreate(
            ['name'=>'Product 2', 'detail'=>'Product 2 detail'],
            ['name'=>'Product 2', 'detail'=>'Product 2 detail'],
        );
    }
}
