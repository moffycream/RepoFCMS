<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('include/head')
</head>

<body>
    @include('include/header')
    <article class="customer-article">
        <div class="container">
            <div class="col">
                <div class="row customer-account">
                    <div class="customer-profile-picture">
                        <img src="{{ asset('profile-images/profile.png') }}" alt="Profile Picture">
                    </div>
                    <div>
                        <h2>Username</h2>
                        <a href="#">Edit Profile</a>
                    </div>
                </div>
                <div class="row navigation">
                    <ul>
                        <li><a href="{{url('profile')}}">My Profile</a></li>
                        <li><a href="customer-review-history">Review History</a></li>
                    </ul>
                </div>
            </div>
            <div class="col">
                @yield('content') <!-- This is where the content of specific pages will be inserted -->
            </div>
        </div>
    </article>
    @include('include/footer')
    @yield('js')
    <!-- Add your JavaScript and other script tags here -->
</body>

</html>