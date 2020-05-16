<?php

namespace App\Http\Controllers\User\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user/course/home');
    }

    public function detail()
    {
        return view('user/course/course-detail');
    }
}
