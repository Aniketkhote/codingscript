<?php
    use App\Http\Controllers\Admin\course\LessonController;
?>
@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lessons</h3>
        <a type="button" class="btn btn-default btn-sm float-right" href="{{ route('lesson.create') }}">
            New
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $loop -> index + 1 }}</td>
                    <td class="titleHover">
                        <a href="">
                            <b>{{ $lesson -> title }}</b><br>
                            <p>
                                <a class="text-blue" href="{{ route('lesson.edit', $lesson -> id) }}">Edit</a> |
                                <a class="text-red" onclick="event.preventDefault(); document.getElementById('delete-lesson-{{ $lesson -> id }}').submit();" href="">Delete</a>

                                <form id="delete-lesson-{{$lesson->id}}" method="lesson" action="{{ route('lesson.destroy', $lesson -> id) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </p>
                        </a>
                    </td>
                    <td>
                        <?php echo LessonController::LessonCourse($lesson->course_id) ?>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Course</th>
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
