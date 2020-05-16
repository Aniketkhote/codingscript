<?php

namespace App\Http\Controllers\Admin\course;

use App\Http\Controllers\Controller;
use App\Model\user\course\course_category;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = course_category::all();
        return view('admin/course/category/category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = course_category::all();
        return view('admin/course/category/category', compact('categories'));
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

        if(course_category::all()->where('slug',$slug)->count() < 1)
        {
            $course_category = new course_category();
            $course_category -> name = $request -> name;
            $course_category -> slug = $slug;
            $course_category -> save();
            return redirect()->route('course-category.index')->with('success','Category created successfully!');
        }
        return redirect()->route('course-category.index')->with('danger','Category already exists');
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
        $categories = course_category::all();
        $category = course_category::where('id', $id)->first();

        return view('admin/course/category/edit', compact('category', 'categories'));
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

        if(course_category::all()->where('slug',$slug)->count() < 1)
        {
            $course_category = course_category::find($id);
            $course_category -> name = $request -> name;
            $course_category -> slug = $slug;
            $course_category -> save();
            return redirect()->route('course-category.index')->with('success','Category updated successfully!');
        }
        return redirect()->route('course-category.index')->with('danger','Category already exists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        course_category::where('id', $id)->delete();
        return redirect()->back()->with('success','Category deleted successfully!');
    }
}
