<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    @include('include/head')
</head>
<body>
    @include('include/header')
    <div class="container">
        @yield('content') <!-- This is where the content of specific pages will be inserted -->
    </div>
    @include('include/footer')
    <!-- Add your JavaScript and other script tags here -->
</body>
</html>

