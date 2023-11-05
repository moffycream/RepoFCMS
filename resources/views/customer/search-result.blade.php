@extends('layouts.app')
@section('title', 'Search Result')
@section('content')


<div class="search-container">
    <form class="search-filter-form" method="POST" action="{{ route('search.filter') }}">
        @csrf
        <p>Price filter</p>
        <input type="hidden" name="search" value="{{$search}}">
        <div>
            <input type="radio" name="filter" id="price0" value="price0">
            <label for="price0">All</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price1" value="price1">
            <label for="price1">RM 0 - RM 100</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price2" value="price2">
            <label for="price2">RM 101 - Rm 200</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price3" value="price3">
            <label for="price3">RM 201 - RM 300</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price4" value="price4">
            <label for="price4">RM 301 - RM 400</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price5" value="price5">
            <label for="price5">RM 401 - RM 500</label>
        </div>
        <div>
            <input type="radio" name="filter" id="price6" value="price6">
            <label for="price6">RM 501 and above</label>
        </div>
        <button class="feedback-submit-button" type="submit">Submit</button>
    </form>
    <div>
        @if(isset($filter))
        @php
        $count = 0;
        @endphp
        @foreach ($listItems as $searchResult)
        @if($filter == "price0")
        @php
        $count++;
        @endphp
        @endif
        @if($filter == "price1")
        @if($searchResult->totalPrice > 0 && $searchResult->totalPrice <= 100) @php $count++; @endphp @endif @endif @if($filter=="price2" ) @if($searchResult->totalPrice > 100 && $searchResult->totalPrice <= 200) @php $count++; @endphp @endif @endif @if($filter=="price3" ) @if($searchResult->totalPrice > 200 && $searchResult->totalPrice <= 300) @php $count++; @endphp @endif @endif @if($filter=="price4" ) @if($searchResult->totalPrice > 300 && $searchResult->totalPrice <= 400) @php $count++; @endphp @endif @endif @if($filter=="price5" ) @if($searchResult->totalPrice > 400 && $searchResult->totalPrice <= 500) @php $count++; @endphp @endif @endif @if($filter=="price6" ) @if($searchResult->totalPrice > 500)
                            @php
                            $count++;
                            @endphp
                            @endif
                            @endif
                            @endforeach

                            <div class="search-header">
                                <h1>Search results for {{$search}}</h1>
                                <p>Total {{$count}} menu found</p>
                            </div>
                            @foreach ($listItems as $searchResult)
                            @if($filter == "price0")
                            <div class="search-result">
                                <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                <div>
                                    <p>Menu name: {{$searchResult->name}}</p>
                                    <p>Foods:</p>
                                    @foreach($searchResult->foods as $food)
                                    <p>{{$food->name}}</p>
                                    @endforeach
                                    <p>Price: RM {{$searchResult->totalPrice}}</p>
                                </div>
                            </div>
                            @endif
                            @if($filter == "price1")
                            @if($searchResult->totalPrice > 0 && $searchResult->totalPrice <= 100) <hr class="search-separate-line">
                                <div class="search-result">
                                <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                    <div>
                                        <p>Menu name: {{$searchResult->name}}</p>
                                        <p>Foods:</p>
                                        @foreach($searchResult->foods as $food)
                                        <p>{{$food->name}}</p>
                                        @endforeach
                                        <p>Price: RM {{$searchResult->totalPrice}}</p>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @if($filter == "price2")
                                @if($searchResult->totalPrice > 100 && $searchResult->totalPrice <= 200) <hr class="search-separate-line">
                                    <div class="search-result">
                                    <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                        <div>
                                            <p>Menu name: {{$searchResult->name}}</p>
                                            <p>Foods:</p>
                                            @foreach($searchResult->foods as $food)
                                            <p>{{$food->name}}</p>
                                            @endforeach
                                            <p>Price: RM {{$searchResult->totalPrice}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @if($filter == "price3")
                                    @if($searchResult->totalPrice > 200 && $searchResult->totalPrice <= 300) <hr class="search-separate-line">
                                        <div class="search-result">
                                        <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                            <div>
                                                <p>Menu name: {{$searchResult->name}}</p>
                                                <p>Foods:</p>
                                                @foreach($searchResult->foods as $food)
                                                <p>{{$food->name}}</p>
                                                @endforeach
                                                <p>Price: RM {{$searchResult->totalPrice}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @if($filter == "price4")
                                        @if($searchResult->totalPrice > 300 && $searchResult->totalPrice <= 400) <hr class="search-separate-line">
                                            <div class="search-result">
                                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                                <div>
                                                    <p>Menu name: {{$searchResult->name}}</p>
                                                    <p>Foods:</p>
                                                    @foreach($searchResult->foods as $food)
                                                    <p>{{$food->name}}</p>
                                                    @endforeach
                                                    <p>Price: RM {{$searchResult->totalPrice}}</p>
                                                </div>
                                            </div>
                                            @endif
                                            @endif
                                            @if($filter == "price5")
                                            @if($searchResult->totalPrice > 400 && $searchResult->totalPrice <= 500) <hr class="search-separate-line">
                                                <div class="search-result">
                                                <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                                    <div>
                                                        <p>Menu name: {{$searchResult->name}}</p>
                                                        <p>Foods:</p>
                                                        @foreach($searchResult->foods as $food)
                                                        <p>{{$food->name}}</p>
                                                        @endforeach
                                                        <p>Price: RM {{$searchResult->totalPrice}}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
                                                @if($filter == "price6")
                                                @if($searchResult->totalPrice > 500)
                                                <hr class="search-separate-line">
                                                <div class="search-result">
                                                <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                                                    <div>
                                                        <p>Menu name: {{$searchResult->name}}</p>
                                                        <p>Foods:</p>
                                                        @foreach($searchResult->foods as $food)
                                                        <p>{{$food->name}}</p>
                                                        @endforeach
                                                        <p>Price: RM {{$searchResult->totalPrice}}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
                                                @endforeach
                                                @else
                                                @php
                                                $count = 0;
                                                foreach($listItems as $searchItem){
                                                $count++;
                                                }
                                                @endphp

                                                @if($count > 0)
                                                <div class="search-header">
                                                    <h1>Search results for {{$search}}</h1>
                                                    <p>Total {{$count}} menu found</p>
                                                </div>
                                                @foreach ($listItems as $searchResult)
                                                <hr class="search-separate-line">
                                                <div class="search-result">
                                                    <img class="search-img" src="{{$searchResult->imagePath}}" alt="image">
                                                    <div>
                                                        <p>Menu name: {{$searchResult->name}}</p>
                                                        <p>Foods:</p>
                                                        @foreach($searchResult->foods as $food)
                                                        <p>{{$food->name}}</p>
                                                        @endforeach
                                                        <p>Price: RM {{$searchResult->totalPrice}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                @endif
                                                @php
                                                $count = 0;
                                                foreach($listItems as $searchResult){
                                                $count++;
                                                }
                                                @endphp
                                                @if ($count == 0)
                                                <div class="search-header">
                                                    <h1>Search results for {{$search}}</h1>
                                                    <p>0 menu found</p>
                                                </div>
                                                <p class="no-result">No result found, please try another keyword</p>
                                                @endif

    </div>
</div>
@endsection