@extends('layout.app')

@section('button')
    <a href="{{ route('borrows.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
        onclick="return confirm('Are you sure to finish?')">
        Finish
        <i class="fa fa-check" aria-hidden="true"></i>
    </a>
@endsection

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
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Search by ISBN
                </div>
                <div class="card-body">
                    <form action="{{ route('borrow-books.update', $borrow_book) }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control" name="isbn" id="isbn"
                                aria-describedby="isbnHelp" placeholder="ISBN" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    Borrow List
                </div>
            </div>
            <ul class="list-group">
                @foreach ($borrows as $borrow)
                    <li class="list-group-item">{{ $borrow->book->title }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Search by Book
                </div>
                <div class="card-body">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Year</th>
                                <th>Cover</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td scope="row">{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->year_published }}</td>
                                    <td>
                                        <img src="{{ $book->cover }}" alt="{{ $book->title }}" height="50">
                                    </td>
                                    <td>
                                        <form action="{{ route('borrow-books.update', $borrow_book) }}" method="post">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
