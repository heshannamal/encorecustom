<?php

namespace domain\Services\UserService;

use App\Models\UserGroup;

class UserGroupService
{
    protected $userGroup;

    public function __construct()
    {
        $this->userGroup = new UserGroup();
    }

    public function getAllGroups()
    {
        return $this->userGroup->all();
    }

    public function getActiveGroups()
    {
        return $this->userGroup->where('is_active', 1)->get();
    }

    public function getGroupById($id)
    {
        return $this->userGroup->find($id);
    }

    public function storeGroup($data)
    {
        return $this->userGroup->create($data);
    }

    public function updateGroup($data, $id)
    {
        $group = $this->getGroupById($id);
        if ($group) {
            $group->update($data);
        }
        return $group;
    }

    public function destroyGroup($id)
    {
        $group = $this->getGroupById($id);
        if ($group) {
            return $group->delete();
        }
        return false;
    }
}
