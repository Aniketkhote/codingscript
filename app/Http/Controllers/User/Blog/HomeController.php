<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Storage;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;


class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Coding Script | Home');
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

        return view('user.home');
    }
}
