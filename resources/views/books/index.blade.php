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
    <a href="{{ route('books.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        New Book
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Cover</th>
                <th>Stock</th>
                <th>#</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Cover</th>
                <th>Stock</th>
                <th>#</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year_published }}</td>
                    <td><a href="{{ $book->cover }}" target="_blank"><img src="{{ $book->cover }}" loading="lazy" height="50"></a></td>
                    <td>{{ $book->stock() }}</td>
                    <td>
                        <a name="edit-{{ $book->id }}" id="edit-{{ $book->id }}" class="btn btn-outline-primary btn-sm" href="{{ route('books.edit', $book) }}" role="button">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No books</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
