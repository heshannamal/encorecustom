<?php

namespace Database\Seeders;

use App\Models\InventoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Sample', 'description' => 'Inventory for Sample Items'],
            ['name' => 'Encore Custom', 'description' => 'Inventory for Encore Custom Items'],
            ['name' => 'Encore Lacrose', 'description' => 'Inventory for Encore Lacrose Items'],
        ];

        foreach ($types as $key => $type) {

            $typeStatus = InventoryType::where('name', $type['name'])->first();

            if (!$typeStatus) {
                InventoryType::create($type);
            }
        }
    }
}
