@extends('admin/layouts/app')

@section('header')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

@endsection

@section('no-thumbnail',asset('admin/img/default.jpg'))

@section('main')

@include('inc/message')

<form role="form" action="{{ route('course.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-12">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="title" value="{{ old('name') }}" name="title" class="form-control"
                                placeholder="Enter Course Name ...">
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('slug') }}" name="slug" class="form-control"
                                placeholder="Enter Course Slug ...">
                            <p class="text-muted ml-2" id="slug"></p>
                        </div>
                        <div class="mb-3">
                            <textarea name="body" class="textarea form-control" rows="3"
                                placeholder="Write short Course Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="course_detail" class="textarea form-control" rows="3"
                                placeholder="Write Course Details"></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="learn" class="textarea form-control" rows="3"
                                placeholder="Write what they will be learn from course"></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="course_prerequiste" class="textarea form-control" rows="3"
                                placeholder="Write Prerequiste for this course"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select class="form-control" name="langauge">
                                    <option>Select Language</option>
                                    @foreach ($langauges as $langauge)
                                    <option value="{{ $langauge -> id }}">{{ $langauge->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="category">
                                    <option>Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category -> id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="level">
                                    <option>Select Level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" id="title" value="{{ old('hour') }}" name="hour" class="form-control"
                                    placeholder="total hours required ...">
                            </div>
                        </div>
                        <label>Course Type :</label><br>

                        <div class="row">
                            <div class="form-check ml-2">
                                <label class="form-check-label">
                                    <input type="radio" onclick="price_box(0)" class="form-check-input" value="0" name="type">Free
                                </label>
                            </div>
                            <div class="form-check ml-5">
                                <label class="form-check-label">
                                    <input type="radio" onclick="price_box(1)" class="form-check-input" value="1" name="type">Premium
                                </label>
                            </div>
                            <div class="form-group price form-control-xs col-md-4">
                                <input type="text" id="price" value="{{ old('price') }}" name="price" class="form-control"
                                    placeholder="Enter price ...">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Create</button>
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
