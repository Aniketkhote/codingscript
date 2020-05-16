<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\blog\tag;
use App\Model\user\blog\tag_post;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = tag::all();
        return view('admin/blog/tag/tag', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = tag::all();
        return view('admin/blog/tag/tag', compact('tags'));
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

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(tag::all()->where('slug',$slug)->count() < 1)
        {
            $tag = new tag;
            $tag -> name = $request -> name;
            $tag -> slug = $slug;
            $tag -> save();
            return redirect()->route('tag.index')->with('success','Tag created successfully!');
        }
        return redirect()->route('tag.index')->with('danger','Tag already exists');
        
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
        $tags = tag::all();
        $tag = tag::where('id', $id)->first();

        return view('admin/blog/tag/edit', compact('tag', 'tags'));
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

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(tag::all()->where('slug',$slug)->count() < 1)
        {
            $tag = tag::find($id);
            $tag -> name = $request -> name;
            $tag -> slug = $slug;
            $tag -> save();
            return redirect()->route('tag.index')->with('success','Tag updated successfully!');
        }
        return redirect()->route('tag.index')->with('danger','Tag already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tag::where('id', $id)->delete();
        return redirect()->back()->with('success','Tag deleted successfully!');
    }

    public static function postCount($id){
        $postCount = tag_post::where('tag_id',$id)->count();
        return $postCount;
    }
}