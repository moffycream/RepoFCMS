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
                        <h2>{{session('username')}}</h2>
                        <a href="{{url('profile')}}">Edit Profile</a>
                    </div>
                </div>
                <div class="row navigation">
                    @php
                    $activeLink = Route::currentRouteName();
                    @endphp
                    <ul>
                        <li><a href="{{url('profile')}}" class="{{ $activeLink == 'profile' ? 'active' : '' }}">My Profile</a></li>
                        <li><a href="{{url('customer-review-history')}}" class="{{ $activeLink == 'customer-review-history' ? 'active' : '' }}">Review History</a></li>
                        <li><a href="{{url('customer-order-history')}}" class="{{ $activeLink == 'customer-order-history' ? 'active' : '' }}">Order History</a></li>
                        <li><a href="{{url('membership')}}" class="{{ $activeLink == 'membership' ? 'active' : '' }}">Membership</a></li>
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