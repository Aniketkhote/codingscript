<?php
    use App\Http\Controllers\User\Blog\SinglePostController;
?>
@extends('user/layouts/app')

@section('header')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection

@section('content')

<div class="post">
    <div class="container">
        <div class="col-md-12">
            @include('inc/message')
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-grids">
                        <div class="grid">
                            <h3 class="text-center post-title">{{ $post -> title }}</h3>
                            <div class="entry-media">
                                <img href="@yield('post-img')"
                                    src="{{ Storage::disk('local')->url($post->image) }}"
                                    alt="{{ $post -> title }}">
                            </div>
                            <div class="entry-body">
                                @foreach($post -> categories as $category)
                                    <span class="cat">
                                        <a href="{{ route('category', $category) }}">
                                            {{ $category -> name }}
                                        </a>
                                    </span>
                                @endforeach
                                <span
                                    class="date float-right">{{ $post -> created_at -> diffForHumans() }}
                                </span>
                                <hr>
                                <div>
                                    {!! htmlspecialchars_decode($post -> body) !!}
                                </div>
                                <hr>
                                <h5>Tags Clouds</h5>
                                @foreach($post -> tags as $tag)
                                    <span class="tag">
                                        <a href="{{ route('tag', $tag) }}">
                                            {{ $tag -> name }}
                                        </a>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="blog-grids">
                        <div class="grid">
                            <div class="author-profile float-left">
                                <?php $getAuthorInfo = SinglePostController::getAuthorInfo($post->posted_by) ?>
                                @if ($getAuthorInfo -> image == '')
                                    <img src="{{asset('admin/img/default.jpg')}}" width="100px" height="100px" class="rounded-circle" alt="Cinque Terre">
                                @else
                                    <img src="{{ Storage::disk('local')->url($getAuthorInfo -> image)}}" width="100px" height="100px" class="rounded-circle" alt="Cinque Terre">
                                @endif
                            </div>
                            <div class="author-bio offset-2 pl-3">
                                <h5>{{ $getAuthorInfo -> name }}</h5>
                                <p class="text-muted">{{ $getAuthorInfo -> description }}</p>
                                <div class="social-widget">
                                    <span>
                                        <a href="https://www.instagram.com/aniket.khote" target="blank"><i class="fa fa-instagram"></i></a>
                                    </span>
                                    <span>
                                        <a href="https://twitter.com/aniketkhote99" target="blank"><i class="fa fa-twitter"></i></a>
                                    </span>
                                    <span>
                                        <a href="https://www.facebook.com/people/Aniket-Khote/100010274708019" target="blank"><i class="fa fa-facebook"></i></a>
                                    </span>
                                    <span>
                                        <a href="https://www.linkedin.com/in/aniket-khote-3391a7108" target="blank"><i class="fa fa-linkedin"></i></a>
                                    </span>
                                    <span>
                                        <a href="https://github.com/Aniketkhote" target="blank"><i class="fa fa-github"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comment">
                        @comments([
                        'model' => $post,
                        'approved' => true
                        ])
                    </div>
                </div>

                <div class="sidebar col-md-4">
                    @include('user.blog.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection