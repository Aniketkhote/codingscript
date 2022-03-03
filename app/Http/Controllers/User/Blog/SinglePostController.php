<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use App\Model\user\blog\post;
use App\Model\user\blog\category;
use Illuminate\Routing\UrlGenerator;
use Storage;
use Illuminate\Http\Request;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;


class SinglePostController extends Controller
{
    public function post(post $post)
    {
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->excerpt);
        SEOMeta::setCanonical(url()->full());
        SEOMeta::setRobots('index, follow');
        SEOMeta::addMeta('article:published_time', $post->updated_at->toW3CString(), 'property');
        foreach($post -> categories as $category){ SEOMeta::addMeta('article:section', $category->name . ' |', 'property');}
        foreach($post -> tags as $tag){ SEOMeta::addKeyword($tag->name . ' |');}

        OpenGraph::setDescription($post->excerpt);
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl(url()->full());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'en-us');
        OpenGraph::addProperty('locale:alternate', ['en-us']);
        OpenGraph::addImage(url('/') . Storage::disk('local')->url($post->image));
        
        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->excerpt);
        JsonLd::setType('Article');
        JsonLd::addImage(url('/') . Storage::disk('local')->url($post->image));


       

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
