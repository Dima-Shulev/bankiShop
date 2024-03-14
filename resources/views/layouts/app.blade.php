<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="@yield('keywords.page')" />
    <meta name="description" content="@yield('description.page')" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title.page')</title>
</head>
<body>

<main class="flex-grow-1 py-3">
    <div class="wrapper">
        <div class="container">
            @yield("content.page")
        </div>
    </div>
</main>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
