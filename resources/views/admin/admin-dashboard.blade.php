@extends('layouts.app')
@section('title', 'Register')
@section('content')



<div class="dashboard">
    <h1>Welcome to the Admin Dashboard</h1>
    <a href="{{url('admin-edit-profile')}}" class="btn">Edit Profile</a>
    <a href="{{url('admin-register')}}" class="btn">Register New Profile</a>
    <a href="/profile/business-analytics" class="btn">Business Analytics</a>
    <a href="{{route('logout')}}" class="btn">Logout</a>
</div>
@endsection