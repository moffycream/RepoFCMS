@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container-register-successful">
    <h1>Register successful!</h1><br>
    <p>New account is created successfully</p>
    <a href="{{url('admin-dashboard')}}" class="button">Return to dashboard</a>
</div>
@endsection