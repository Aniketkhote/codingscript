<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webdevmatics\Chatter\Models\Category;
use Webdevmatics\Chatter\Models\Discussion;

class ForumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin/forum/category/category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/forum/category/category', compact('categories'));
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
            'color' => 'required',
        ]);

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(Category::all()->where('slug',$slug)->count() < 1)
        {
            $category = new Category();
            $category -> name = $request -> name;
            $category -> color = $request -> color;
            $category -> slug = $slug;
            $category -> save();
            return redirect()->route('forum-category.index')->with('success','Category created successfully!');
        }
        return redirect()->route('forum-category.index')->with('danger','Category already exists');
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
        $categories = Category::all();
        $category = Category::where('id', $id)->first();

        return view('admin/forum/category/edit', compact('category', 'categories'));
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
            'color' => 'required'
        ]);

        $slug =  strtolower(str_replace(' ', '_', $request -> name));

        if(category::all()->where('slug',$slug)->count() < 1)
        {
            $category = category::find($id);
            $category -> name = $request -> name;
            $category -> color = $request -> color;
            $category -> slug = $slug;
            $category -> save();
            return redirect()->route('forum-category.index')->with('success','Category updated successfully!');
        }
        return redirect()->route('forum-category.index')->with('danger','Category already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success','Category deleted successfully!');
    }

    public static function discussionCount($id){
        $discussionCount = Discussion::where('chatter_category_id',$id)->count();
        return $discussionCount;
    }
}
