<header id="header" class="header d-flex align-items-center fixed-top bg-light">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('templates/frontend') }}/img/logo-bg.png" height="200px" alt="">
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                @if (request()->is('wishlist'))
                    <li><a href="{{ route('home') }}"
                            class="nav-item nav-link {{ request()->is('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('wishlist') }}"
                            class="nav-item nav-link {{ request()->is('wishlist') ? 'active' : '' }}">Daftar
                            Keinginan</a></li>
                    <li><a href="{{ route('loker') }}"
                            class="nav-item nav-link {{ request()->is('loker') ? 'active' : '' }}">Pekerjaan</a></li>
                    @auth
                        <li class="dropdown"><a href="#"><i class="fa-regular fa-user fa-2xl"></i></a>
                            <ul>
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li><a class="get-a-quote" href="{{ route('login') }}">MASUK</a></li>
                        <li class="dropdown"><a href="#" class="get-a-quote"><span>DAFTAR</span></i></a>
                            <ul>
                                <li><a href="{{ route('register-client') }}">Daftar Sebagai Klien</a></li>
                                <li><a href="{{ route('register-freelance') }}">Daftar Sebagai Freelancer</a></li>
                            </ul>
                        </li>
                    @endguest
                @else
                    <li>
                        <form action="{{ route('filterJobs') }}" class="search" method="GET">
                            <div class="input-group w-100">
                                <input type="text" name="search" class="form-control" placeholder="Search jobs">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li><a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li><a href="{{ route('loker') }}" class="{{ request()->is('loker') ? 'active' : '' }}">Info
                            Pekerjaan</a>
                    </li>
                    @auth
                        <li><a href="{{ route('wishlist') }}"
                                class="{{ request()->is('wishlist') ? 'active' : '' }}">Daftar Keinginan</a></li>
                        <li class="dropdown"><a href="#"><i class="fa-regular fa-user fa-2xl"></i></a>
                            <ul>
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li><a class="get-a-quote" href="{{ route('login') }}">Masuk</a></li>
                        <li class="dropdown"><a href="#" class="get-a-quote"><span>Daftar</span></i></a>
                            <ul>
                                <li><a href="{{ route('register-client') }}">Daftar Sebagai Klien</a></li>
                                <li><a href="{{ route('register-freelance') }}">Daftar Sebagai Freelancer</a></li>
                            </ul>
                        </li>
                    @endguest
                @endif

            </ul>
        </nav><!-- .navbar -->
    </div>
</header>
