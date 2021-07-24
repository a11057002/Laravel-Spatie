<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConrollerTest extends TestCase
{
    use RefreshDatabase;
    
    private $fakerUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakerUser = User::create(['name'=>'andy','email'=>'test@b.c','password'=>1234]);
        
        auth()->login($this->fakerUser);
    }

    public function test_userlist(): void
    {
        Permission::create(['name' => 'user-list']);
        $this->fakerUser ->syncPermissions('user-list');
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function test_rolelist(): void
    {
        Permission::create(['name' => 'role-list']);
        $this->fakerUser ->syncPermissions('role-list');
        $response = $this->get('/roles');
        $response->assertStatus(200);
    }

    public function test_grouplist(): void
    {
        Permission::create(['name' => 'group-list']);
        $this->fakerUser ->syncPermissions('group-list');
        $response = $this->get('/groups');
        $response->assertStatus(200);
    }
}
