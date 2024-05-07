@extends('layout.app')

@section('button')
    <a href="{{ route('books.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i>
        Back
    </a>
@endsection

@section('content')
    <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="isbn">ISBN <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('isbn')is-invalid @enderror" name="isbn" id="isbn"
                aria-describedby="isbnHelp" value="{{ old('isbn', $book->isbn) }}">
            @error('isbn')
                <small id="isbnHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" id="title"
                aria-describedby="titleHelp" value="{{ old('title', $book->title) }}">
            @error('title')
                <small id="titleHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('author')is-invalid @enderror" name="author" id="author"
                aria-describedby="authorHelp" value="{{ old('author', $book->author) }}">
            @error('author')
                <small id="authorHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="publisher">Publisher <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('publisher')is-invalid @enderror" name="publisher"
                id="publisher" aria-describedby="publisherHelp" value="{{ old('publisher', $book->publisher) }}">
            @error('publisher')
                <small id="publisherHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="year_published">Year <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('year_published')is-invalid @enderror" name="year_published"
                id="year_published" aria-describedby="year_publishedHelp"
                value="{{ old('year_published', $book->year_published) }}">
            @error('year_published')
                <small id="year_publishedHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="total_owned">Total Owned <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('total_owned')is-invalid @enderror" name="total_owned"
                id="total_owned" aria-describedby="total_ownedHelp" value="{{ old('total_owned', $book->total_owned) }}">
            @error('total_owned')
                <small id="total_ownedHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description')is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description', $book->description) }}</textarea>
            @error('descrription')
                <small id="descrriptionHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" class="form-control @error('cover')is-invalid @enderror" name="cover" id="cover"
                aria-describedby="coverHelp">
            <img src="{{ $book->cover }}" class="img-fluid mt-3" width="200">
            @error('cover')
                <small id="coverHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <hr class="mt-5">

    <div class="col-md-4 mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white lead">
                Delete this book
            </div>
            <div class="card-body">
                <form action="{{ route('books.destroy', $book) }}" method="post">
                    @csrf @method('DELETE')
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="sure" id="sure" value="1" required> I am sure to delete this book.
                        </label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
