@extends('user/layouts/app')

@section('content')

<div class="course-header col-md-12">
    <div class="container pt-5">
        <div class="text-center pt-5">
            <h1>{{ $course -> name }}</h1>
            <h3>{{ $course -> desc }}</h3>
            <button class="btn btn-outline-light px-5 mt-3">START</button>
        </div>
    </div>
</div>

<div class="blank"></div>

<div class="course">
    <div class="container">
        <div class="col-md-12">
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="tab-wrap">
                        <ul id="tabs" class="nav nav-tabs justify-content-around">
                            <li class="nav-item"><a href="" data-target="#overview" data-toggle="tab"
                                    class="nav-link text-uppercase active">Overview</a></li>
                            <li class="nav-item"><a href="" data-target="#syllabus" data-toggle="tab"
                                    class="nav-link text-uppercase">Syllabus</a></li>
                        </ul>
                        <br>
                        <div id="tabsContent" class="tab-content">
                            <div id="overview" class="tab-pane fade active show">
                                <div class="disc">
                                    <h2>Overview</h2>
                                    {{ $course_detail -> course_desc }}
                                </div>
                                <hr>
                                <div class="learn">
                                    <h2>What You learn</h2>
                                    {{ $course_detail -> learn }}
                                </div>
                            </div>
                            <div id="syllabus" class="tab-pane fade">
                                <ul class="course-syllabus">
                                    @foreach ($lessons as $lesson)
                                        <li><a href="{{ route('lesson', [$course -> slug, $lesson -> slug]) }}">{{$lesson -> title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="course-short-info text-center col-md-4 p-3">
                    @if ($course -> course_type == 1)
                    <img class="ml-3" src="{{ asset('user/img/crown.png') }}" alt="Premium Course">
                    <span class="float-right">${{ $course -> price }}</span>
                    @endif
                    <h6>Join</h6>
                    <h4>{{$course_user}}</h4>
                    <p>people who have taken this course</p>
                    <h6 class="mt-5">Time to Complete</h6>
                    <h4>{{$course_detail->hours}} Hours</h4>
                    <h6 class="mt-5">Prerequisites</h6>
                    <h4>{{$course_detail->course_prerequiste}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
