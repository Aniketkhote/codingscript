@extends('admin/layouts/app')

@section('no-thumbnail',asset('admin/img/default.jpg'))

@section('main')

@include('inc/message')

<form role="form" action="{{ route('lesson.update' , $lesson -> id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="col-12">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="title" value="{{ $lesson -> title }}" name="title" class="form-control"
                                placeholder="Enter Lesson Name ...">
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ $lesson -> slug }}" name="slug" class="form-control"
                                placeholder="Enter Lesson Slug ...">
                            <p class="text-muted ml-2" id="slug"></p>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="course">
                                <option>Select Course</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course -> id }}"
                                    @if ($lesson -> course_id == $course -> id)
                                    selected
                                    @endif
                                >{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea name="body" id="editor1" class="textarea form-control" rows="3"
                        placeholder="Write Content">{{ $lesson -> body }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="number" value="{{ $lesson -> order }}" name="order" class="form-control"
                                placeholder="Enter Lesson Order ...">
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

<script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>

<script>

    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form'
    });

    var inputBox = document.getElementById('title');

    inputBox.onkeyup = function () {
        document.getElementById('slug').innerHTML =
            "<span class='text-danger text-muted'>URL is look like : </span>" + (inputBox.value).replace(/\s+/g,
                '-').toLowerCase();
    }
}
    

</script>

@endsection
