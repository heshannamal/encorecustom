<?php

namespace domain\Services\UserService;

use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $permission;

    public function __construct()
    {
        $this->permission = new Permission();
    }

    public function getAllPermissions()
    {
        return $this->permission->all();
    }

    public function getAllPaginatedPermissions($request = null)
    {
        $limit = 10;
        $query = $this->permission->newQuery();

        if ($request) {
            $search = $request->input('search');
            $limit = $request->input('per_page', 10);

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('guard_name', 'like', '%' . $search . '%');
                });
            }
        }

        return $query->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getAllActivePermissions()
    {
        return $this->permission->where('is_active', 1)->get();
    }

    public function getPermissionById($id)
    {
        return $this->permission->find($id);
    }

    public function storePermission($data)
    {
        $data['guard_name'] = $data['guard_name'] ?? 'web';
        return $this->permission->create($data);
    }

    public function updatePermission($data, $id)
    {
        $permission = $this->getPermissionById($id);
        if ($permission) {
            $permission->update($data);
        }
        return $permission;
    }

    public function destroyPermission($id)
    {
        $permission = $this->getPermissionById($id);
        if ($permission) {
            return $permission->delete();
        }
        return false;
    }
}
