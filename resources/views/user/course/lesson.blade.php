@extends('user/layouts/app')

@section('content')

<div class="course-header col-md-12">
    <div class="container pt-5">
        <div class="text-center pt-5">
            <h1>{{ $lesson -> title }}</h1>
        </div>
    </div>
</div>

<div class="blank"></div>

<div class="course">
    <div class="container">
        <div class="col-md-12">
            <div class="row mb-5">
                <div class="col-md-8 offset-2">
                    <h3 class="text-center">{{ $lesson -> title }}</h3>
                    <hr>
                    <p class="pl-5 pr-5 pt-3">{{ $lesson -> body }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
