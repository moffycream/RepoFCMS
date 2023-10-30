<header>
    <div>
        <a class="logo" href="{{url('/')}}"><img class src="{{ asset('images/logo.png') }}" alt="logo"><span class="logo-text">Food Edge</span></a>
        <nav>
            <ul>  
                @if(Session::get('accountType') == "Guest" || Session::get('accountType') == "Customer")
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('display-food-menu')}}">Menu</a></li>
                <li><a href="{{url('customer-orders')}}">Orders</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li><a href="{{url('profile')}}">Profile</a></li>
                @endif
            </ul>
        </nav>
        <div>
            @if (Session::get('accountType') == "Customer" || (Session::get('accountType') == "OperationTeam"))
            <div class="notification">
                <i class="fas fa-bell" onclick="toggleNotification()"></i>
                @if($notifications->count() > 0)
                <span class="indicator">{{$notifications->count()}}</span>
                @endif
                <div class="container-notification" id="container-notification">
                    <div class="arrow"></div>
                    <div class="col-notification">
                        @if($notifications->count() == 0)
                        <h2>No new notifications</h2>
                        @else
                        <h2>Notifications</h2>
                        @endif
                    </div>
                    @foreach($notifications as $notification)
                    @if($notification->isRead == false)
                    <div class="row-notification">
                        <p>{{$notification->content}}</p>
                        <form method="POST" action="{{route('mark-notification-as-read', $notification->notificationID) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit">
                                <i class="fas fa-times" title="mark as read"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            <div class="login">
                <i class="fas fa-user-circle" onclick="toggleHeaderLogin()"></i></i>
                <div class="container-header-login" id="container-header-login">
                    @if (Session::get('accountType') == "Customer" || Session::get('accountType') == "DefaultAdmin" || Session::get('accountType') == "Admin" || Session::get('accountType') == "OperationTeam" )
                    <div class="row-header-login">
                        <p>{{Session::get('username')}}</p>
                        <a class="logout" href="{{url('logout')}}">Logout</a>
                    </div>

                    <div class="row-header-login">
                        <a class="profile" href="{{url('profile')}}">My profile</a>
                    </div>
                    @else
                    <div class="row-need-login">
                        <a class="login" href="{{url('login')}}">Login</a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- <form method="get" action="#" class="search-bar">
            <input type="text" name="search-bar" placeholder="Search...">
            <button type="submit" title="search"><i class="fas fa-search"></i>
        </form> --}}
        </div>
</header>

{{--<a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Royyan Wijaya - Flaticon</a>--}}