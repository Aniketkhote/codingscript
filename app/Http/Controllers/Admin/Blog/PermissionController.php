<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Model\admin\permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permission::all();
        return view('admin/blog/permission/permission',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = permission::all();
        return view('admin/blog/permission/permission',compact('permissions'));
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
            'name' => 'required',
            'for' => 'required'
        ]);

        if(permission::all()->where('name',$request -> name)->count() < 1)
        {
            $permission = new permission;
            $permission -> name = $request -> name;
            $permission -> for = $request -> for;
            $permission -> save();
            return redirect()->route('permission.index')->with('success','permission created successfully!');
        }
        return redirect()->route('permission.index')->with('danger','permission already exists');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\admin\blog\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\admin\blog\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = permission::all();
        $permission = permission::where('id', $id)->first();

        return view('admin/blog/permission/edit', compact('permission', 'permissions'));
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
            'name' => 'required',
            'for' => 'required'
        ]);

        if(permission::all()->where('name',$request -> name)->count() < 1)
        {
            $permission = permission::find($id);
            $permission -> name = $request -> name;
            $permission -> for = $request -> for;
            $permission -> save();
            return redirect()->route('permission.index')->with('success','Permission updated successfully!');
        }
        return redirect()->route('permission.index')->with('danger','Permission already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\admin\blog\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        permission::where('id', $id)->delete();
        return redirect()->back()->with('success','Permission deleted successfully!');
    }
}
