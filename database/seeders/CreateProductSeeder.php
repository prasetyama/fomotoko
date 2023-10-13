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
        $product = Products::create([
            'product_name' => 'Playstation 5', 
            'price' => '10000000',
            'stock' => '10'
        ]);
    }
}
