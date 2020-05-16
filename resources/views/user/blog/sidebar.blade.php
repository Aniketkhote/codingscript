<?php
use App\Http\Controllers\Admin\Blog\CategoryController;
?>
<div class="blog-grids">
    <div class="grid">
        <input type="text" class="form-control" placeholder="Search ...">
    </div>
</div>

<div class="blog-grids">
    <div class="grid">
        <h5 class="text-uppercase text-center">Categories</h5>
        <hr>
        @foreach ($categories as $category)
            <p class="offset-md-2 offset-1 text-uppercase"><a href="{{ route('category', $category) }}">
                <i class="fa fa-chevron-right"></i>
                {{ $category -> name }}
                ( <?php echo $postCount = CategoryController::postCount($category->id) ?> )
            </a></p>
        @endforeach
    </div>
</div>

<div class="blog-grids recentPost">
    <div class="grid">
        <h5 class="text-uppercase text-center">Recent Post</h5>
        <hr>
        @foreach ($recentPosts as $recentPost)
            <p><a href="{{ route('post', $recentPost -> slug) }}">

                <img href="{{ route('post', $recentPost -> slug) }}"
                src="{{ Storage::disk('local')->url($recentPost->image) }}"
                alt="{{ $recentPost -> title }}"
                width="100px" height="50px">

                <span class="pl-2">
                    {{ $recentPost -> title }}
                </span>
            </a></p>
        @endforeach
    </div>
</div>
