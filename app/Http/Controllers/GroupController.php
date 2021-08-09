<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Group;
use DB;
use Facade\FlareClient\Http\Response;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::orderBy('id', 'DESC')->paginate(5);
        return view('groups.index', compact('groups'));

        // return response(compact('groups'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:groups,name',
        ]);

        $group = Group::create(['name' => $request->input('name')]);
        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        $users = $group->users()->get();
        return view('groups.edit', compact('group', 'users'));
    }


    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required|unique:groups,name' 
        ]);

        $input = $request->all();
        $group = Group::find($id);
        $group->update($input);

        // return ['message' => 'success','groupName'=>$group->name];
        return redirect()->route('groups.index')
            ->with('success', 'Group updated successfully');
    }

    public function destroy($id)
    {
        DB::table("groups")->where('id', $id)->delete();
        return redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }
}
