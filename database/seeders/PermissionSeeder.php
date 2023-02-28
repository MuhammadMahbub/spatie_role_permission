<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=> 'dashboard',
        ]);
        Permission::create([
            'name'=> 'users',
        ]);
        Permission::create([
            'name'=> 'role',
        ]);
        Permission::create([
            'name'=> 'permission',
        ]);
        Permission::create([
            'name'=> 'show',
        ]);
        Permission::create([
            'name'=> 'edit',
        ]);
        Permission::create([
            'name'=> 'delete',
        ]);
    }
}
