@extends('layouts.guest')

@section('title', 'Login FitGym')

@section('content')
<div class="register-wrapper">
    <div class="register-container">
        <h2 class="text-center mb-4 text-white">Login FitGym</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email Address"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>
            @error('email')
                <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required
                >
            </div>
            @error('password')
                <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-register">LOGIN</button>

            <div class="options d-flex justify-content-between mt-3 text-white">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
