<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Series Controller</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

            @auth
                <a href="{{ route('logout') }}">Logout</a>
            @endauth

            @guest
                <a href="{{ route('login') }}">Login</a>
            @endguest
        </div>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>

        @isset($successMessage)
            <div class="alert alert-success">
                {{ $successMessage }}
            </div>
        @endisset

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </div>
</body>
</html>
