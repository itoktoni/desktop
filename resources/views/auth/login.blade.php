@extends('layouts.auth')

@section('content')

<!-- form -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Username or email" name="login" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group d-flex justify-content-between">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Remember me</label>
        </div>
        <a href="{{ route('password.request') }}">Reset password</a>
    </div>
    <button class="btn btn-primary btn-block">Sign in</button>
    <hr>
    <p class="text-muted">Don't have an account?</p>
    <a href="{{ route('pages.register') }}" class="btn btn-outline-light btn-sm">Register now!</a>
</form>
<!-- ./ form -->

@endsection