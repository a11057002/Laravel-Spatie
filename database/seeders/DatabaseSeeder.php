<?php

namespace Database\Seeders;

use DB;
use App\Models\News;
use App\Models\User;
use App\Models\Group;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  seed roles
        $roles = [
            'admin',
            'user',
            'supervisor',
            'auditor',
            'media'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // seed permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete', 
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'group-list',
            'group-create',
            'group-edit',
            'group-delete'               
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //seed admin
        $role = "admin";

        $user = User::create([
            'name' => $role,
            'email' => $role.'@a.com',
            'password' => bcrypt('andy1234')
        ]);
        // $role = Role::create(['name' => 'Top']);
        $role = Role::findByName('admin');
        $permissions = Permission::pluck('id', 'name')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        //test
        // \App\Models\User::factory(10)->create();
        // DB::enableQueryLog();
        // User::find(17)->group()->get();
        // dd(DB::getQueryLog());
        // dd(Group::find(1)->users()->get()->first()->getRoleNames());
        // $a = "1,2,3,4,5";
        // print($a);
        // print_r(explode(',',$a));
        // $this->$a();
        // dd(News::find(1)->image->pluck('id'));
        // dd(Image::find(1)->News->pluck('id'));
    }

    // public function go()
    // {
    //     echo "123\r\n";
    // }
}
