@extends('layouts.app')
@section('title', 'Search Result')
@section('content')


<div class="search-container">
    <div class="search-filter-form-container">
        <form class="search-filter-form" method="POST" action="{{ route('search.filter') }}">
            @csrf
            <p><span class="filter-title">Price filter</span></p>
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
            <button class="submit-button" type="submit">Submit</button>
        </form>
    </div>
    <div class="search-results">
        <!-- If got filter -->
        @if(isset($filter))
            @php
            $count = 0;
            @endphp
            <!-- Calculate the number of result found -->
            @foreach ($listItems as $searchResult)
                @if($filter == "price0")
                    @php
                    $count++;
                    @endphp
                @endif
                @if($filter == "price1")
                    @if($searchResult->totalPrice > 0 && $searchResult->totalPrice <= 100) 
                        @php 
                        $count++;
                        @endphp 
                    @endif 
                @endif 
                @if($filter=="price2" ) 
                    @if($searchResult->totalPrice > 100 && $searchResult->totalPrice <= 200) 
                        @php 
                        $count++; 
                        @endphp 
                    @endif 
                @endif 
                @if($filter=="price3" ) 
                    @if($searchResult->totalPrice > 200 && $searchResult->totalPrice <= 300) 
                        @php 
                        $count++; 
                        @endphp 
                    @endif 
                @endif 
                @if($filter=="price4" ) 
                    @if($searchResult->totalPrice > 300 && $searchResult->totalPrice <= 400) 
                        @php 
                        $count++; 
                        @endphp 
                    @endif 
                @endif 
                @if($filter=="price5" ) 
                    @if($searchResult->totalPrice > 400 && $searchResult->totalPrice <= 500) 
                        @php 
                        $count++; 
                        @endphp 
                    @endif 
                @endif 
                @if($filter=="price6" ) 
                    @if($searchResult->totalPrice > 500)
                        @php
                        $count++;
                        @endphp
                    @endif
                @endif
            @endforeach

            <!-- if have result found -->
            @if($count > 0)
                <!-- header of search result -->
                <div class="search-header">
                    <h1>Search results for {{$search}}</h1>
                    <p>Total {{$count}} menu found</p>
                </div>

                <!-- display search result -->
                @foreach ($listItems as $searchResult)
                    @if($filter == "price0")
                    <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div>
                    @endif

                    @if($filter == "price1")
                        @if($searchResult->totalPrice > 0 && $searchResult->totalPrice <= 100) <hr class="search-separate-line">
                        <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div>
                        @endif
                    @endif

                    @if($filter == "price2")
                        @if($searchResult->totalPrice > 100 && $searchResult->totalPrice <= 200) <hr class="search-separate-line">
                        <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div> 
                        @endif
                    @endif

                    @if($filter == "price3")
                        @if($searchResult->totalPrice > 200 && $searchResult->totalPrice <= 300) <hr class="search-separate-line">
                        <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div>  
                        @endif
                    @endif

                    @if($filter == "price4")
                        @if($searchResult->totalPrice > 300 && $searchResult->totalPrice <= 400) <hr class="search-separate-line">
                        <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div>  
                        @endif
                    @endif

                    @if($filter == "price5")
                        @if($searchResult->totalPrice > 400 && $searchResult->totalPrice <= 500) <hr class="search-separate-line">
                        <hr class="search-separate-line">
                        <div class="search-result">
                            <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                            <div>
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
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
                                <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                                <p><span class="search-bold">Foods:</span></p>
                                @foreach($searchResult->foods as $food)
                                <p>{{$food->name}}</p>
                                @endforeach
                                <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                            </div>
                        </div>
                        @endif
                    @endif
                @endforeach
            @else
            <!-- if no result found -->
            <div class="search-header">
                <h1>Search results for {{$search}}</h1>
                <p>No result found, please try another keyword</p>
            </div>
            @endif
        @else
        <!-- if no filter -->
            <!-- calculate number of result found -->
            @php
                $count = 0;
                foreach($listItems as $searchItem){
                $count++;
                }
            @endphp

            <!-- if have result found -->
            @if($count > 0)
                <div class="search-header">
                    <h1>Search results for {{$search}}</h1>
                    <p>Total {{$count}} menu found</p>
                </div>
                @foreach ($listItems as $searchResult)
                    <hr class="search-separate-line">
                    <div class="search-result">
                        <img class="search-img" src="{{ asset($searchResult->imagePath) }}" alt="image">
                        <div>
                            <p><span class="search-bold">Menu name:</span> {{$searchResult->name}}</p>
                            <p><span class="search-bold">Foods:</span></p>
                            @foreach($searchResult->foods as $food)
                            <p>{{$food->name}}</p>
                            @endforeach
                            <p><span class="search-bold">Price:</span> RM {{$searchResult->totalPrice}}</p>
                        </div>
                    </div>
                @endforeach
            @else
            <!-- if no result found -->
            <div class="search-header">
                <h1>Search results for {{$search}}</h1>
                <p>No result found, please try another keyword</p>
            </div>
            @endif
        @endif
    </div>
</div>
@endsection