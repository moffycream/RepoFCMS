@extends('layouts.app')
@section('title', 'Feedback')
@section('content')
<div class="container-feedback-page">
    <div class="box-feedback-page">
        <h1>Help us Improve</h1>
        <p>We always appreciate feedback</p>
        <form id="feedback-form" method="post" action="{{route('user.feedback')}}">
            @csrf
            <div class="feedback-box">
                <div class="feedback-box-columns">
                    <div class="feedback-left-column">
                        <h2>General Info</h2>
                        <p>Let us know who you are</p>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" value="{{isset($_POST['firstname']) ? $_POST['firstname'] : ''}}" required>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="{{isset($_POST['lastname']) ? $_POST['lastname'] : ''}}" required>
                        <input type="email" name="email" id="email" placeholder="Email" value="{{isset($_POST['email']) ? $_POST['email'] : ''}}" required>
                        <!-- print out error message for email -->
                        @if (isset($emailErrorMsg))
                        <p class="feedback-error-msg">{!! $emailErrorMsg !!}</p>
                        @endif
                        <input type="text" name="phone" id="phone" placeholder="Phone number" value="{{isset($_POST['phone']) ? $_POST['phone'] : ''}}" required>
                        <!-- print out error message for phone -->
                        @if (isset($phoneErrorMsg))
                        <p class="feedback-error-msg">{!! $phoneErrorMsg !!}</p>
                        @endif
                    </div>

                    <div class="feedback-right-column">
                        <h2>Feedback</h2>
                        <p>Rate us!</p>
                        <div class="rating-stars">
                            <i class="fas fa-star star" data-star="1"></i>
                            <i class="fas fa-star star" data-star="2"></i>
                            <i class="fas fa-star star" data-star="3"></i>
                            <i class="fas fa-star star" data-star="4"></i>
                            <i class="fas fa-star star" data-star="5"></i>
                        </div>
                        <div class="rating-slider">
                            <input type="range" name="rating" id="rating" min="1" max="5" value="{{isset($_POST['rating']) ? $_POST['rating'] : '3'}}" step="1">
                        </div>

                        <select name="typeoffeedback" id="typeoffeedback">
                            @php
                            $selectedGeneral = "";
                            $selectedCompliment = "";
                            $selectedComplaint = "";
                            $selectedSuggestion = "";

                            if (isset($_POST['typeoffeedback'])) {
                            if ($_POST['typeoffeedback'] == "General") {
                            $selectedGeneral = "selected";
                            } elseif ($_POST['typeoffeedback'] == "Compliment") {
                            $selectedCompliment = "selected";
                            } elseif ($_POST['typeoffeedback'] == "Complaint") {
                            $selectedComplaint = "selected";
                            } elseif ($_POST['typeoffeedback'] == "Suggestion") {
                            $selectedSuggestion = "selected";
                            }
                            }
                            @endphp
                            <option value="none" disable selected>Type of feedback</option>
                            <option value="General" {{$selectedGeneral}}>General</option>
                            <option value="Compliment" {{$selectedCompliment}}>Compliment</option>
                            <option value="Complaint" {{$selectedComplaint}}>Complaint</option>
                            <option value="Suggestion" {{$selectedSuggestion}}>Suggestion</option>
                        </select>
                        <!-- print out error message for type of feedback -->
                        @if (isset($typeOfFeedbackErrorMsg))
                        <p class="feedback-error-msg">{!! $typeOfFeedbackErrorMsg !!}</p>
                        @endif

                        <textarea name="comments" id="comments" placeholder="Tell us how we can improve, or any other thoughts you wish to share" required>{{isset($_POST['comments']) ? $_POST['comments'] : ''}}</textarea>
                    </div>
                </div>
            </div>
            <h3>We really appreciate it!</h3>
            <button class="feedback-submit-button" type="submit">Submit</button>
        </form>
    </div>
</div>

@endsection