@extends('layouts.app')
@section('title', 'Review Form')
@section('content')

<div class="container-review-form">
    <div class="panel">
        <h1>Let us know what your think!</h1>
        <form method="post" action="{{ route('review.submit') }}">
            @csrf

            @php
            $oldCategory_1 = old('reviewCategory') === 'food' ? 'selected' : '';
            $oldCategory_2 = old('reviewCategory') === 'service' ? 'selected' : '';
            $oldCategory_3 = old('reviewCategory') === 'delivery' ? 'selected' : '';
            $oldCategory_4 = old('reviewCategory') === 'others' ? 'selected' : '';
            @endphp
            <div class="row">
                <p>Category *</p>
                <select id="category" name="reviewCategory">
                    <option value="" disabled selected>Select a category</option>
                    <option value="food" {{$oldCategory_1}}>Food</option>
                    <option value="service" {{$oldCategory_2}}>Service</option>
                    <option value="delivery" {{$oldCategory_3}}>Delivery</option>
                    <option value="others" {{$oldCategory_4}}>Others</option>
                </select>
                @if ($errors->has('reviewCategory'))
                <span class="error">{{ $errors->first('reviewCategory') }}</span>
                @endif
            </div>

            <div class="row">
                <p>Your overall rating *</p>
                <div class="container-stars">
                    @for ($i = 5; $i >= 1; $i--)
                    @php
                    $oldRating = old('reviewRating') == $i ? 'checked' : '';
                    @endphp
                    <input type="radio" id="{{ $i }}" name="reviewRating" value="{{ $i }}" {{$oldRating}}>
                    <label for="{{ $i }}"><i class="fas fa-star"></i></label>
                    @endfor
                </div>
                @if ($errors->has('reviewRating'))
                <span class="error">{{ $errors->first('reviewRating') }}</span>
                @endif
            </div>

            <div class="row">
                <p>Title of your review *</p>
                <input type="text" id="title" name="reviewTitle" value="{{old('reviewTitle')}}" placeholder="Title of your review">
                @if ($errors->has('reviewTitle'))
                <span class="error">{{ $errors->first('reviewTitle') }}</span>
                @endif
            </div>

            <div class="row">
                <p>Your review *</p>
                <textarea id="review" name="reviewContent" placeholder="Your review" >{{old('reviewContent')}}</textarea>
                @if ($errors->has('reviewContent'))
                <span class="error">{{ $errors->first('reviewContent') }}</span>
                @endif
            </div>

            <div class="row-action">
                <a href="{{route('reviews')}}">Cancel</a>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection