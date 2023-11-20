<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<article>
    <h1 class="title">Profile</h1>
    <div class="profile-container">
            <div class="profile-img">
                <img src="images/profile.png" alt="profile default image">
            </div>
                <table class="profile-table">
                    <tr>
                        <th colspan="2" class="user-info">User Information</th>
                    </tr>
                   
                    <tr>
                        <th>UserID</th>
                        <td>{{ $user->userID }}</td>
                    </tr>

                    <tr>
                        <th>Username</th>
                        <td>{{$user->username}}</td>
                    </tr>

                    <tr>
                        <th>Phone Number</th>
                        <td>{{$user->phone}}</td>
                    </tr>

                    <tr>
                        <th>First Name</th>
                        <td>{{$user->firstName}}</td>
                    </tr>

                    <tr>
                        <th>Last Name</th>
                        <td>{{$user->lastName}}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>
                        {{$user->email}}
                        </td>
                    </tr>

                    <tr>
                        <th>Street Address</th>
                        <td>
                        {{$user->streetAddress}}
                        </td>
                    </tr>

                    <tr>
                        <th>City</th>
                        <td>
                        {{$user->city}}
                        </td>
                    </tr>

                    <tr>
                        <th>Postcode</th>
                        <td>
                        {{$user->postcode}}
                        </td>
                    </tr>
             
                </table>
            </div>
        </div>
    </article>
@include ('include/footer')
</html>

<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->