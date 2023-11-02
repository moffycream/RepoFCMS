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


        <div>
            <form method="POST" action="{{route('profile.edit')}}" class="profile-form">
                @csrf
                <tr>
                    <th>UserID</th>

                    <td><input type="hidden" name="userID" value="{{$user->userID}}">{{$user->userID}}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <span class="profile-name">{{ $user->username }}</span>
                        <input type="text" class="profile-Attribute" name="name" value="{{ $user->username }}">
                    </td>
                    <td class="profile-edit-text">
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button">Save</button>
                    </td>
                </tr>

                <tr>
                    <th>Phone Number</th>
                    <td>{{$user->phone}}</td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td>{{$user->firstName}}</td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td>{{$user->lastName}}</td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>
                        {{$user->email}}
                    </td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>Street Address</th>
                    <td>
                        {{$user->streetAddress}}
                    </td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>City</th>
                    <td>
                        {{$user->city}}
                    </td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>

                <tr>
                    <th>Postcode</th>
                    <td>
                        {{$user->postcode}}
                    </td>
                    <td class=profile-edit-text>
                        <!-- <button type="submit"><i class="far fa-edit"></i> Edit</button> -->
                    </td>
                </tr>
        </div>
    </table>
</div>
</div>

<script>
    document.querySelectorAll('.edit-button').forEach(function(button) {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const profileName = row.querySelectorAll('.profile-name');
            const profileAttribute = row.querySelectorAll('.profile-Attribute');
            const saveButton = row.querySelector('.save-button');

            // Hide the attribute value and "Edit" button
            profileName.forEach(element => {
                element.style.display = 'none';
            });

            profileAttribute.forEach(element => {
                element.style.display = 'block';
            });

            button.style.display = 'none';
            saveButton.style.display = 'block';
        });
    });

    document.querySelectorAll('.profile-form').forEach(function(form) {
        form.addEventListener('submit', function() {
            const row = this.closest('tr');

        });
    });
</script>
@endsection


<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->