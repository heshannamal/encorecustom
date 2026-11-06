<?php

namespace domain\Services\UserService;

use Spatie\Permission\Models\Role;

class RoleService
{
    protected $role;

    public function __construct()
    {
        $this->role = new Role();
    }

    public function getAllRoles()
    {
        return $this->role->all();
    }

    public function getAllActiveRoles()
    {
        return $this->role->where('is_active', 1)->get();
    }

    public function getSystemRoles()
    {
        return $this->role->where('name', '!=', 'customer')->get();
    }

    public function getActiveSystemRoles()
    {
        return $this->role->where('name', '!=', 'customer')->where('is_active', 1)->get();
    }

    public function getActiveSystemRolesWithUsers()
    {
        return $this->role->with('users')->where('name', '!=', 'customer')->where('is_active', 1)->get();
    }

    public function getRoleById($id)
    {
        return $this->role->find($id);
    }

    public function storeRole($data)
    {
        $data['guard_name'] = $data['guard_name'] ?? 'web';
        return $this->role->create($data);
    }

    public function updateRole($data, $id)
    {
        $role = $this->getRoleById($id);
        if ($role) {
            $role->update($data);
        }
        return $role;
    }

    public function destroyRole($id)
    {
        $role = $this->getRoleById($id);
        if ($role) {
            return $role->delete();
        }
        return false;
    }

    public function getRolePermissions($roleId)
    {
        $role = $this->getRoleById($roleId);
        if ($role) {
            return $role->permissions->pluck('name')->toArray();
        }
        return [];
    }

    public function syncRolePermissions($roleId, array $permissions)
    {
        $role = $this->getRoleById($roleId);
        if ($role) {
            return $role->syncPermissions($permissions);
        }
        return false;
    }
}
