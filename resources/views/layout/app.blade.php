<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'FitGym')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav style="padding: 10px; background:#eee;">
    <a href="/produk">Produk</a> |
    <form action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
