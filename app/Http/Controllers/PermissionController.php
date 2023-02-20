<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
        return ['permissions' => $permissions];
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function edit(Request $request)
    {
        $permissionId = $request->route('permissionId');

        $permission = $this->permissionRepository->getPermissionById($permissionId);

        if (empty($permission)) {
            return back();
        }

        return view('permission.edit', ['permission' => $permission]);
    }

    public function store(Request $request)
    {
        $permissionDetails = [
            'name' => $request->name,
        ];

        $this->permissionRepository->createPermission($permissionDetails);

        return $this->permissionRepository->getAllPermissions();
    }

    public function update(Request $request)
    {
        $permissionId = $request->route('permissionId');

        $permissionDetails = [
            'name' => $request->name,
        ];

        $this->permissionRepository->updatePermission($permissionId, $permissionDetails);

        return redirect()->Route('permissions');
    }

    public function destroy(Request $request)
    {
        $permissionId = $request->route('permissionId');

        $this->permissionRepository->deletePermission($permissionId);

        return back();
    }
}
