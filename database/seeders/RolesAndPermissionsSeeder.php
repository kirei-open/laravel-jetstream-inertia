<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit groups']);
        Permission::create(['name' => 'delete groups']);
        Permission::create(['name' => 'view groups']);
        Permission::create(['name' => 'create groups']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);

        $superadmin = Role::create(['name' => 'superadmin'])->givePermissionTo(Permission::all());
        $admin = Role::create(['name' => 'admin'])->givePermissionTo([
            'view groups',
            'view users'
        ]);
        $member = Role::create(['name' => 'member'])->givePermissionTo(['view groups']);

        User::where('name', 'Superadmin')->first()->assignRole($superadmin);
        User::where('name', 'Admin')->first()->assignRole($admin);
        User::where('name', 'Member')->first()->assignRole($member);

    }
}

