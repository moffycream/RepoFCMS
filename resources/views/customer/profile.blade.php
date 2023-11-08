@extends('layouts.customer')
@section('title', 'Profile')
@section('content')
<h1 class="title">Profile</h1>
<div class="profile-container">
    <table class="profile-table">
        <div>
            <form method="POST" action="{{route('profile.edit')}}" class="profile-form" enctype="multipart/form-data">
                @csrf
                <tr>
                    <th></th>
                    <td>
                        <!-- Profile Picture -->
                        <div class="profile-img">
                            <img src="{{ asset($user->imagePath) }}" alt="profileimage">
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <td class="edit-profile-td">
                        @if(isset($imageErrormsg))
                        <p class="profile-error-msg">{!! $imageErrormsg !!}</p>
                        @endif
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <input type="file" accept=".png, .jpeg, .jpg" name="image" class="image">
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i> Cancel</button>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3" class="user-info">User Information</th>
                </tr>
                <tr>
                    <th>UserID</th>
                    <td><input type="hidden" name="userID" value="{{$user->userID}}">{{$user->userID}}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <span class="profile-attribute">{{ $user->username }}</span>
                        <input type="text" class="profile-Attribute" name="username" value="{{ $user->username }}">
                        @if(isset($usernameErrorMsg))
                        <p class="profile-error-msg">{!! $usernameErrorMsg !!}</p>
                        @endif
                    </td>
                    <td class="profile-edit-text">
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i> Cancel</button>
                    </td>

                </tr>

                <tr>
                    <th>Phone Number</th>
                    <td>
                        <span class="profile-attribute"> {{$user->phone}}</span>
                        <input type="text" class="profile-Attribute" name="phone" value="{{ $user->phone }}">
                        @if(isset($phoneErrormsg))
                        <p class="profile-error-msg">{!! $phoneErrormsg !!}</p>
                        @endif
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td>
                        <span class="profile-attribute"> {{$user->firstName}}</span>
                        <input type="text" class="profile-Attribute" name="first" value="{{ $user->firstName }}">
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td>
                        <span class="profile-attribute"> {{$user->lastName}}</span>
                        <input type="text" class="profile-Attribute" name="last" value="{{ $user->lastName }}">
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>
                        <span class="profile-attribute"> {{$user->email}}</span>
                        <input type="text" class="profile-Attribute" name="email" value="{{ $user->email }}">

                        @if(isset($emailErrormsg))
                        <p class="profile-error-msg">{!! $emailErrormsg !!}</p>
                        @endif
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>Street Address</th>
                    <td>
                        <span class="profile-attribute"> {{$user->streetAddress}}</span>
                        <input type="text" class="profile-Attribute" name="streetAddress" value="{{ $user->streetAddress }}">
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>City</th>
                    <td>
                        <span class="profile-attribute"> {{$user->city}}</span>
                        <input type="text" class="profile-Attribute" name="city" value="{{ $user->city }}">
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i></i> Cancel</button>
                    </td>
                </tr>

                <tr>
                    <th>Postcode</th>
                    <td>
                        <span class="profile-attribute"> {{$user->postcode}}</span>
                        <input type="text" class="profile-Attribute" name="postcode" value="{{ $user->postcode }}">
                        @if(isset($postcodeErrormsg))
                        <p class="profile-error-msg">{!! $postcodeErrormsg !!}</p>
                        @endif
                    </td>
                    <td class=profile-edit-text>
                        <a class="edit-button"><i class="far fa-edit"></i> Edit</a>
                        <button type="submit" class="save-button"><i class="fas fa-save"></i> Save</button>
                        <button type="submit" class="cancel-button" name="cancel"><i class="far fa-window-close"></i></i> Cancel</button>
                    </td>
                </tr>
                <tr>
                    <th>2 Factor Authentication</th>
                    <td>
                        @if($user->twoFactorAuth == 1)
                        <span class="profile-attribute"> Enabled</span>
                        @else
                        <span class="profile-attribute"> Disabled</span>
                        @endif
                    </td>
                    <td class=profile-edit-button>
                        <input type="hidden" name="twoFactorAuth" value="{{ $user->twoFactorAuth }}">
                        <button type="submit" class="toggle-button" onclick="toggle2FA()">Toggle</button>
                    </td>
                </tr>
        </div>
    </table>
</div>
</div>
@endsection


<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->