@extends('layouts.guest')

@section('title', 'Register FitGym')

@section('content')
<div class="register-wrapper">
    <div class="register-container">

        <div class="header-title">
            <h2>Register</h2>
            <p style="opacity: 0.8; font-size: 14px;">Create your account</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="name" class="form-control"
                       placeholder="Full Name" value="{{ old('name') }}" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                <input type="text" name="username" class="form-control"
                       placeholder="Username" value="{{ old('username') }}" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control"
                       placeholder="Email Address" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="text" name="phone" class="form-control"
                       placeholder="Phone Number" value="{{ old('phone') }}" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control"
                       placeholder="Password" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-register">REGISTER</button>
        </form>

        <div class="footer-link">
            Already have an account?
            <a href="{{ route('login') }}">Login Here</a>
        </div>

    </div>
</div>
@endsection
