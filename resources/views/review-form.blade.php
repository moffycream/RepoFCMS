<div class="review-form-panel">
    <h1>Let us know what your think!</h1>
    <a href="{{route('reviews')}}"><i class="fas fa-times"></i></a>
    <form method="post" action="{{ route('review.submit') }}">
        @csrf
        <p>Category *</p>
        <select id="category" name="reviewCategory">
            <option value="" disabled selected>Select a category</option>
            <option value="food">Food</option>
            <option value="service">Service</option>
            <option value="delivery">Delivery</option>
            <option value="others">Others</option>
        </select>
        <!-- Give warning if not select -->
        @error('reviewCategory')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <p>Your overall rating *</p>
        <div class="container-stars">
            @for ($i = 1; $i <= 5; $i++) <input type="radio" id="{{ $i }}" name="reviewRating" value="{{ $i }}" {{ old('reviewRating') == $i ? 'checked' : '' }}>
                <label for="{{ $i }}"><i class="fas fa-star"></i></label>
                @endfor
        </div>
        <!-- Give warning if not select -->
        @error('reviewRating')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <p>Title of your review *</p>
        <input type="text" id="title" name="reviewTitle" value="{{ old('reviewTitle') }}" placeholder="Title of your review">
        <!-- Give warning if not filled in -->
        @error('reviewTitle')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <p>Your review *</p>
        <textarea id="review" name="reviewContent" placeholder="Your review">{{ old('reviewContent') }}</textarea>
        <!-- Give warning if not filled in -->
        @error('reviewContent')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button>Submit</button>
    </form>
</div>