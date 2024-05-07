@extends('layout.app')

@section('button')
    <a href="{{ route('borrows.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i>
        Back
    </a>
@endsection

@section('content')
    <form action="{{ route('borrows.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="user_id">Member Name</label>
            <select class="form-control" name="user_id" id="user_id">
                <option value="">Choose a member</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} | {{ $user->email }}</option>
                @endforeach
            </select>
            @error('user_id')
                <small id="user_idHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Continue</button>
    </form>
@endsection
