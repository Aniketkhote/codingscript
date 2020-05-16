@extends('admin/layouts/app')

@section('header')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

@endsection

@section('no-thumbnail',asset('admin/img/default.jpg'))

@section('main')

@include('inc/message')

<form role="form" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="title" value="{{ old('name') }}" name="title" class="form-control"
                                placeholder="Enter Title Name ...">
                            <p class="text-muted ml-2">*The name is how it appears on your site.</p>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('slug') }}" name="slug" class="form-control"
                                placeholder="Enter Title Slug ...">
                                <p class="text-muted ml-2" id="slug"></p>
                        </div>
                        <div class="mb-3">
                            <textarea name="body" id="editor1" class="textarea"
                                placeholder="Place some text here"></textarea>
                        </div>
                        <div class="form-group">
                        <input type="text" name="excerpt" value="{{ old('excerpt') }}" class="form-control" placeholder="Enter Post Excerpt ...">
                            <p class="text-muted">*This text show on main page post.</p>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail :</label><br>
                            <span class="btn btn-app btn-file" style="padding:50px;">
                                <i class="fas fa-edit"></i> Add Image
                                <input id="file" name="thumbnail" type="file" onchange="imgPreview(event)"
                                    class="form-control">
                            </span>
                            <span style="padding:50px;">
                                <img id="preview" name="thumb" src="@yield('no-thumbnail')"
                                    style="width:200px; height:100px;">
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Publish
                        </h3>
                    </div>
                    <div class="card-body">
                        <button type="submit" name="action" value="draft" class="btn btn-default">Save Darft</button>
                        <button type="submit" name="action" value="publish"
                            class="btn btn-primary float-right">Publish</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="select2-primary">
                                <select class="select2" name="categories[]" multiple="multiple"
                                    data-placeholder="Select a Category" style="width: 100%;">
                                    @foreach($categories as $category)
                                        <option value="{{ $category -> id }}">{{ $category -> name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Tag
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="select2-purple">
                                <select class="select2" name="tags[]" multiple="multiple"
                                    data-placeholder="Select a Tag" data-dropdown-css-class="select2-purple"
                                    style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag -> id }}">{{ $tag -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('footer')

<script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form'
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    function imgPreview(event) {
        var reader = new FileReader();
        var preview = document.getElementById("preview")

        reader.onload = function () {

            if (reader.readyState = 2) {
                preview.src = reader.result;
            }
        }

        reader.readAsDataURL(event.target.files[0]);

    }

    
    var inputBox = document.getElementById('title');

    inputBox.onkeyup = function(){
        document.getElementById('slug').innerHTML = "<span class='text-danger text-muted'>URL is look like : </span>" + (inputBox.value).replace(/\s+/g, '-').toLowerCase();
    }

</script>

@endsection
