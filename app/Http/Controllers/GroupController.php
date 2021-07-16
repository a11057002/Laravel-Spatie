<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::orderBy('id', 'DESC')->paginate(5);
        return view('groups.index', compact('groups'));

        // return response(compact('groups'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function destroy($id)
    {
        DB::table("groups")->where('id', $id)->delete();
        return redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }
}
