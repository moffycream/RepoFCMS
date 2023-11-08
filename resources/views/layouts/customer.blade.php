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
                    @php
                    $activeLink = Route::currentRouteName();
                    @endphp
                    <ul>
<<<<<<< HEAD
                        <li><a href="{{url('profile')}}">My Profile</a></li>
                        <li><a href="customer-review-history">Review History</a></li>
                        <li><a href="membership">Membership</a></li>
=======
                        <li><a href="{{url('profile')}}" class="{{ $activeLink == 'profile' ? 'active' : '' }}">My Profile</a></li>
                        <li><a href="{{url('customer-review-history')}}" class="{{ $activeLink == 'customer-review-history' ? 'active' : '' }}">Review History</a></li>
                        <li><a href="{{url('customer-order-history')}}" class="{{ $activeLink == 'customer-order-history' ? 'active' : '' }}">Order History</a></li>
>>>>>>> e61e4b4e9dcfcb0cd2b5690f57db9eb47b44e32d
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