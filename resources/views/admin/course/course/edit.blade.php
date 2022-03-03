@extends('admin/layouts/app')

@section('header')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

@endsection

@section('no-thumbnail',asset('admin/img/default.jpg'))

@section('main')

@include('inc/message')

<form role="form" action="{{ route('course.update' , $course -> id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="col-12">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="title" value="{{ $course -> name }}" name="title"
                                class="form-control" placeholder="Course Title Name ...">
                            <p class="text-muted ml-2">*The name is how it appears on your site.</p>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ $course -> slug }}" name="slug" class="form-control"
                                placeholder="Course Title Slug ...">
                            <p class="text-muted ml-2" id="slug"></p>
                        </div>
                        <div class="mb-3">
                            <textarea name="body" class="textarea form-control" rows="3">{{ $course -> desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="course_detail" class="textarea form-control" rows="3"
                                placeholder="Write Course Details">{{ $course_detail -> course_desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="learn" class="textarea form-control" rows="3"
                                placeholder="Write what they will be learn from course">{{ $course_detail -> learn }}</textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="course_prerequiste" class="textarea form-control" rows="3"
                                placeholder="Write Prerequiste for this course">{{ $course_detail -> course_prerequiste }}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select class="form-control" name="langauge">
                                    @foreach ($langauges as $langauge)
                                    <option value="{{ $langauge -> id }}" @if ($langauge -> id == $course -> lang)
                                        selected
                                        @endif
                                        >{{ $langauge->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="category">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category -> id }}" @if ($category -> id == $course -> category)
                                        selected
                                        @endif
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="level">

                                    <option value="beginner" {{ $course -> level == 'beginner' ? 'selected' : '' }}>
                                        Beginner</option>
                                    <option value="intermediate"
                                        {{ $course -> level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="advanced" {{ $course -> level == 'advanced' ? 'selected' : '' }}>
                                        Advanced</option>


                                </select>
                            </div>
                            <label>Course Type :</label><br>

                            <div class="row">
                                <div class="form-check ml-2">
                                    <label class="form-check-label">
                                        <input type="radio" onclick="price_box(0)" class="form-check-input" value="0"
                                            name="type" @if ($course -> course_type == 0)
                                        checked
                                        @endif
                                        >Free
                                    </label>
                                </div>
                                <div class="form-check ml-5">
                                    <label class="form-check-label">
                                        <input type="radio" onclick="price_box(1)" class="form-check-input" value="1"
                                            name="type" @if ($course -> course_type == 1)
                                        checked
                                        @endif
                                        >Premium
                                    </label>
                                </div>
                                <div class="form-group price form-control-xs col-md-4">
                                    <input type="text" id="price" value="{{ $course -> price }}" name="price"
                                        class="form-control" placeholder="Enter price ...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('footer')

<script>
    var inputBox = document.getElementById('title');

    inputBox.onkeyup = function () {
        document.getElementById('slug').innerHTML =
            "<span class='text-danger text-muted'>URL is look like : </span>" + (inputBox.value).replace(/\s+/g,
                '-').toLowerCase();
    }

    function price_box(x){
    if(x == 1){
        document.getElementById('price').style.display='block';
    }else{
        document.getElementById('price').style.display='none';
        return;
    }
}

</script>

@endsection
