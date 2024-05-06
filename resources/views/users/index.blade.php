@extends('layout.app')

@push('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush

@section('button')
    <a href="{{ route('users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i>
        New User
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>#</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>#</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->title }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a name="edit-{{ $user->id }}" id="edit-{{ $user->id }}" class="btn btn-outline-primary btn-sm" href="{{ route('users.edit', $user) }}" role="button">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a name="editPassword-{{ $user->id }}" id="editPassword-{{ $user->id }}" class="btn btn-outline-danger btn-sm" href="{{ route('user-password.edit', ['user_password' => $user]) }}" role="button">
                            <i class="fas fa-edit"></i>
                            Reset Password
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No users</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
