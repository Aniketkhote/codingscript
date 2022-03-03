<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Model\user\blog\post;
use App\Model\user\blog\tag;
use App\Model\user\blog\category;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Storage;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class PostController extends Controller
{
    public function index()
    {

        SEOMeta::setTitle('Coding Script | Blog');
        SEOMeta::setDescription('Coding Script is help to new programmers to improve their skills. So you want to deep dive into coding then your right place.');
        SEOMeta::setCanonical(url()->full());
        SEOMeta::setRobots('index, follow');
        SEOMeta::addKeyword(['Python','Java','Laravel','PHP','web Development','html','css']);

        OpenGraph::setDescription('Coding Script is help to new programmers to improve their skills. So you want to deep dive into coding then your right place.');
        OpenGraph::setTitle('Coding Script | Blog');
        OpenGraph::setUrl(url()->full());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'en-us');
        OpenGraph::addProperty('locale:alternate', ['en-us']);
        
        JsonLd::setTitle('Coding Script | Blog');
        JsonLd::setDescription('Coding Script is help to new programmers to improve their skills. So you want to deep dive into coding then your right place.');
        JsonLd::setType('Article');

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
