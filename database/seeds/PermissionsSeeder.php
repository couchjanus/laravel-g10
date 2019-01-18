<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Add Permissions    */
        if (Permission::where('name', '=', 'Can View Users')->first() === null) {
            Permission::create([
                'name' => 'Can View Users',
                'slug' => 'view-users',
                'description' => 'Can view users',
            ]);
        }
        if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
            Permission::create([
                'name' => 'Can Create Users',
                'slug' => 'create-users',
                'description' => 'Can create new users',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
            Permission::create([
                'name' => 'Can Edit Users',
                'slug' => 'edit-users',
                'description' => 'Can edit users',
            ]);
        }
        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name' => 'Can Delete Users',
                'slug' => 'delete-users',
                'description' => 'Can delete users',
            ]);
        }

    }
}
