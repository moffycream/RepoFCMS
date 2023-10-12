{{--
@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="admin-dashboard-container">
    <!-- Default admin can't edit profile -->
    @if (Session::get('accountType') == "Admin")
    <a href="{{url('admin-edit-profile')}}" class="btn">Edit Profile</a>
@endif
<a href="{{url('admin-register')}}" class="btn">Create New Profile</a>
<a href="{{url('add-menu')}}" class="btn">Add Menu</a>
<a href="{{url('add-food')}}" class="btn">Add Food</a>
<a href="{{url('business-analytics')}}" class="btn">Business Analytics</a>
<a href="{{url('logout')}}" class="btn">Logout</a>
</div>
@endsection
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('include/head')
</head>

<body>
    <article>
        <div class="admin-dashboard-container">
        <a class="logo" href="{{url('/')}}"><img src="{{ asset('images/logo.png') }}" alt="logo"><span class="logo-text">Food Edge</span></a>
            <!-- Default admin can't edit profile -->
            <p>Account</p>
            @if (Session::get('accountType') == "Admin")
            <a href="{{url('admin-edit-profile')}}">Edit Profile</a>
            @endif
            <a href="{{url('admin-register')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-profile.png') }}" alt="icon"><span>Create New Profile</span></a>
            <hr class="admin-dashboard-line">

            <p>Business</p>
            <a href="{{url('business-analytics')}}"><img class="admin-dashboard-icon" src="{{ asset('images/business-analytic.png') }}" alt="icon"><span>Business analytics</span></a>
            <hr class="admin-dashboard-line">
            
            <p>Menu</p>
            <a href="{{url('add-menu')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-menu.png') }}" alt="icon"><span>Add menu</span></a>
            <a href="{{url('add-food')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-food.png') }}" alt="icon"><span>Add food</span></a>

            <a href="{{url('logout')}}"><img class="admin-dashboard-icon" src="{{ asset('images/logout.png') }}" alt="icon"><span>Logout</span></a>
        </div>
    </article>
    @include('include/footer')
    @yield('js')
    <!-- Add your JavaScript and other script tags here -->
</body>

</html>