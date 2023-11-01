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
            <option value="feedbackID" {{ (isset($_POST['filter']) && $_POST['filter'] == 'feedbackID') ? 'selected' : '' }}>Feedback ID</option>
            <option value="rating" {{ (isset($_POST['filter']) && $_POST['filter'] == 'rating') ? 'selected' : '' }}>Rating</option>
            <option value="General" {{ (isset($_POST['filter']) && $_POST['filter'] == 'General') ? 'selected' : '' }}>General</option>
            <option value="Compliment" {{ (isset($_POST['filter']) && $_POST['filter'] == 'Compliment') ? 'selected' : '' }}>Compliment</option>
            <option value="Complaint" {{ (isset($_POST['filter']) && $_POST['filter'] == 'Complaint') ? 'selected' : '' }}>Complaint</option>
            <option value="Suggestion" {{ (isset($_POST['filter']) && $_POST['filter'] == 'Suggestion') ? 'selected' : '' }}>Suggestion</option>
        </select>
        <select name="order" id="order" class="order-select">
            <option value="asc" {{ (isset($_POST['order']) && $_POST['order'] == 'asc') ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ (isset($_POST['order']) && $_POST['order'] == 'desc') ? 'selected' : '' }}>Descending</option>
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
            @if($feedbacks->isEmpty())
            <tr>
                <td colspan="3">No feedback available</td>
            </tr>
            @else
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
            @endif
        </tbody>
        @endif
</div>


@endsection