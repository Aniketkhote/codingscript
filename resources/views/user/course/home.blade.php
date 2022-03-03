<?php
    use App\Http\Controllers\User\Course\HomeController;
?>

@extends('user/layouts/app')

@section('content')

<div class="blog col-md-12">
    <div class="container pt-5">
        <div class="row text-center pt-5">
            <p>Whether you’re trying to level up your career, build your side project, or simply play around with
                programming, you’ve found the right place to start. Explore our programs and courses and join our
                community of thousands of learners.</p>
        </div>
    </div>
</div>

<div class="blank"></div>

<div class="lang-list">
    <div class="container">
        <div class="info text-center">
            <h4>Courses</h4>
            <p>Coding Script courses teach you a specific language or technology through interactive lessons.</p>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="row">
                @foreach ($courses as $course)
                <div class="col-md-4 course-box">
                    <a href="{{ route('course', $course -> slug) }}">
                        <div class="course-body">
                            <span class="d-flex justify-content-between">
                                <h6 class="text-muted text">{{ strtoupper($course -> level) }}</h6>
                                <h6 class="{{ $course -> course_type == 0 ? 'text-success' : 'text-primary' }} text">
                                    @if ($course -> course_type == 0)
                                        FREE
                                    @else
                                        <img class="premium" src="{{ asset('user/img/crown.png') }}" alt="Premium Course">
                                        PREMIUM
                                    @endif
                                </h6>
                            </span>
                            <h4 class="font-weight-bold text-capitalize">{{ $course -> name }}</h4>
                            <p>{{ $course -> desc }}</p>
                            <span class="d-flex justify-content-between">
                                <p class="course-lang">
                                    <?php echo $getLang = HomeController::getLang($course->lang) ?>
                                </p>
                                <span class="d-flex justify-content-end">
                                    <div class="start"></div>
                                    <div id="arrowAnim">
                                        <div class="arrowSliding">
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay1">
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay2">
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="arrowSliding delay3">
                                            <div class="arrow"></div>
                                        </div>
                                    </div>
                                </span>
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
