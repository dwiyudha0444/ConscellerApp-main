<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route('home') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">COLLANCER </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle"
                    src="{{ Auth::user()->photo ? asset('storage/users/' . Auth::user()->photo) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                    alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>{{ Auth::user()->roles }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}"
                class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            @if (Auth::user()->roles == 'admin')
                <a href="{{ route('category.index') }}"
                    class="nav-item nav-link {{ request()->is('category*') ? 'active' : '' }}"><i
                        class="bi bi-tags me-2"></i>Category</a>
                <a href="{{ route('jobs.index') }}"
                    class="nav-item nav-link {{ request()->is('jobs*') ? 'active' : '' }}"><i
                        class="bi bi-briefcase me-2"></i></i>Jobs</a>
                <a href="{{ route('users.index') }}"
                    class="nav-item nav-link {{ request()->is('users*') ? 'active' : '' }}"><i
                        class="bi bi-people-fill me-2"></i>Users</a>
            @endif
            @if (Auth::user()->roles === 'client')
                <a href="{{ route('jobs.index') }}"
                    class="nav-item nav-link {{ request()->is('jobs*') ? 'active' : '' }}"><i
                        class="bi bi-briefcase me-2"></i></i>Jobs</a>
            @endif
            @if (Auth::user()->roles === 'freelance')
                <a href="{{ route('portofolio.index') }}"
                    class="nav-item nav-link {{ request()->is('portofolio*') ? 'active' : '' }}"><i
                        class="bi bi-clipboard me-2"></i></i>Portofolio</a>
                <a href="{{ route('experience.index') }}"
                    class="nav-item nav-link {{ request()->is('experience*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge-fill me-2"></i>Experience
                </a>
            @endif

            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Buttons</a>
                    <a href="typography.html" class="dropdown-item">Typography</a>
                    <a href="element.html" class="dropdown-item">Other Elements</a>
                </div>
            </div> --}}
        </div>
    </nav>
</div>
