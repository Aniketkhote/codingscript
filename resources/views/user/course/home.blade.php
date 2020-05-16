@extends('user/layouts/app')

@section('content')

<div class="blog col-md-12">
    <div class="container pt-5">
        <div class="row pt-5">
            <p>Whether you’re trying to level up your career, build your side project, or simply play around with
                programming, you’ve found the right place to start. Explore our programs and courses, try an exercise or
                two, and join our community of 45 million learners.</p>
        </div>
    </div>
</div>

<div class="blank"></div>

<div class="lang-list">
    <div class="container">
        <div class="info text-center">
            <h4>Courses</h4>
            <p>Codecademy courses teach you a specific language or technology through interactive lessons.</p>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 course-box">
                    <a href="/course/html">
                        <div class="course-body">
                            <h6 class="text-muted text">Course</h6>
                            <h4 class="font-weight-bold text-capitalize">Introduction to HTML</h4>
                            <p>Learn the basics of HTML5 and start building & editing web pages.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
