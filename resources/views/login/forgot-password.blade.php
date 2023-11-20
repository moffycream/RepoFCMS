@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<div class="container-login">
    <div class="panel">
        <h1>Reset password</h1>
        <p>Every great journey begins with a single step. Log in and start your journey today</p>
        @if (Session::has('forgotpassworderror'))
        <div class="alert alert-danger">
            {{ Session::get('forgotpassworderror') }}
        </div>
        @endif
        <form method="post" action="{{route('user.resetpassword')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="text" name="username" required placeholder="Enter username">
            <input type="password" name="newpassword" required placeholder="Enter new password">
            <input type="password" name="confirmnewpassword" required placeholder="Confirm new password">
            <button type="submit">Reset password</button>
        </form>
    </div>
</div>
@endsection