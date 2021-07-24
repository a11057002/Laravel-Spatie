<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // for ($i = 0; $i < 10; $i++) {
        //     $user = User::create([
        //         'name' => 'andy',
        //         'email' => 'test' . $i .'@a.com',
        //         'password' => bcrypt('andy1234')
        //     ]);
        // }
        $role = "admin";

        $user = User::create([
            'name' => $role,
            'email' => $role.'@a.com',
            'password' => bcrypt('andy1234')
        ]);
        // $role = Role::create(['name' => 'Top']);
        $role = Role::findByName('admin');
        $permissions = Permission::pluck('id', 'name')->all();

        // dd($permissions);
        // dd(User::find(5)->getRoleNames());
        
        $role->syncPermissions($permissions);
        // $user->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        // dd(User::find(4)->getAllPermissions());
    }
}
