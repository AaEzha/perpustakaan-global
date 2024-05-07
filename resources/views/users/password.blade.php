@extends('layout.app')

@section('button')
    <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm"></i>
        Back
    </a>
@endsection

@section('content')
    <form action="{{ route('user-password.update', ['user_password' => $user_password]) }}" method="post">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" id="password"
                aria-describedby="passwordHelp">
            @error('password')
                <small id="passwordHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
@endsection
