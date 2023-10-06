<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    @include ('include/header')

    <div class ="register-page">
    <h1>Registration Form</h1><br>
    <form class="register-form" method="POST" action="{{url('register')}}">
    @csrf    
        <input type="text" id="username" name="username" placeholder= "Name" required><br><br>

        <input type="password" id="password" name="password" placeholder="Password"required>
        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required><br><br>
        <input type="firstName" id="firstName" name="firstName" placeholder= "First Name" required>

        <input type="text" id="lastName" name="lastName" placeholder= "Last Name" required><br><br>

        <input type="text" id="phone" name="phone" placeholder= "Phone number" required><br><br>

        <input type="text" id="email" name="email" placeholder= "Email" required><br><br>

        <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required><br><br>

        <input type="text" id="city" name="city" placeholder="City" required><br><br>

        <input type="text" id="postcode" name="postcode" placeholder="Postcode" required><br><br>
        <input type="hidden" name="accountType" value="Customer">

        <p>Have an account already? <a href="login" class="login-here">Login here</a></p><br>

        <input class ="register-submit-button" type="submit" value="Register">
    </form>

    <br>
    </div>
    
@include ('include/footer')
</body>


</html>