<?php
use App\Http\Controllers\Admin\Blog\CategoryController;
?>
{{-- <div class="blog-grids">
    <div class="grid">
        <input type="text" class="form-control" placeholder="Search ...">
    </div>
</div> --}}

@if (count($categories)>0)
<div class="blog-grids">
    <div class="grid">
        <h5 class="text-uppercase text-center">Categories</h5>
        <hr>
        @foreach ($categories as $category)
            <p class="text-uppercase pl-3 pr-3">
                <a href="{{ route('category', $category) }}">
                <i class="fa fa-chevron-right"></i>
                {{ $category -> name }}
                <span class="float-right">(<?php echo $postCount = CategoryController::postCount($category->id) ?>)</span>
            </a>
        </p>
        @endforeach
    </div>
</div>
@endif

@if (count($recentPosts)>0)
<div class="blog-grids recentPost">
    <div class="grid">
        <h5 class="text-uppercase text-center">Recent Post</h5>
        <hr>
        @foreach ($recentPosts as $recentPost)
            <p>
                <a href="{{ route('post', $recentPost -> slug) }}">

                <img href="{{ route('post', $recentPost -> slug) }}"
                src="{{ Storage::disk('local')->url($recentPost->image) }}"
                alt="{{ $recentPost -> title }}"
                width="100px" height="50px">

                <span class="pl-2">
                    {{ $recentPost -> title }}
                </span>
            </a>
        </p>
        @endforeach
    </div>
</div>
@endif
