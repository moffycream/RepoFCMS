<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    @include ('include/header')

    <h2>Registration Form</h2>
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Register">
    </form>
    
@include ('include/footer')
</body>


</html>