<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    <div class="register-page">
        @include ('include/header')
        <h1>Register successful!</h1><br>
        <p>You may now head to the login page to login your account!</p>


        <a href="login" class="button">Login Page</a>

    </div>
    @include ('include/footer')
</body>


</html>