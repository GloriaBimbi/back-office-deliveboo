<header class="border-bottom">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/' . 'Delivebootitle.png') }}" alt="" style="width: 64px" href="#">
            </a>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-end" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto d-flex gap-2">
                    @auth
                        <li class="nav-item my-2">
                            <a class="button" @class(['nav-link', 'active' => Route::currentRouteName() == 'home']) aria-current="page"
                                href="{{ route('home') }}">Home</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link button" aria-current="page" href="http://localhost:5173/">Order</a>
                        </li>
                    </ul>
                @else
                    {{-- dropdown list validated  --}}
                    {{-- <ul class="list-group list-group-flush"> --}}
                    {{-- dropdown text --}}
                    <li class="nav-item dropdown text-end button py-0 ms-auto">
                        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle ms-2 my-2 text-white"
                            data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button">
                            <i class="fa-solid fa-user text-white"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="{{ route('admin.dashboard') }}">
                                    Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ url('profile') }}"> Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" id="logout-link">
                                    Logout
                                </a></li>
                        </ul>

                        {{-- dropdown  --}}
                        <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-end  homedropdown">
                            <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                    {{-- </ul> --}}
                @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
