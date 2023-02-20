<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllPermissions()
    {
        return Permission::all();
    }
    public function getPermissionById($permissionId)
    {
        return Permission::findOrFail($permissionId);
    }
    public function deletePermission($permissionId)
    {
        Permission::destroy($permissionId);
    }
    public function createPermission(array $permissionDetails)
    {
        return Permission::create($permissionDetails);
    }
    public function updatePermission($permissionId, array $newDetails)
    {
        return Permission::whereId($permissionId)->update($newDetails);
    }

}
