<?php
use App\Http\Controllers\Admin\Forum\ForumCategoryController;
?>
@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet"
    href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Category</h3>
            </div>
            <form action="{{ route('forum-category.store') }}" method="POST">
                @csrf
                {{ method_field('POST') }}
                <div class="card-body">
                    <div class="from-group">
                        <input type="text" class="form-control" name="name" placeholder="Enter Catgory Name" required>
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group my-colorpicker2">
                            <input type="text" placeholder="Clicked For Choose Color" name="color" class="form-control">
        
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-square"></i></span>
                            </div>
                        </div>
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
                <h3 class="card-title">categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="col-md-4">Name</th>
                            <th>Slug</th>
                            <th>Color</th>
                            <th>Discussion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $category -> name }}</b><br>
                                        <p>
                                            <a class="text-blue"
                                                href="{{ route('forum-category.edit', $category -> id) }}">Edit</a>
                                            |
                                            <a class="text-red"
                                                onclick="event.preventDefault(); document.getElementById('delete-category-{{ $category -> id }}').submit();"
                                                href="">Delete</a>

                                            <form id="delete-category-{{ $category->id }}" method="post"
                                                action="{{ route('forum-category.destroy', $category -> id) }}"
                                                style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>{{ $category -> slug }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $category -> color }}">
                                        {{ $category -> color }}
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                       echo $discussionCount = ForumCategoryController::discussionCount($category->id)
                                    ?>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Color</th>
                            <th>Discussion</th>
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
<script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    });

</script>
@endsection
