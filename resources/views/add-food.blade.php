<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ('include/head')

<body>
    @include ('include/header')
    <article>
        <h1 class="title">Add Food</h1>



        <!-- Display other item details here -->


        <div class="container">
            <div class="row-add-menu">
                @foreach($listItems as $food)
                <div class="col-add-menu">
                    <img src="{{$food->imagePath}}" alt="Image">
                    <div class="col-add-menu-info">
                        <p>{{$food->name}}</p>
                        <p>{{$food->description}}</p>
                        <p>{{$food->price}}</p>
                    </div>
                </div>
                @endforeach
                <div class="col-add-menu">
                    <a href="{{url('add-food-form')}}">+</a>
                </div>
            </div>
        </div>
    </article>
    @include ('include/footer')
</body>

</html>