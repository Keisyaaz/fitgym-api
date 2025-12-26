<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - FitGym</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="register-wrapper">
        <div class="register-container">
            
            <div class="header-title">
                <h2>Register</h2>
                <p style="opacity: 0.8; font-size: 14px;">Create your account</p>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input id="name" type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input id="username" type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input id="email" type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input id="phone" type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-register">REGISTER</button>

            </form>

            <div class="footer-link">
                Already have an account? <a href="{{ route('login') }}">Login Here</a>
            </div>

        </div>
    </div>

</body>
</html>