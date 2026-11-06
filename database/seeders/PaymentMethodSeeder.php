<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Cash', 'description' => 'Cash payment at the counter'],
            ['name' => 'Card', 'description' => 'Pay using Visa/MasterCard'],
            ['name' => 'Bank Transfer', 'description' => 'Direct transfer to company account'],
            ['name' => 'PayPal', 'description' => 'Secure payment via PayPal'],
            ['name' => 'Venmo', 'description' => 'Secure payment via Venmo'],
        ];

        foreach ($methods as $key => $method) {

            $methodstatus = PaymentMethod::where('name', $method['name'])->first();

            if (!$methodstatus) {
                PaymentMethod::create($method);
            }
        }
    }
}
