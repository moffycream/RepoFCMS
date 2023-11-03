@extends('layouts.admin')
@section('title', 'View Feedback')
@section('content')
<div class="container-admin-view-feedback">
    <h1>View Feedbacks</h1>
    <p>Filter the viewback based on what you want</p>
    <!-- drop down menu to select which filter to choose -->
    <form method="post" action="{{route('admin.filter.feedback')}}">
        @csrf
        <select name="filter" id="filter">
            @php
            $selectedFeedbackID = "";
            $selectedRating = "";
            $selectedGeneral = "";
            $selectedCompliment = "";
            $selectedComplaint = "";
            $selectedSuggestion = "";
            $selectedAsc = "";
            $selectedDesc = "";

            if (isset($_POST['filter'])) {
            if ($_POST['filter'] == "feedbackID") {
            $selectedFeedbackID = "selected";
            } elseif ($_POST['filter'] == "rating") {
            $selectedRating = "selected";
            } elseif ($_POST['filter'] == "General") {
            $selectedGeneral = "selected";
            } elseif ($_POST['filter'] == "Compliment") {
            $selectedCompliment = "selected";
            } elseif ($_POST['filter'] == "Complaint") {
            $selectedComplaint = "selected";
            } elseif ($_POST['filter'] == "Suggestion") {
            $selectedSuggestion = "selected";
            }
            }

            if (isset($_POST['order'])) {
            if ($_POST['order'] == "asc") {
            $selectedAsc = "selected";
            } elseif ($_POST['order'] == "desc") {
            $selectedDesc = "selected";
            }
            }

            @endphp
            <option value="feedbackID" {{$selectedFeedbackID}}>Feedback ID</option>
            <option value="rating" {{$selectedRating}}>Rating</option>
            <option value="General" {{$selectedGeneral}}>General</option>
            <option value="Compliment" {{$selectedCompliment}}>Compliment</option>
            <option value="Complaint" {{$selectedComplaint}}>Complaint</option>
            <option value="Suggestion" {{$selectedSuggestion}}>Suggestion</option>
        </select>
        <select name="order" id="order" class="order-select">
            <option value="asc" {{$selectedAsc}}>Ascending</option>
            <option value="desc" {{$selectedDesc}}>Descending</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <table>
        <!-- for each type of filter, make different table -->
        @if (isset($_POST['filter']) && $_POST['filter'] == 'feedbackID')
        @if($feedbacks->isEmpty())
        <tr>
            <td colspan="3">No feedback available</td>
        </tr>
        @else
        <thead>
            <tr>
                <th scope="col">Feedback ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Rating</th>
                <th scope="col">Type of Feedback</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$feedback->feedbackID}}</td>
                <td>{{$feedback->firstName}} {{$feedback->lastName}}</td>
                <td>{{$feedback->email}}</td>
                <td>{{$feedback->phone}}</td>
                <td>
                    @for ($i = 0; $i < $feedback->rating; $i++)
                        <i class="fas fa-star star"></i>
                        @endfor
                </td>
                <td>{{$feedback->typeOfFeedback}}</td>
                <td>{{$feedback->comments}}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
        @elseif (isset($_POST['filter']) && $_POST['filter'] == 'rating')
        @if($feedbacks->isEmpty())
        <tr>
            <td colspan="3">No feedback available</td>
        </tr>
        @else
        <thead>
            <tr>
                <th scope="col">Rating</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Type of Feedback</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>
                    @for ($i = 0; $i < $feedback->rating; $i++)
                        <i class="fas fa-star star"></i>
                        @endfor
                </td>
                <td>{{$feedback->firstName}} {{$feedback->lastName}}</td>
                <td>{{$feedback->email}}</td>
                <td>{{$feedback->phone}}</td>
                <td>{{$feedback->typeOfFeedback}}</td>
                <td>{{$feedback->comments}}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
        @elseif (isset($_POST['filter']) && ($_POST['filter'] == 'General' || $_POST['filter'] == 'Compliment' || $_POST['filter'] == 'Complaint' || $_POST['filter'] == 'Suggestion'))
        @if($feedbacks->isEmpty())
        <tr>
            <td colspan="3">No feedback available for this type of comment, please try another one</td>
        </tr>
        @else
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Rating</th>
                <th scope="col">Type of Feedback</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$feedback->firstName}} {{$feedback->lastName}}</td>
                <td>
                    @for ($i = 0; $i < $feedback->rating; $i++)
                        <i class="fas fa-star star"></i>
                        @endfor
                </td>
                <td>{{$feedback->typeOfFeedback}}</td>
                <td>{{$feedback->comments}}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
        @else
        @if($feedbacks->isEmpty())
        <tr>
            <td colspan="3">No feedback available</td>
        </tr>

        @else
        <thead>
            <tr>
                <th scope="col">Feedback ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Rating</th>
                <th scope="col">Type of Feedback</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$feedback->feedbackID}}</td>
                <td>{{$feedback->firstName}} {{$feedback->lastName}}</td>
                <td>{{$feedback->email}}</td>
                <td>{{$feedback->phone}}</td>
                <td>
                    @for ($i = 0; $i < $feedback->rating; $i++)
                        <i class="fas fa-star star"></i>
                        @endfor
                </td>
                <td>{{$feedback->typeOfFeedback}}</td>
                <td>{{$feedback->comments}}</td>
            </tr>
        </tbody>
        @endforeach
        @endif
        @endif
</div>


@endsection