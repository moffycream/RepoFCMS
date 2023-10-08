<header>
    <div>
        <a class="logo" href="{{url('/')}}"><img class src="{{ asset('images/logo.png') }}" alt="logo"><span class="logo-text">Food Edge</span></a>
        <nav>
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('menu')}}">Menu</a></li>
                <li><a href="{{url('customer-orders')}}">Order Listing</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>
            </ul>
        </nav>
        <form method="get" action="#" class="search-bar">
            <input type="text" name="search-bar" placeholder="Search...">
            <button type="submit" title="search"><i class="fas fa-search"></i>
        </form>
    </div>
</header>

<!--<a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Royyan Wijaya - Flaticon</a>-->