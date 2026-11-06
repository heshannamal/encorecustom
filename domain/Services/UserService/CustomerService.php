<?php

namespace domain\Services\UserService;

use App\Models\CustomerDetail;
use App\Models\User;
use App\Traits\UserHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    use UserHelper;
    protected $user;
    protected $customer_detail;

    public function __construct()
    {
        $this->user = new User();
        $this->customer_detail = new CustomerDetail();
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getAllCustomersCount()
    {
        return $this->user->with('customerDetail')->whereHas('roles', function($role) { $role->where('name', '=', 'customer'); })->count();
    }

    public function getPaginatedCustomers($request, $limit=25)
    {
        $customerQry = $this->user->with('customerDetail', 'orderDetails')
            ->whereHas('roles', function($role) {
                $role->where('name', '=', 'customer');
            });

        // Search Input Filter (searches name, email, and customer detail columns: first_name, last_name, phone_number)
        if (!empty($request->search_input)) {
            $searchInput = $request->search_input;
            $customerQry->where(function ($q) use ($searchInput) {
                $q->where('name', 'like', "%{$searchInput}%")
                  ->orWhere('email', 'like', "%{$searchInput}%")
                  ->orWhereHas('customerDetail', function ($subQ) use ($searchInput) {
                      $subQ->where('first_name', 'like', "%{$searchInput}%")
                           ->orWhere('last_name', 'like', "%{$searchInput}%")
                           ->orWhere('phone_number', 'like', "%{$searchInput}%");
                  });
            });
        }

        // Country Filter
        if (!empty($request->country)) {
            $customerQry->whereHas('customerDetail', function ($q) use ($request) {
                $q->where('country_id', $request->country);
            });
        }

        // Inventory / Inventory Type Filter
        if (auth()->user() && auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            if (!empty($request->inventory_type_id)) {
                $customerQry->where('inventory_id', $request->inventory_type_id);
            } elseif (!empty($request->inventory_id)) {
                $customerQry->where('inventory_id', $request->inventory_id);
            }
        } else {
            if (auth()->user()) {
                $customerQry->where('inventory_id', auth()->user()->inventory_id);
            }
        }

        $customers = $customerQry->paginate($limit);
        return $customers;
    }

    public function getUserById($id)
    {
        return $this->user->find($id);
    }

    public function getCustomerByUserId($id)
    {
        return $this->customer_detail->with('userDetail')->where('user_id', $id)->first();
    }

    public function storeCustomer($data)
    {
        $password = $data['password'] ?? $this->generateSecurePassword(8);
        $fields = ['country_id','phone_number','address','city','postal_code'];
        $isComplete = (int) !array_filter($fields, fn($f) => empty($data[$f] ?? null));


        $userData = [
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'temp_password' => encrypt($password),
            'inventory_id' => $data['inventory_id'] ?? auth()->user()->inventory_id,
            'is_customer' => 1,
            'is_social' => $data['is_social'] ?? 0,
            'is_profile_complete' => $isComplete,
        ];
        $user = $this->user->create($userData);
        $user->assignRole('customer');
        $data['user_id'] = $user->id;
        $this->customer_detail->create($data);
        return $user;
    }

    public function updateCustomer($data, $id)
    {
        $user = $this->getUserById($id);
        $userData = [
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'inventory_id' => $data['inventory_id'] ?? $user->inventory_id,
        ];
        $user->update($userData);

        $customerDetail = $this->getCustomerByUserId($id);
        if ($customerDetail) {
            $customerDetail->update($data);
        } else {
            $data['user_id'] = $id;
            $this->customer_detail->create($data);
        }
        return $user;
    }

    public function deleteCustomer($id)
    {
        $user = $this->getUserById($id);
        if ($user) {
            $customerDetail = $this->getCustomerByUserId($user->id);
            if ($customerDetail) {
                $customerDetail->delete();
            }
            $user->update(['is_active'=>0]);
            $user->delete();
            return true;
        } else {
            return false;
        }
    }
}
