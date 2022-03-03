<?php
    use App\Http\Controllers\Admin\course\CourseController;
?>
@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Courses</h3>
        <a type="button" class="btn btn-default btn-sm float-right" href="{{ route('course.create') }}">
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
                    <th>Lang</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $loop -> index + 1 }}</td>
                    <td class="titleHover">
                        <a href="">
                            <b>{{ $course -> name }}</b><br>
                            <p>
                                <a class="text-blue" href="{{ route('course.edit', $course -> id) }}">Edit</a> |
                                <a class="text-red" onclick="event.preventDefault(); document.getElementById('delete-course-{{ $course -> id }}').submit();" href="">Delete</a>

                                <form id="delete-course-{{$course->id}}" method="post" action="{{ route('course.destroy', $course -> id) }}" style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </p>
                        </a>
                    </td>
                    <td>
                        <?php echo CourseController::courseLang($course->id) ?>
                    </td>
                    <td>
                        <?php echo CourseController::courseCategory($course->id) ?>
                    </td>
                    <td>
                        {{ $course->level }}
                    </td>
                    <td>
                        @if ($course->course_type == 0)
                            Free
                        @else
                            Premium
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Lang</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Type</th>
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
