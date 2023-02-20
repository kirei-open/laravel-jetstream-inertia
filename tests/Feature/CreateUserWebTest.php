<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateUserWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created_with_correct_permission(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create users']);

        $role = Role::create(['name' => 'superadmin'])->givePermissionTo(['create users']);

        $user = User::factory()->create();

        $user->assignRole($role);

        $this->actingAs($user);

        $response = $this->post(route('users.store'), [
            'name' => 'Test User',
            'email' => 'test@mail.com'
        ]);

        $response->assertStatus(200);
    }
}
