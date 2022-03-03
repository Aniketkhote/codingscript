@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet"
    href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Language</h3>
            </div>
            <form action="{{ route('language.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('POST') }}
                <div class="card-body">
                    <div class="from-group">
                        <input type="text" class="form-control" name="name" placeholder="Enter Language Name" required>
                    </div>
                    <div class="from-group mt-3">
                        <textarea name="desc" class="form-control" rows="3"
                        placeholder="Place some text here"></textarea>                    
                    </div>
                    <div class="form-group mt-3 text-center">
                        <span class="btn btn-app btn-file">
                            <i class="fas fa-upload"></i> Add Image
                            <input id="file" name="img" type="file" class="form-control">
                        </span>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Languages</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Img</th>
                            <th class="col-md-3">Name</th>
                            <th>Slug</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td>
                                    <img class="img-thumbnail rounded-circle" src="{{ Storage::disk('local')->url($language->img) }}" alt="">
                                </td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $language -> name }}</b><br>
                                        <p>
                                            <a class="text-blue"
                                                href="{{ route('language.edit', $language -> id) }}">Edit</a>
                                            |
                                            <a class="text-red"
                                                onclick="event.preventDefault(); document.getElementById('delete-language-{{ $language -> id }}').submit();"
                                                href="">Delete</a>

                                            <form id="delete-language-{{ $language->id }}" method="post"
                                                action="{{ route('language.destroy', $language -> id) }}"
                                                style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>{{ $language -> slug }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Img</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Count</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection

@section('footer')

<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

</script>
@endsection
