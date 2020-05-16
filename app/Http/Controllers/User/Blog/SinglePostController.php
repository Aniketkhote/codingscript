<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use App\Model\user\blog\post;
use App\Model\user\blog\category;

class SinglePostController extends Controller
{
    public function post(post $post)
    {
        $recentPosts = post::where('status', 'publish')->orderBy('created_at', 'DESC')->take(5)->get();
        $categories = category::all();
        return view('user/blog/single-post', compact('post', 'categories', 'recentPosts'));
    }

    public static function getAuthorInfo($id)
    {
        $getAuthorInfo = admin::where('id', $id)->first();
        return $getAuthorInfo;
    }
}
