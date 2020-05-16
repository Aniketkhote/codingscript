<?php
use App\Http\Controllers\Admin\Blog\CommentController;
?>
@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet"
    href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="col-md-4">Commentor</th>
                            <th class="col-md-4">Comment</th>
                            <th class="col-md-4">Title</th>
                            <th class="col-md-4">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td>
                                    <?php 
                                       echo $commentedBy = CommentController::commentedBy($comment->id)
                                    ?>
                                </td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $comment -> comment }}</b><br>
                                        <p>
                                            @if ($comment->approved == 0)
                                                <a class="text-success"
                                                    href="{{ route('comment.status', [$comment -> id, 1]) }}">Approved</a>
                                            @else
                                                <a class="text-warning"
                                                    href="{{ route('comment.status', [$comment -> id, 0]) }}">Unapproved</a>
                                            @endif
                                            
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>
                                    <?php 
                                       echo $commentedPost = CommentController::commentedPost($comment->id)
                                    ?>
                                </td>
                                <td>{{ $comment -> created_at -> diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th class="col-md-4">Commentor</th>
                            <th class="col-md-4">Comment</th>
                            <th class="col-md-4">Title</th>
                            <th class="col-md-4">Time</th>
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
