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
                <th>Returned</th>
                <th>Operator</th>
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
                <th>Returned</th>
                <th>Operator</th>
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
                    <td>{{ $borrow->returned_at->format('d F Y, H:i') }}</td>
                    <td>{{ $borrow->returned_by }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No borrows</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
