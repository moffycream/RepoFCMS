<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<article class="Profile Content">
        <h1 class="Profile_H1">Profile</h1>
        <div class="Profile Container">
            <div class="my_info">
                <img src="images/profile" alt="profile default image">

                <table class="Profile_Table">
                    <tr>
                        <th colspan="2" id>Name</th>
                    </tr>

                    <tr>
                        <th>Username</th>
                        <td></td>
                    </tr>

                    <tr>
                        <th>Phone Number</th>
                        <td></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>
                        </td>
                    </tr>

                    <tr>
                        <th>Gender</th>
                        <td>
                        </td>
                    </tr>

                    <tr>
                        <th>Birthday</th>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
@include ('include/footer')
</html>