<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .dashboard {
            text-align: center;
            padding: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>

    <div class="dashboard">
        <h1>Welcome to the Admin Dashboard</h1>
        <a href="{{url('admin-edit-profile')}}" class="btn">Edit Profile</a>
        <a href="{{url('admin-register')}}" class="btn">Register New Profile</a>
        <a href="/profile/business-analytics" class="btn">Business Analytics</a>
        <a href="{{route('logout')}}" class="btn">Logout</a>
    </div>
</body>

</html>