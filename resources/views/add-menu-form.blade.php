<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    @include ('include/header')
    <article>
        <h1 class="title">Add Menu</h1>

        <div class="container">
            <form action="">
                <label>Menu name</label>
                <input type="text">
                <label>Food selected</label>
                <p>Total price: </p>
            </form>
        </div>
    </article>
    @include ('include/footer')
</body>

</html>