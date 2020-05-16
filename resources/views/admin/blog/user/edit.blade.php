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
            <form action="{{ route('user.update' , $user -> id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="card-header">
                    <h3 class="card-title">Update User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{ $user -> name }}" name="name" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" value="{{ $user -> email }}" name="email" placeholder="Enter User Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="status" value="1" class="form-check-input"
                        @if (old('status')==1 || $user->status == 1)
                            checked
                        @endif
                        >
                        <label class="form-check-label">Status</label>
                    </div>
                    <hr>
                    <label class="form-check-label">Assign Roles :</label>
                    <div class="">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" name="role[]" value="{{ $role -> id }}" class="form-check-input"
                                    @foreach ($user -> roles as $user_role)
                                        @if ($user_role -> id == $role -> id)
                                            checked
                                        @endif
                                    @endforeach
                                ><label class="form-check-label">{{ $role -> name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="footer text-center">
                        <a type="button" class="btn btn-default mr-2" href="{{ route('user.index') }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Assigned By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $user -> name }}</b><br>
                                        <p>
                                            <a class="text-blue"
                                                href="{{ route('user.edit', $user -> id) }}">Edit</a>
                                            |
                                            <a class="text-red"
                                                onclick="event.preventDefault(); document.getElementById('delete-user-{{ $user -> id }}').submit();"
                                                href="">Delete</a>

                                            <form id="delete-user-{{ $user->id }}" method="post"
                                                action="{{ route('user.destroy', $user -> id) }}"
                                                style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>{{ $user -> email }}</td>
                                <td></td>
                                <td>
                                    @foreach ($user -> roles as $role)
                                        <span class="badge badge-success">
                                            {{ $role -> name }}
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Assigned By</th>
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
