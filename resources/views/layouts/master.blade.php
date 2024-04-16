<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title', 'RoSupport')
    </title>
    @yield('head')
</head>
<body>
@include('navbar')

@yield('content')
</body>
</html>
