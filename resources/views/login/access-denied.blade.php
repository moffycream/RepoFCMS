@extends('layouts.app')
@section('title', 'Access Denied')
@section('content')
<div class="container-access-denied">
    <h1>This page is forbidden!</h1><br>
    <p>Please login to the right account first before directly access the page!</p>
    <p>You are logged out now due to security reasons!</p><br>
    <a href="{{url('login')}}" class="button">Login Page</a>
    @php
    Session::flush();
    @endphp
</div>
@endsection