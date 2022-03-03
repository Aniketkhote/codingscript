<?php

namespace App\Http\Controllers\Admin\course;

use App\Http\Controllers\Controller;
use App\Model\user\course\course;
use App\Model\user\course\course_detail;
use App\Model\user\course\language;
use App\Model\user\course\lesson;
use App\Model\user\course\course_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = course::all();
        return view('admin/course/course/show', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langauges = language::all();
        $categories = course_category::all();
        return view('admin/course/course/new', compact('langauges', 'categories'));
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
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'category' => 'required',
            'langauge' => 'required',
            'level' => 'required',
            'type' => 'required'
        ]);


        $course = new course;
        $course->name = $request->title;
        $course->slug = $request->slug;
        $course->desc = $request->body;
        $course->lang = $request->langauge;
        $course->level = $request->level;
        $course->category = $request->category;
        $course->course_type = $request->type;
        $course->price = $request->price;
        $course->instructor = Auth::id();
        $course->save();

        $course_detail = new course_detail;
        $course_detail->course_id = $course->id;
        $course_detail->course_desc = $request->course_detail;
        $course_detail->course_prerequiste = $request->course_prerequiste;
        $course_detail->learn = $request->learn;
        $course_detail->hours = $request->hour;
        $course_detail->save();

        return redirect(route('course.index'))->with('success', 'Course created successfully!');
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
        $course = course::all();
        $course = course::where('id', $id)->first();
        $course_detail = course_detail::where('course_id' , $course->id)->first();
        $langauges = language::all();
        $categories = course_category::all();
        return view('admin/course/course/edit', compact('course', 'course_detail', 'langauges', 'categories'));
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
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'category' => 'required',
            'langauge' => 'required',
            'level' => 'required',
            'type' => 'required'
        ]);


        $course = course::find($id);
        $course->name = $request->title;
        $course->slug = $request->slug;
        $course->desc = $request->body;
        $course->lang = $request->langauge;
        $course->level = $request->level;
        $course->price = $request->price;
        $course->category = $request->category;
        $course->price = $request->price;
        $course->instructor = Auth::id();
        $course->save();

        $course_detail = course_detail::find($id);
        $course_detail->course_id = $course->id;
        $course_detail->course_id = $request->course_desc;
        $course_detail->course_prerequiste = $course->course_prerequiste;
        $course_detail->learn = $request->learn;
        $course_detail->chapter = $request->chapter;
        $course_detail->lesson = $request->lesson;
        $course_detail->hours = $request->hour;

        $course->save();
        $course_detail->save();

        return redirect(route('course.index'))->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        course::where('id', $id)->delete();
        return redirect()->back()->with('success','Course deleted successfully!');
    }

    public static function courseLang($id)
    {
        $courseLang = course::where('id', $id)->first();
        $lang = language::all()->where('id',$courseLang->lang)->first();
        return $lang->name;
    }
    public static function courseCategory($id)
    {
        $courseCategory = course::where('id', $id)->first();
        $category = course_category::all()->where('id',$courseCategory->category)->first();
        return $category->name;
    }
}
