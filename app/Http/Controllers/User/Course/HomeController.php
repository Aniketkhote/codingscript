<?php

namespace App\Http\Controllers\User\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\course\course;
use App\Model\user\course\lesson;
use App\Model\user\course\course_detail;
use App\Model\user\course\course_user;
use App\Model\user\course\language;

class HomeController extends Controller
{
    public function index()
    {
        $courses = course::all();
        return view('user/course/home', compact('courses'));
    }

    public function course($slug)
    {
        $course = course::where('slug' , $slug)->first();
        $course_detail = course_detail::where('course_id' , $course->id)->first();
        $course_user = course_user::where('course_id' , $course->id)->count();
        $lessons = lesson::all()->where('course_id', $course->id)->sortBy('order');
        return view('user/course/course', compact('course', 'lessons', 'course_detail', 'course_user'));
    }

    public static function getLang($id){
        $lang = language::where('id', $id)->first();
        return $lang -> name;
    }

    public function lesson($course,$slug)
    {
        $lesson = lesson::where('slug', $slug)->first();
        return view('user/course/lesson', compact('lesson'));
    }

}
