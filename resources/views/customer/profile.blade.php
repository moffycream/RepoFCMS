@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<h1 class="title">Profile</h1>
<div class="profile-container">
    <div class="profile-img">
        <img src="images/profile.png" alt="profile default image">
    </div>
    <table class="profile-table">
        <tr>
            <th colspan="3" class="user-info">User Information</th>
        </tr>

        <tr>
            <th>UserID</th>
            <td>{{ $user->userID }}</td>
            <td></td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{$user->username}}</td>
            <td class="profile-edit-text">
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>Phone Number</th>
            <td>{{$user->phone}}</td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>First Name</th>
            <td>{{$user->firstName}}</td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>Last Name</th>
            <td>{{$user->lastName}}</td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>Email</th>
            <td>
                {{$user->email}}
            </td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>Street Address</th>
            <td>
                {{$user->streetAddress}}
            </td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>City</th>
            <td>
                {{$user->city}}
            </td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

        <tr>
            <th>Postcode</th>
            <td>
                {{$user->postcode}}
            </td>
            <td class=profile-edit-text>
                <button type="submit"><i class="far fa-edit"></i> Edit</button>
            </td>
        </tr>

    </table>
</div>
</div>
@endsection


<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->