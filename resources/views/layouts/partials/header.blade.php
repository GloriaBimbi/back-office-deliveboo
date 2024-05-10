<header class="border-bottom">
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="nav-logo-wrapper mx-5">
                <img src="{{ asset('storage/' . 'Delivebootitle.png') }}" alt="" style="width: 20%" href="#">
            </div>

            <div class="nav-right">
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler " data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
                    type="button">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav my-2 mb-lg-0  d-flex gap-2 align-items-center">
                        {{-- key home restaurants dishes --}}
                        @auth
                            <li class="nav-item">
                                <a class=" home-btn" @class(['nav-link', 'active' => Route::currentRouteName() == 'home']) aria-current="page"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a class="home-btn" class="nav-link" href="http://localhost:5173/">Order</a>
                        </li>
                        @endguest
                        {{-- @auth
                            <li class="nav-item">
                                <a class="nav-link badge bordered p-3 " @class([
                                    'nav-link',
                                    'active' => Route::currentRouteName() == 'admin.restaurants.index',
                                ]) aria-current="page"
                                    href="{{ route('admin.restaurants.index') }}">Restaurants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link badge bordered p-3" @class([
                                    'nav-link',
                                    'active' => Route::currentRouteName() == 'admin.dishes.index',
                                ]) aria-current="page"
                                    href="{{ route('admin.dishes.index') }}">Dishes</a>
                            </li>
                        @endauth --}}
                        @guest
                            {{-- tasto login e register  --}}
                            {{-- <li class="nav-item">
                                    <a class="nav-link badge bordered p-3 " href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item ">
                                        <a class="nav-link badge bordered p-3 " href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif --}}
                        </ul>
                    @else
                        {{-- dropdown list validated  --}}
                        <ul class="list-group list-group-flush">
                            {{-- dropdown text --}}
                            <li class="ms-2  dropdown text-end list-group-item homedropdown dropdown-button dropdown-btn">
                                <a aria-expanded="false" aria-haspopup="true" class=" dropdown-toggle "
                                    data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button">
                                    <i class="fa-solid fa-user me-2 text-white"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                {{-- dropdown  --}}
                                <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-end  homedropdown">
                                    <a class="dropdown-item homedropdown hovered" href="{{ route('admin.dashboard') }}">
                                        Dashboard</a>
                                    <a class="dropdown-item homedropdown hovered" href="{{ url('profile') }}"> Profile</a>
                                    <a class="dropdown-item homedropdown hovered" href="{{ route('logout') }}"
                                        id="logout-link">
                                        Logout
                                    </a>

                                    <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
