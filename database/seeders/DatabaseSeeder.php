<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::enableQueryLog();
        
        // User::find(17)->group()->get();
        // dd(DB::getQueryLog());
        // dd(Group::find(1)->users()->get()->first()->getRoleNames());
        // $a = "1,2,3,4,5";
        // print($a);
        // print_r(explode(',',$a));
        // $this->$a();
    }

    public function go()
    {
        echo "123\r\n";
    }
}
