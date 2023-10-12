@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-register-page">
    <h1>Register New Account</h1>
    <form method="post" action="{{route('admin.register')}}">
        @csrf
        @if(isset($errorMsg) && !empty($errorMsg))
        <div>
            <ul>
                @foreach(explode('<br>', $errorMsg) as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>

        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required><br><br>
        <input type="firstName" id="firstName" name="firstName" placeholder="First Name" required>

        <input type="text" id="lastName" name="lastName" placeholder="Last Name" required><br><br>

        <input type="text" id="phone" name="phone" placeholder="Phone number" required><br><br>

        <input type="text" id="email" name="email" placeholder="Email" required><br><br>

        <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required><br><br>

        <input type="text" id="city" name="city" placeholder="City" required><br><br>

        <input type="text" id="postcode" name="postcode" placeholder="Postcode" required><br><br>

        <select name="accountType" id="accountType">
            <optgroup label="Choose account type">
                <option value="Customer">Customer</option>
                <option value="OperationTeam">Operation Team</option>
                <option value="Admin">Admin</option>
            </optgroup>
        </select>
        <br><br>
        <button type="submit">Create account</button>
    </form>
</div>
@endsection