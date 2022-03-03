<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\blog\post;
use App\Model\user\User;
use App\Model\user\course\course;
use Webdevmatics\Chatter\Models\Discussion;

class DashboardController extends Controller
{
    public function index()
    {
        $new_register_users = User::all()->count();
        $total_posts = post::all()->count();
        $total_discussions = Discussion::all()->count();
        $total_courses = course::all()->count();

        return view('admin/dashboard', compact('new_register_users', 'total_posts', 'total_discussions', 'total_courses'));
    }
}
