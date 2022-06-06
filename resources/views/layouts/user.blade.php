<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('welcome/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('welcome/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    @yield('css')

</head>

<body>

    @include('layouts.inc.user-header')
    @yield('content')
    @include('layouts.inc.user-footer')

    <script src="{{ asset('welcome/js/jquery-3.3.1.min.js') }}"></script>
    @yield('js')
    {{-- <script src="{{ asset('welcome/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('welcome/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('welcome/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('welcome/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('welcome/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('welcome/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('welcome/js/main.js') }}"></script>
</body>

</html>
