<nav class="navbar navbar-expand-md navbar-dark bg-dark h-100">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">Boolfolio</a>

        <!-- hamburger menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa-solid fa-globe me-1"></i>
                        Sito pubblico
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    @if (Route::has('register'))

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>

                    @endif

                @else

                    <li>
                        <form  action="{{route('admin.projects.index')}}" method="GET">
                            @csrf
                            <input class="form-control d-inline-block w-50" name="search" type="text" placeholder="Cosa cerchi?">
                            <button class="btn btn-primary" type="submit">Cerca per titolo</button>
                        </form>

                    </li>

                    <!-- logout -->
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
