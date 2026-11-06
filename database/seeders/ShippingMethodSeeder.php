<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Pick Up', 'description' => 'Collect your order at our store location'],
            ['name' => 'Local Delivery', 'description' => 'Delivered within 5-7 business days'],
        ];

        foreach ($methods as $key => $method) {

            $methodstatus = ShippingMethod::where('name', $method['name'])->first();

            if (!$methodstatus) {
                ShippingMethod::create($method);
            }
        }
    }
}
