@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="container-login">
    <div class="panel">
        <h1>LOGIN</h1>
        <p>Every great journey begins with a single step. Log in and start your journey today</p>
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-danger">
            {{ Session::get('success') }}
        </div>
        @endif
        <form method="post" action="{{route('user.login')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="text" name="username" required placeholder="Enter username" value="{{isset($_POST['username']) ? $_POST['username'] : ''}}">
            <input type="password" name="password" required placeholder="Enter password">
            <button type="submit">Sign in</button>
            <p><a href="{{url('forgot-password')}}">Forgot password</a><br>
                Did not have an account? <a href="{{url('register')}}">Sign up</a></p>
        </form>
    </div>
</div>
@endsection