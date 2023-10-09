@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container-register-successful">
    <h1>This page is forbidden!</h1><br>
    <p>Please login first before directly access the page!</p>
    <a href="{{url('login')}}" class="button">Login Page</a>
</div>
@endsection