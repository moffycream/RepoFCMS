<header>
    <div>
        <a class="logo" href="{{url('/')}}"><img class src="{{ asset('images/logo.png') }}" alt="logo"><span class="logo-text">Food Edge</span></a>
        <nav>
            <ul>
                <!--Change header options based on session-->
                @if (Session::get('accountType') == "DefaultAdmin" || Session::get('accountType') == "Admin")
                <li><a href="{{url('admin-dashboard')}}">Dashboard</a></li>
                <li><a href="{{url('business-analytics')}}">Menu</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>

                @elseif (Session::get('accountType') == "OperationTeam")
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('op-orders')}}">Orders</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>

                @elseif (Session::get('accountType' == "Customer"))
                <li><a href="{{url('/')}}">Dashboard</a></li>
                <li><a href="{{url('display-menu')}}">Menu</a></li>
                <li><a href="{{url('customer-orders')}}">Orders</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>

                @else
                <li><a href="{{url('login')}}">Login</a></li>
                @endif
            </ul>
        </nav>
        <form method="get" action="#" class="search-bar">
            <input type="text" name="search-bar" placeholder="Search...">
            <button type="submit" title="search"><i class="fas fa-search"></i>
        </form>
    </div>
</header>

<!--<a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Royyan Wijaya - Flaticon</a>-->