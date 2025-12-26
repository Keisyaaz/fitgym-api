<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - FitGym</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="register-wrapper">
        <div class="register-container" style="max-width: 400px;">
            
            <div class="login-header text-center mb-4">
                <div class="icon-circle" style="
                    width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); 
                    border-radius: 50%; display: flex; align-items: center; justify-content: center; 
                    margin: 0 auto 15px; color: #2d7a92; font-size: 40px; border: 2px solid rgba(255,255,255,0.4);">
                    <i class="far fa-user"></i>
                </div>
                <h2 style="color: white; font-weight: 600;">Sign In</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-register">LOGIN</button>

                <div class="options d-flex justify-content-between mt-3 text-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>
            </form>

            <div class="footer-link">
                Don't have an account? <a href="{{ route('register') }}">REGISTER HERE</a>
            </div>
            
        </div>
    </div>

</body>
</html>