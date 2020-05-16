<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Model\admin\permission;
use Illuminate\Http\Request;
use App\Model\admin\role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::all();
        $permissions = permission::all();
        return view('admin/blog/role/role', compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = role::all();
        $permissions = permission::all();
        return view('admin/blog/role/role', compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required'
        ]);

        if(role::all()->where('name',$request -> name)->count() < 1)
        {
            $role = new role;
            $role -> name = $request -> name;
            $role -> save();
            $role -> permissions()->sync($request -> permission);
            return redirect()->route('role.index')->with('success','Role created successfully!');
        }
        return redirect()->route('role.index')->with('danger','Role already exists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = role::all();
        $permissions = permission::all();
        $role = role::where('id', $id)->first();

        return view('admin/blog/role/edit', compact('role', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'name' => 'required'
        ]);

        $role = role::find($id);
        $role -> name = $request -> name;
        $role -> save();
        $role -> permissions()->sync($request -> permission);
        return redirect()->route('role.index')->with('success','Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        role::where('id', $id)->delete();
        return redirect()->back()->with('success','Role deleted successfully!');
    }
}
