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
                <h3 class="card-title">Update Role</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('role.update', $role -> id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="from-group">
                        <input type="text" class="form-control" value="{{ $role -> name }}" name="name"
                            placeholder="Enter Role Name" required>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <label>Posts Permission</label>
                            @foreach($permissions as $permission)
                                @if($permission -> for == 'post')
                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]"
                                            value="{{ $permission -> id }}" class="form-check-input"
                                            @foreach ($role -> permissions as $role_permit)
                                                @if ($role_permit -> id == $permission -> id)
                                                    checked
                                                @endif
                                            @endforeach>
                                        <label class="form-check-label">{{ $permission -> name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-6">
                            <label>Users Permission</label>
                            @foreach($permissions as $permission)
                                @if($permission -> for == 'user')
                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]"
                                            value="{{ $permission -> id }}" class="form-check-input"
                                            @foreach ($role -> permissions as $role_permit)
                                                @if ($role_permit -> id == $permission -> id)
                                                    checked
                                                @endif
                                            @endforeach>
                                        <label class="form-check-label">{{ $permission -> name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <label>Others Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission -> for == 'other')
                            <div class="form-check">
                                <input type="checkbox" name="permission[]" value="{{ $permission -> id }}"
                                    class="form-check-input"
                                    @foreach ($role -> permissions as $role_permit)
                                        @if ($role_permit -> id == $permission -> id)
                                            checked
                                        @endif
                                    @endforeach>
                                <label class="form-check-label">{{ $permission -> name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="col-md-4">Name</th>
                            <th class="col-md-4">Slug</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td class="titleHover">
                                    <a href="">
                                        <b>{{ $role -> name }}</b><br>
                                        <p>
                                            <a class="text-blue"
                                                href="{{ route('role.edit', $role -> id) }}">Edit</a>
                                            |
                                            <a class="text-red"
                                                onclick="event.preventDefault(); document.getElementById('delete-role-{{ $role -> id }}').submit();"
                                                href="">Delete</a>

                                            <form id="delete-role-{{ $role->id }}" method="post"
                                                action="{{ route('role.destroy', $role -> id) }}"
                                                style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </p>
                                    </a>
                                </td>
                                <td>{{ $role -> slug }}</td>
                                <td>4</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
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
