@extends('layouts.app')
@section('title', 'Review Form')
@section('content')

<div class="container-review-form">
    <div class="panel">
        <h1>Edit Comment</h1>
        <form method="post" action="{{ route('review.comment.edit.submit', $commentID) }}">
            @csrf

            <div class="row">
                <p>Your comment *</p>
                <textarea id="review" name="commentContent" placeholder="Your comment" >{{old('commentContent')}}</textarea>
                @if ($errors->has('commentContent'))
                <span class="error">{{ $errors->first('commentContent') }}</span>
                @endif
            </div>

            <div class="row-action">
                <a href="{{route('customer-review-history')}}">Cancel</a>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection