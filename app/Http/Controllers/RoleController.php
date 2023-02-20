<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getAllRoles();
        return ['roles' => $roles];
    }

    public function create()
    {
        return view('roles.create');
    }

    public function edit(Request $request)
    {
        $roleId = $request->route('roleId');

        $role = $this->roleRepository->getRoleById($roleId);

        if (empty($role)) {
            return back();
        }

        return view('role.edit', ['role' => $role]);
    }

    public function store(Request $request)
    {
        $roleDetails = [
            'name' => $request->name,
        ];

        $this->roleRepository->createRole($roleDetails);

        return $this->roleRepository->getAllRoles();
    }

    public function update(Request $request)
    {
        $roleId = $request->route('roleId');

        $roleDetails = [
            'name' => $request->name,
        ];

        $this->roleRepository->updateRole($roleId, $roleDetails);

        return redirect()->Route('roles');
    }

    public function destroy(Request $request)
    {
        $roleId = $request->route('roleId');

        $this->roleRepository->deleteRole($roleId);

        return back();
    }
}
