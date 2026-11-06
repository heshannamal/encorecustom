<?php

namespace domain\Services\UserService;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getAllUsers()
    {
        return $this->user->with('roles', 'inventoryTypeDetail')->get();
    }

    public function getSystemUsers()
    {
        return $this->user->with('roles', 'inventoryTypeDetail')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'customer');
        })->get();
    }

    public function getPaginatedSystemUsers($request)
    {
        $search = $request->input('search');
        $roleId = $request->input('role_id');
        $inventoryTypeId = $request->input('inventory_type_id');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);

        $query = $this->user->with('roles', 'inventoryTypeDetail')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'customer');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($roleId && $roleId !== 'all') {
            $query->whereHas('roles', function ($q) use ($roleId) {
                $q->where('id', $roleId);
            });
        }

        if ($inventoryTypeId && $inventoryTypeId !== 'all') {
            $query->where('inventory_id', $inventoryTypeId);
        }

        if ($status !== null && $status !== '' && $status !== 'all') {
            $query->where('is_active', (int) $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getUserById($id)
    {
        return $this->user->with('roles')->find($id);
    }

    public function storeUser($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['profile_pic_file'])) {
            $file = $data['profile_pic_file'];
            $path = Storage::disk('public')->putFile('profile_pics', $file);
            $data['profile_pic'] = 'public/storage/' . $path;
        }

        $data['is_active'] = 1;
        $user = $this->user->create($data);

        if (isset($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user;
    }

    public function updateUser($data, $id)
    {
        $user = $this->getUserById($id);
        if (!$user) {
            return null;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (isset($data['profile_pic_file'])) {
            // Delete old file
            if (!empty($user->profile_pic)) {
                $relativePath = str_replace('storage/', '', $user->profile_pic);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }

            $file = $data['profile_pic_file'];
            $path = Storage::disk('public')->putFile('profile_pics', $file);
            $data['profile_pic'] = 'public/storage/' . $path;
        }

        $user->update($data);

        if (isset($data['role'])) {
            $user->syncRoles($data['role']);
        }

        return $user;
    }

    public function destroyUser($id)
    {
        $user = $this->getUserById($id);
        if ($user) {
            // Delete file
            if (!empty($user->profile_pic)) {
                $relativePath = str_replace('storage/', '', $user->profile_pic);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }
            return $user->delete();
        }
        return false;
    }
}
