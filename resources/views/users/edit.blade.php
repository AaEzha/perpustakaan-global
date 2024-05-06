@extends('layout.app')

@section('button')
    <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i>
        Back
    </a>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" method="post">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" id="name"
                aria-describedby="nameHelp" value="{{ old('name', $user->name) }}">
            @error('name')
                <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email')is-invalid @enderror" name="email" id="email"
                aria-describedby="emailHelp" value="{{ old('email', $user->email) }}">
            @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Role</label>
            <select class="form-control @error('title')is-invalid @enderror" name="title" id="title" aria-describedby="titleHelp">
                <option value="">Select a role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(old('title', $user->title) === $role)>{{ $role }}</option>
                @endforeach
            </select>
            @error('title')
                <small id="titleHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
