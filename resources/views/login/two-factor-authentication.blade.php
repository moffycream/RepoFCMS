@extends('layouts.app')
@section('title', 'Two Factor')
@section('content')
<div class="container-two-factor-authentication">
    <h1>2 Factor Authentication</h1><br>
    <p>An email with a code has been sent to your account<br>Please enter the code below</p>
    <form action="{{route('user.verify2FA')}}" method="post">
        @csrf
        <input type="text" name="code" placeholder="Enter code here">
        <button type="submit" class="two-factor-authentication-verify">Verify</button>
    </form>
    <p class="two-factor-authentication-note">Note: if you were to enter the wrong code, you will be <br>redirected back to the login page again</p>
</div>
@endsection