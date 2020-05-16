<?php
use App\Http\Controllers\Admin\Blog\PostController;
?>
@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet"
    href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Posts</h3>
        @can('post.create', Auth::user())
        <a type="button" class="btn btn-default btn-sm float-right" href="{{ route('post.create') }}">
            New
        </a>
        @endcan
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="col-md-6">Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop -> index + 1 }}</td>
                        <td class="titleHover">
                            <a href="">
                                <b>{{ $post -> title }}</b><br>
                                <p>
                                    <a class="text-blue" href="{{ route('post.edit', $post -> id) }}">Edit</a> |
                                    <a class="text-red" onclick="event.preventDefault(); document.getElementById('delete-post-{{ $post -> id }}').submit();" href="">Delete</a>

                                    <form id="delete-post-{{$post->id}}" method="post" action="{{ route('post.destroy', $post -> id) }}" style="display: none">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </p>
                            </a>
                        </td>
                        <td><?php echo $author = PostController::author($post->posted_by) ?></td>
                        <td>
                            @foreach($post -> categories as $category)
                                <a href="{{ route('category.index')}}">
                                    <span class="badge badge-primary">
                                        {{ $category -> name }}
                                    </span>
                                </a>
                            @endforeach
                        </td>
                        <td>
                            <span class="badge badge-primary">
                                <?php echo $commentCount = PostController::commentCount($post->id) ?>
                            </span>
                            <span class="badge badge-success">
                                <?php echo $aprrovedCommentCount = PostController::aprrovedCommentCount($post->id) ?>
                            </span>
                            <span class="badge badge-warning">
                                <?php echo $pendingCommentCount = PostController::pendingCommentCount($post->id) ?>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Catgory</th>
                    <th>Comment</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
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
