@extends('layouts.app')
@section('title', 'Register successful')
@section('content')
<div class="container-register-successful">
    <h1>Register successful!</h1><br>
    <p>You may now head to the login page to login your account!</p>
    <a href="{{url('login')}}" class="button">Login Page</a>
</div>
@endsection