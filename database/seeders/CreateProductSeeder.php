<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class CreateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product_name' => 'Playstation 5', 'price' => 10000000, 'stock' => 10],
            ['product_name' => "Nintendo Switch",'price' => 5000000, 'stock' => 50],
            ['product_name' => "XBox", 'price' => 2000000, 'stock' => 50]
        ];

        foreach($products as $product){
            Products::create($product);
        }
    }
}
