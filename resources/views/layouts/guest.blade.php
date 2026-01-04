<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FitGym')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="register-wrapper">
    <div class="register-container" style="max-width: 400px;">

        <div class="login-header text-center mb-4">
            <div class="icon-circle" style="
                width: 80px; height: 80px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 15px;
                color: #2d7a92;
                font-size: 40px;
                border: 2px solid rgba(255,255,255,0.4);">
                <i class="far fa-user"></i>
            </div>
            <h2 style="color: white; font-weight: 600;">
                @yield('title')
            </h2>
        </div>

        @yield('content')

    </div>
</div>

</body>
</html>
