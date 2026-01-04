@extends('layouts.guest')

@section('title', 'Login FitGym')

@section('content')
<div class="register-wrapper">
    <div class="register-container">

        <div class="login-header text-center mb-4">
            <div class="icon-circle">
                <i class="far fa-user"></i>
            </div>
            <h2 class="text-white fw-semibold">Sign In</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control"
                       placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password" class="form-control"
                       placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-register">LOGIN</button>

            <div class="options d-flex justify-content-between mt-3 text-white">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>
        </form>

        <div class="footer-link">
            Don't have an account?
            <a href="{{ route('register') }}">REGISTER HERE</a>
        </div>

    </div>
</div>
@endsection
