@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container-register-page">
    <form method="post" action="{{route('user.register')}}">
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
        <div class="register-box">
            <div class="register-box-columns">
                <div class="register-left-column">
                    <h2>Sign up</h2>
                    <p>Start an account, to start your journey</p>
                    <div>
                        <input type="text" id="username" name="username" placeholder="Username" value="{{isset($_POST['username']) ? $_POST['username'] : ''}}" required>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                        <input type="text" id="email" name="email" placeholder="Email" value="{{isset($_POST['email']) ? $_POST['email'] : ''}}" required>
                    </div>
                </div>

                <div class="register-right-column">
                    <h2>Let us know more!</h2>
                    <p>Ensure a smooth food journey</p>
                    <div>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name" value="{{isset($_POST['firstName']) ? $_POST['firstName'] : ''}}" required>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{isset($_POST['lastName']) ? $_POST['lastName'] : ''}}" required>
                        <input type="text" id="phone" name="phone" placeholder="Phone number" value="{{isset($_POST['phone']) ? $_POST['phone'] : ''}}" required>
                        <textarea id="streetAddress" name="streetAddress" placeholder="Street Address" value="{{isset($_POST['streetAddress']) ? $_POST['streetAddress'] : ''}}" required></textarea>
                        <input type="text" id="city" name="city" placeholder="City" value="{{isset($_POST['city']) ? $_POST['city'] : ''}}" required>
                        <input type="text" id="postcode" name="postcode" placeholder="Postcode" value="{{isset($_POST['postcode']) ? $_POST['postcode'] : ''}}" required>
                    </div>
                </div>
            </div>

            <p>Have an account already? <a href="{{url('login')}}" class="login-here">Login here</a></p><br>

            <button class="register-submit-button" type="submit">Sign up</button>
    </form>
</div>
@endsection