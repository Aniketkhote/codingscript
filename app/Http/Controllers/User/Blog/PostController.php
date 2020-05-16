<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Model\user\blog\post;
use App\Model\user\blog\tag;
use App\Model\user\blog\category;

class PostController extends Controller
{
    public function index()
    {
        $posts = post::where('status', 'publish')->orderBy('created_at','DESC')->paginate(5);
        $recentPosts = post::where('status', 'publish')->orderBy('created_at', 'DESC')->take(5)->get();
        $categories = category::all();
        return view('user/blog/post', compact('posts', 'categories', 'recentPosts'));
    }

    public function tag(tag $tag)
    {
        $posts = $tag -> posts();
        $categories = category::all();
        $recentPosts = post::where('status', 'publish')->orderBy('created_at', 'DESC')->take(5)->get();
        return view('user/blog/post', compact('posts', 'categories', 'recentPosts'));
    }

    public function category(category $category)
    {
        $posts = $category -> posts();
        $categories = category::all();
        $recentPosts = post::where('status', 'publish')->orderBy('created_at', 'DESC')->take(5)->get();
        return view('user/blog/post', compact('posts', 'categories', 'recentPosts'));
    }
    
}
