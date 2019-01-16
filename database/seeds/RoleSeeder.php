<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Model;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name' => 'admin',
                'slug' => 'admin',
                'description' => 'Admin Role',
           ]);
        }

        if (Role::where('name', '=', 'manager')->first() === null) {
            $userRole = Role::create([
                'name' => 'manager',
                'slug' => 'manager',
                'description' => 'Manager Role',
            ]);
        }
        
        if (Role::where('name', '=', 'writer')->first() === null) {
            $userRole = Role::create([
                'name' => 'writer',
                'slug' => 'writer',
                'description' => 'Writer Role',
            ]);
        }
        if (Role::where('name', '=', 'user')->first() === null) {
            $userRole = Role::create([
                'name' => 'user',
                'slug' => 'user',
                'description' => 'User Role',
            ]);
        }

        if (Role::where('name', '=', 'unverified')->first() === null) {
            $userRole = Role::create([
                'name' => 'unverified',
                'slug' => 'unverified',
                'description' => 'Unverified Role',
            ]);
        }

    }
}
