<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    @include ('include/header')
    <article>
        <h1 class="title">Add Food</h1>

        <div class="container">
            <div class="row-add-menu">
                <div class="col-add-menu">
                    <a href="{{url('add-food-form')}}">+</a>
                </div>
                <div class="col-add-menu">
                    <a href="{{url('add-food-form')}}">+</a>
                </div>
                <div class="col-add-menu">
                    <a href="{{url('add-food-form')}}">+</a>
                </div>
            </div>
        </div>
    </article>
    @include ('include/footer')
</body>

</html>