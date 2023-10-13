@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-admin-register-page">
    <img class="admin-register-page-logo" src="{{ asset('images/logo.png') }}" alt="logo">
    <form method="post" action="{{route('admin.register')}}">
        @csrf
        @if(isset($errorMsg) && !empty($errorMsg))
        <div>
            <ul>
                @foreach(explode('<br>', $errorMsg) as $error)
                <li>{{ $error }}</li>
                @endforeach
                <br>
            </ul>
        </div>
        @endif
        <div class="admin-register-box">
            <div class="admin-register-box-columns">
                <div class="admin-register-left-column">
                    <h2>Sign up</h2>
                    <p>Start an account, to start your journey</p>
                    <input type="text" id="username" name="username" placeholder="Username" value="{{isset($_POST['username']) ? $_POST['username'] : ''}}" required><br><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required><br><br>
                    <input type="text" id="email" name="email" placeholder="Email" value="{{isset($_POST['email']) ? $_POST['email'] : ''}}" required><br><br>
                </div>

                <div class="admin-register-right-column">
                    <h2>Let us know more!</h2>
                    <p>Ensure a smooth food journey</p>
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" value="{{isset($_POST['firstName']) ? $_POST['firstName'] : ''}}" required><br><br>
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{isset($_POST['lastName']) ? $_POST['lastName'] : ''}}" required><br><br>
                    <input type="text" id="phone" name="phone" placeholder="Phone number" value="{{isset($_POST['phone']) ? $_POST['phone'] : ''}}" required><br><br>
                    <textarea id="streetAddress" name="streetAddress" placeholder="Street Address" value="{{isset($_POST['streetAddress']) ? $_POST['streetAddress'] : ''}}" required></textarea><br><br>
                    <input type="text" id="city" name="city" placeholder="City" value="{{isset($_POST['city']) ? $_POST['city'] : ''}}" required><br><br>
                    <input type="text" id="postcode" name="postcode" placeholder="Postcode" value="{{isset($_POST['postcode']) ? $_POST['postcode'] : ''}}" required><br><br>
                </div>
            </div>

            <div class="admin-register-centre-column">
                <select name="accountType" id="accountType">
                    <optgroup label="Choose account type">
                        <option value="Customer">Customer</option>
                        <option value="OperationTeam">Operation Team</option>
                        <option value="Admin">Admin</option>
                    </optgroup>
                </select>
                <br><br>
                <button class="admin-register-submit-button" type="submit">Create account</button>
            </div>
        </div>
    </form>
</div>
@endsection