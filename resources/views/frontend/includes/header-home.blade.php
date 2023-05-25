<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
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
                <li><a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('loker') }}" class="{{ request()->is('loker') ? 'active' : '' }}">Pekerjaan</a>
                </li>
                @auth
                    <li><a href="{{ route('wishlist') }}" class="{{ request()->is('wishlist') ? 'active' : '' }}">Daftar
                            Keinginan</a></li>
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

            </ul>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2 data-aos="fade-up">COLLANCER</h2>
                <p data-aos="fade-up" data-aos-delay="100">College Freelancer</p>

                <form action="{{ route('filter-freelance') }}" class="form-search d-flex align-items-stretch mb-3"
                    data-aos="fade-up" data-aos-delay="200" method="GET">
                    <input type="text" class="form-control" placeholder="Search freelance" name="search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

            </div>

            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{ asset('templates/frontend') }}/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0"
                    alt="">
            </div>

        </div>
    </div>
</section><!-- End Hero Section -->
