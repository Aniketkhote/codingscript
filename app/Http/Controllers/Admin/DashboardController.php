<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\blog\post;
use App\Model\user\User;
use Webdevmatics\Chatter\Models\Discussion;
use Illuminate\Http\Request;
use Laravelista\Comments\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $new_register_users = User::all()->count();
        $total_posts = post::all()->count();
        $total_discussions = Discussion::all()->count();
        $totalPendingComment = Comment::all()->where('approved','=',0)->count();

        return view('admin/dashboard',compact('new_register_users','total_posts','total_discussions','totalPendingComment'));
    }
}
