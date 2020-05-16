@extends('admin/layouts/app')

@section('header')
<link rel="stylesheet"
    href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection


@section('main')

@include('inc/message')

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission</h3>
            </div>

            <form action="{{ route('permission.update', $permission -> id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="from-group">
                    <input type="text" class="form-control" value="{{ $permission -> name }}" name="name" placeholder="Enter Permission Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" name="for" id="for">
                            <option selected disabled>Select Permission For </option>
                            <option value="user">User</option>
                            <option value="post">Post</option>
                            <option value="other">Other</option>
                        </select>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" value="create" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>For</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $permission -> name }}</b><br>
                                        <p>
                                            <a class="text-blue"
                                                href="{{ route('permission.edit', $permission -> id) }}">Edit</a>
                                            |
                                            <a class="text-red"
                                                onclick="event.preventDefault(); document.getElementById('delete-permission-{{ $permission -> id }}').submit();"
                                                href="">Delete</a>

                                            <form id="delete-permission-{{ $permission->id }}" method="post"
                                                action="{{ route('permission.destroy', $permission -> id) }}"
                                                style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>{{ $permission -> for }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>For</th>
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
