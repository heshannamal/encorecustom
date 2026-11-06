<?php

namespace Database\Seeders;

use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supperUsers = [
            ['name' => 'Super Admin', 'email' => 'superadmin@encorecustom.com', 'password' => Hash::make('admin@123'), 'inventory_id' => 0, 'is_profile_complete'=>1],
        ];

        foreach ($supperUsers as $key => $user) {

            $userCheck = User::where('email', $user['email'])->first();

            if (!$userCheck) {
                $userGet = User::create($user);
                $userGet->assignRole('super_admin');
            }
        }

        $adminUsers = [
            ['name' => 'Admin', 'email' => 'admin@encorecustom.com', 'password' => Hash::make('admin@123'), 'inventory_id' => 2, 'is_profile_complete'=>1],
        ];

        foreach ($adminUsers as $key => $user) {

            $userCheck = User::where('email', $user['email'])->first();

            if (!$userCheck) {
                $userGet = User::create($user);
                $userGet->assignRole('admin');
            }
        }

        $operatorUsers = [
            ['name' => 'Operator', 'email' => 'operator@encorecustom.com', 'password' => Hash::make('operator@123'), 'inventory_id' => 2, 'is_profile_complete'=>1],
        ];

        foreach ($operatorUsers as $key => $user) {

            $userCheck = User::where('email', $user['email'])->first();

            if (!$userCheck) {
                $userGet = User::create($user);
                $userGet->assignRole('operator');
            }
        }

        $customerUsers = [
            ['name' => 'Customer', 'email' => 'customer@encorecustom.com', 'password' => Hash::make('customer@123'), 'inventory_id' => 2, 'is_customer' => 1, 'is_profile_complete'=>1],
        ];

        foreach ($customerUsers as $key => $user) {

            $userCheck = User::where('email', $user['email'])->first();

            if (!$userCheck) {
                $userGet = User::create($user);
                $userGet->assignRole('customer');

                $customerDetails = [
                    'user_id' => $userGet->id,
                    'first_name' => 'Customer',
                    'last_name' => 'Customer',
                    'country_id' => 235,
                    'country' => 'United States',
                    'country_code' => 'US',
                    'dial_code' => '+1',
                    'phone_number' => '112233444',
                    'address' => 'No. 221B',
                    'street' => 'Baker Street',
                    'city' => 'Sacramento',
                    'state' => 'California',
                    'postal_code' => '1111',
                ];
                CustomerDetail::create($customerDetails);
            }
        }
    }
}
