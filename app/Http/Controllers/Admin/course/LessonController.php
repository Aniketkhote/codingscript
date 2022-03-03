<?php

namespace App\Http\Controllers\Admin\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\course\lesson;
use App\Model\user\course\course;
use App\Model\user\course\course_category;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = lesson::all();
        return view('admin/course/lesson/show', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = lesson::all();
        $courses = course::all();
        return view('admin/course/lesson/new', compact('lessons', 'courses'));
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
            'course' => 'required',
            'body' => 'required',
            'order' => 'required',
        ]);

        $slug =  strtolower(str_replace(' ', '_', $request -> title));

        if(lesson::all()->where('slug',$slug)->count() < 1)
        {
            $lesson = new lesson();
            $lesson -> title = $request -> title;
            $lesson -> slug = $slug;
            $lesson -> course_id = $request -> course;
            $lesson -> body = $request -> body;
            $lesson -> order = $request -> order;
            $lesson -> save();
            return redirect()->route('lesson.index')->with('success','Lesson created successfully!');
        }
        return redirect()->route('lesson.index')->with('danger','Lesson already exists');
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
        $lesson = lesson::where('id', $id)->first();
        $courses = course::all();

        return view('admin/course/lesson/edit', compact('lesson', 'courses'));
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
            'course' => 'required',
            'body' => 'required',
            'order' => 'required',
        ]);

        $lesson = lesson::find($id);
            $lesson -> title = $request -> title;
            $lesson -> slug = $request -> slug;
            $lesson -> course_id = $request -> course;
            $lesson -> body = $request -> body;
            $lesson -> order = $request -> order;
            $lesson -> save();
            return redirect()->route('lesson.index')->with('success','Lesson Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        lesson::where('id', $id)->delete();
        return redirect()->back()->with('success','Lesson deleted successfully!');
    }

    public static function LessonCourse($id){
        $lessonCourse = lesson::where('course_id', $id)->first();
        $course = course::all()->where('id',$lessonCourse->course_id)->first();
        return $course->name;
    }
}
