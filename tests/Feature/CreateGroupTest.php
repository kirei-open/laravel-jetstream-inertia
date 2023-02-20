<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_group_can_be_created(): void
    {

        $this->actingAs($user = User::factory()->create());

        $response = $this->post(route('groups.store'), [
            'name' => "Test Group",
            'description' => 'Test Description of Test Group'
        ]);

        $response->assertStatus(200);
    }
}
