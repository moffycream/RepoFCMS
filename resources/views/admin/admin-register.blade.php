@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-admin-register-page">
    <form method="post" action="{{route('admin.register')}}">
        @csrf
        <h1>Admin Register Account</h1>
        <div class="admin-register-box">
            <div class="admin-register-box-columns">
                <div class="admin-register-left-column">
                    <h2>Sign up</h2>
                    <p>Start an account, to start your journey</p>
                    <div>
                        <input type="text" id="username" name="username" placeholder="Username" value="{{isset($_POST['username']) ? $_POST['username'] : ''}}" required>
                        @if (isset($sameUsernameErrorMsg))
                        <p class="admin-register-error-msg">{!! $sameUsernameErrorMsg !!}</p>
                        @endif
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        @if (isset($passwordErrorMsg))
                        <p class="admin-register-error-msg">{!! $passwordErrorMsg !!}</p>
                        @endif
                        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                        @if (isset($confirmPasswordErrorMsg))
                        <p class="admin-register-error-msg">{!! $confirmPasswordErrorMsg !!}</p>
                        @endif
                        <input type="text" id="email" name="email" placeholder="Email" value="{{isset($_POST['email']) ? $_POST['email'] : ''}}" required>
                        @if (isset($emailErrorMsg))
                        <p class="admin-register-error-msg">{!! $emailErrorMsg !!}</p>
                        @endif
                    </div>
                </div>

                <div class="admin-register-right-column">
                    <h2>Let us know more!</h2>
                    <p>Ensure a smooth food journey</p>
                    <div>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name" value="{{isset($_POST['firstName']) ? $_POST['firstName'] : ''}}" required>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{isset($_POST['lastName']) ? $_POST['lastName'] : ''}}" required>
                        <input type="text" id="phone" name="phone" placeholder="Phone number" value="{{isset($_POST['phone']) ? $_POST['phone'] : ''}}" required>
                        @if (isset($phoneErrorMsg))
                        <p class="admin-register-error-msg">{!! $phoneErrorMsg !!}</p>
                        @endif
                        <textarea id="streetAddress" name="streetAddress" placeholder="Street Address" value="{{isset($_POST['streetAddress']) ? $_POST['streetAddress'] : ''}}" required></textarea>
                        <input type="text" id="city" name="city" placeholder="City" value="{{isset($_POST['city']) ? $_POST['city'] : ''}}" required>
                        <input type="text" id="postcode" name="postcode" placeholder="Postcode" value="{{isset($_POST['postcode']) ? $_POST['postcode'] : ''}}" required>
                        @if (isset($postcodeErrorMsg))
                        <p class="admin-register-error-msg">{!! $postcodeErrorMsg !!}</p>
                        @endif
                    </div>
                </div>
            </div>

            @if(isset($errorMsg) && !empty($errorMsg))
            <br>
            <div class="register-error-messages">
                <p>Please fix these errors to register your account</p>
                @foreach(explode('<br>', $errorMsg) as $error)
                {{ $error }} <br>
                @endforeach
            </div>
            <br>
            <div class="admin-register-centre-column">

                @endif
                <select name="accountType" id="accountType" title="select account type">
                    <optgroup label="Choose account type">
                        <option value="Customer">Customer</option>
                        <option value="OperationTeam">Operation Team</option>
                        <option value="Admin">Admin</option>
                    </optgroup>
                </select>

                <button class="admin-register-submit-button" type="submit">Create account</button>
            </div>
        </div>
    </form>
</div>
@endsection