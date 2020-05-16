<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\blog\category;
use App\Model\user\blog\category_post;
use App\Model\user\blog\post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        return view('admin/blog/category/category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        return view('admin/blog/category/category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(category::all()->where('slug',$slug)->count() < 1)
        {
            $category = new category();
            $category -> name = $request -> name;
            $category -> slug = $slug;
            $category -> save();
            return redirect()->route('category.index')->with('success','Category created successfully!');
        }
        return redirect()->route('category.index')->with('danger','Category already exists');
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
        $categories = category::all();
        $category = category::where('id', $id)->first();

        return view('admin/blog/category/edit', compact('category', 'categories'));
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

        if(category::all()->where('slug',$slug)->count() < 1)
        {
            $category = category::find($id);
            $category -> name = $request -> name;
            $category -> slug = $slug;
            $category -> save();
            return redirect()->route('category.index')->with('success','Category updated successfully!');
        }
        return redirect()->route('category.index')->with('danger','Category already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::where('id', $id)->delete();
        return redirect()->back()->with('success','Category deleted successfully!');
    }

    public static function postCount($id){
        $postCount = category_post::where('category_id',$id)->count();
        return $postCount;
    }
}
