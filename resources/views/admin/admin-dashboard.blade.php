@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-admin-dashboard">
    <h1>Welcome to the Admin Dashboard</h1>
    <!-- Default admin can't edit profile -->
    @if (Session::get('accountType') == "Admin")
    <a href="{{url('admin-edit-profile')}}" class="btn">Edit Profile</a>
    @endif
    <a href="{{url('admin-register')}}" class="btn">Create New Profile</a>
    <a href="{{url('add-menu')}}" class="btn">Add Menu</a>
    <a href="{{url('add-food')}}" class="btn">Add Food to Menu</a>
    <a href="{{url('business-analytics')}}" class="btn">Business Analytics</a>
    <a href="{{url('logout')}}" class="btn">Logout</a>
</div>
@endsection