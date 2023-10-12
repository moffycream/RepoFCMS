<header>
    <div class="admin-dashboard-container hidden" id="admin-dashboard-container-expand">
        <img id="admin-dashboard-minimize-icon" src="{{ asset('images/minimize-icon.png') }}" alt="logo">

        <!-- Default admin can't edit profile -->
        <p>Account</p>
        @if (Session::get('accountType') == "Admin")
        <a href="{{url('admin-edit-profile')}}"><img class="admin-dashboard-icon" src="{{ asset('images/edit-profile.png') }}" alt="icon"><span>Edit Profile</span></a>
        @endif
        <a href="{{url('admin-register')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-profile.png') }}" alt="icon"><span>Create New Profile</span></a>
        <hr class="admin-dashboard-line">

        <p>Business</p>
        <a href="{{url('business-analytics')}}"><img class="admin-dashboard-icon" src="{{ asset('images/business-analytic.png') }}" alt="icon"><span>Business analytics</span></a>
        <hr class="admin-dashboard-line">

        <p>Menu</p>
        <a href="{{url('add-menu')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-menu.png') }}" alt="icon"><span>Add menu</span></a>
        <a href="{{url('add-food')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-food.png') }}" alt="icon"><span>Add food</span></a>

        <a href="{{url('logout')}}"><img class="admin-dashboard-icon" src="{{ asset('images/logout.png') }}" alt="icon"><span>Logout</span></a>
    </div>

    <div class="admin-dashboard-container" id="admin-dashboard-container-minimize">
        <img id="admin-dashboard-expand-icon" src="{{ asset('images/expand-icon.png') }}" alt="logo">
       
        <!-- Default admin can't edit profile -->
        <p>Account</p>
        @if (Session::get('accountType') == "Admin")
        <a href="{{url('admin-edit-profile')}}"><img class="admin-dashboard-icon" src="{{ asset('images/edit-profile.png') }}" alt="icon"></a>
        @endif
        <a href="{{url('admin-register')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-profile.png') }}" alt="icon"></a>
        <hr class="admin-dashboard-line">

        <p>Business</p>
        <a href="{{url('business-analytics')}}"><img class="admin-dashboard-icon" src="{{ asset('images/business-analytic.png') }}" alt="icon"></a>
        <hr class="admin-dashboard-line">

        <p>Menu</p>
        <a href="{{url('add-menu')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-menu.png') }}" alt="icon"></a>
        <a href="{{url('add-food')}}"><img class="admin-dashboard-icon" src="{{ asset('images/add-food.png') }}" alt="icon"></a>

        <a href="{{url('logout')}}"><img class="admin-dashboard-icon" src="{{ asset('images/logout.png') }}" alt="icon"></a>
    </div>
</header>