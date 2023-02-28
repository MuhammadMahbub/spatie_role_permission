<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ThemeSetting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =  User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('@@Bladepro@123@@'),
            'email_verified_at' => Carbon::now(),
        ]);

        ThemeSetting::create([
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
        ]);

        User::find($user->id)->assignRole(Role::all());
        User::find($user->id)->syncPermissions(Permission::all());
    }
}
