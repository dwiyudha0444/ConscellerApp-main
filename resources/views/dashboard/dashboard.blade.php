@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @if (Auth::user()->roles === 'admin')
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">User</p>
                            <h6 class="mb-0">{{ $users }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Kategori</p>
                            <h6 class="mb-0">{{ $category }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-briefcase fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Postingan jobs</p>
                            <h6 class="mb-0">{{ $jobs }}</h6>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->roles === 'client' || Auth::user()->roles === 'freelance')
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-clipboard fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Portofolio</p>
                            <h6 class="mb-0">{{ $portofolio }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-user-cog fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Experience</p>
                            <h6 class="mb-0">{{ $experience }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center p-3">
                        <i class="fa fa-briefcase fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Postingan jobs</p>
                            <h6 class="mb-0">{{ $jobs }}</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row bg-dark">
                <div class="col-sm-7">
                    <div class="mt-3">
                        <div class="card bg-dark mt-5">
                            <div class="card-body">
                                <h2 class="card-title text-primary">Selamat datang, {{ Auth::user()->name }}</h2>
                                <h4>
                                    Silahkan kelola halaman anda sesuai role yang anda miliki yaitu :
                                    {{ Auth::user()->roles }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('templates/img/hello-page.gif') }}" height="300" alt="View Badge User">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
