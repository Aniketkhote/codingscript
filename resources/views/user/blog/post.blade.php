@extends('user/layouts/app')

@section('content')

<div class="post">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    @if(count($posts)>0)
                        @foreach($posts as $post)
                            <div class="blog-grids">
                                <div class="grid">
                                    <h3 class="text-center post-title">
                                        <a
                                            href="{{ route('post', $post -> slug) }}">{{ $post -> title }}</a>
                                    </h3>
                                    <hr>
                                    <div class="entry-media">
                                        <img href="{{ route('post', $post -> slug) }}"
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
                                            {{ $post -> excerpt }}
                                        </div>
                                        <div class="read-more-date">
                                            <a href="{{ route('post', $post -> slug) }}">Read
                                                More..</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no_post col-md-6 offset-2 mt-5">
                            <h3 class="text-uppercase">Oops! Not Yet Any Post</h3>
                            <p class="text-muted">Sorry but the posts you are looking are not available.</p>
                            <a href="/blog">Back to homepage</a>
                        </div>
                    @endif
                    <div class="pagination" style="margin-left: 40%">
                        {{ $posts -> links() }}
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
