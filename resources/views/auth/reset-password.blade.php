@extends('layouts.main')

@section('content')
<div class="container py-5">
    <h3>Reset Password</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
