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
    <a href="{{ route('borrows.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        New Borrow
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ISBN</th>
                <th>Book Title</th>
                <th>Member Name</th>
                <th>Created</th>
                <th>Operator</th>
                <th>#</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>ISBN</th>
                <th>Book Title</th>
                <th>Member Name</th>
                <th>Created</th>
                <th>Operator</th>
                <th>#</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse ($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->id }}</td>
                    <td>{{ $borrow->book->isbn }}</td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->user->name }}</td>
                    <td>{{ $borrow->created_at->format('d F Y, H:i') }}</td>
                    <td>{{ $borrow->created_by }}</td>
                    <td>
                        <form action="{{ route('borrows.destroy', $borrow) }}" method="post">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" role="button"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-edit"></i>
                                Return
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No borrows</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
