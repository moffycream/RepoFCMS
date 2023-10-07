<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<div class="container">
    <h1>Login</h1>
    <form method="post" action='login'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>


        <p>Forgot password</p>

        <input type="submit" class="login-submit-button" value="Login">
    </form>
</div>

@include ('include/footer')

</html>