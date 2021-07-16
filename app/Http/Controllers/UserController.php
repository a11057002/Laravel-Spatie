<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list');
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5)->onEachSide(2);
        return view('users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $groups = Group::pluck('name', 'name')->all();
        return view('users.create', compact('roles','groups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $this->assignGroups($input['groups'],$user->id);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $groups = Group::pluck('name', 'name')->all();
        $userGroup = $user->group->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole', 'groups', 'userGroup'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',

        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        DB::table('user_group')->where('user_id', $id)->delete();

        // add groups
        $this->assignGroups($input['groups'],$id);

        // add roles
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    private function assignGroups($groups,$id)
    {
        foreach ($groups as $group) {
            $groupId = Group::where('name', $group)->pluck('id')[0];
            DB::table('user_group')->insert(
                [
                    'group_id' => $groupId, 
                    'user_id' => $id
                ]
            );
        };
    }
}
