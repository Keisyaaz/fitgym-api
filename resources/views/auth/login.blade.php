@extends('layouts.guest')

@section('title', 'Login FitGym')

@section('content')
<div class="register-wrapper">
    <div class="register-container">

        <div class="login-header text-center mb-4">
            <div class="icon-circle">
                <i class="far fa-user"></i>
            </div>
            <h2 class="text-white fw-bold">Sign In</h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-register">LOGIN</button>

            <div class="options mt-3 text-white">
                <input type="checkbox" name="remember"> Remember me
            </div>
        </form>

        <div class="footer-link">
            Don't have an account? <a href="{{ route('register') }}">REGISTER HERE</a>
        </div>

    </div>
</div>
@endsection
