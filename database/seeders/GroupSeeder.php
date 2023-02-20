<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $executive = Group::factory()->create([
            'name' => 'Executive'
        ]);
        $management = Group::factory()->create([
            'name' => 'Management'
        ]);
        $staff = Group::factory()->create([
            'name' => 'Staff'
        ]);
        Group::factory()->count(10)->create();

        User::where('name', 'Superadmin')->first()->assignGroup($executive->id);
        User::where('name', 'Admin')->first()->assignGroup($management->id);
        User::where('name', 'Member')->first()->assignGroup($staff->id);

    }
}
