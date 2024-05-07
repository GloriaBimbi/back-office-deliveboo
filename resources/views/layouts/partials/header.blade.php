<header class="border-bottom">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid mx-5">
            <img src="{{ asset('storage/' . 'Delivebootitle.png') }}" alt="" style="width: 10%" href="#">
            <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse"
                type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-5">
                        <a class="nav-link badge bordered p-3" @class(['nav-link', 'active' => Route::currentRouteName() == 'home']) aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link badge bordered p-3 me-5" @class([
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
                    @endauth
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link badge bordered p-3 me-3" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link badge bordered p-3 me-3" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                </div>
            @else
            </div>
            <div class="text-end">
                <ul class="list-group list-group-flush">
                    <li class="nav-item dropdown text-end list-group-item homedropdown">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle homedropdown"
                            data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right homedropdown">
                            <a class="dropdown-item homedropdown hovered" href="{{ route('admin.dashboard') }}"> Dashboard</a>
                            <a class="dropdown-item homedropdown hovered" href="{{ url('profile') }}"> Profile</a>
                            <a class="dropdown-item homedropdown hovered" href="{{ route('logout') }}" id="logout-link">
                                Logout
                            </a>

                            <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
</header>
