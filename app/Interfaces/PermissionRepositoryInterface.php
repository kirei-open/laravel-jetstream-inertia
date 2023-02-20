<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();
    public function getPermissionById($roleId);
    public function deletePermission($roleId);
    public function createPermission(array $roleDetails);
    public function updatePermission($roleId, array $newDetails);
}
