<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<article>

        

    <h1 class="profile-h1">Profile</h1>
    <div class="profile-container">
            <div class="profile-img">
                <img src="images/profile.png" alt="profile default image">
            </div>
                <table class="profile-table">
                    <tr>
                        <th colspan="2" class="user-info">User Information</th>
                    </tr>
                    @foreach($listItems as $accounts)
                    <tr>
                        <th>UserID</th>
                        <td>{{$accounts->userID}}</td>
                    </tr>

                    <tr>
                        <th>Username</th>
                        <td>{{$accounts->username}}</td>
                    </tr>

                    <tr>
                        <th>Phone Number</th>
                        <td>{{$accounts->phone}}</td>
                    </tr>

                    <tr>
                        <th>First Name</th>
                        <td>{{$accounts->firstName}}</td>
                    </tr>

                    <tr>
                        <th>Last Name</th>
                        <td>{{$accounts->lastName}}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>
                        {{$accounts->email}}
                        </td>
                    </tr>

                    <tr>
                        <th>Street Address</th>
                        <td>
                        {{$accounts->streetAddress}}
                        </td>
                    </tr>

                    <tr>
                        <th>City</th>
                        <td>
                        {{$accounts->city}}
                        </td>
                    </tr>

                    <tr>
                        <th>Postcode</th>
                        <td>
                        {{$accounts->postcode}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </article>
@include ('include/footer')
</html>

<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->