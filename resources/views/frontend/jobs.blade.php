@extends('frontend.layout')
@section('content')
    <main id="main">
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">

            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Daftar pekerjaan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <div class="widget-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="widget-content widget-categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('filter-kategori', $category->id) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        @forelse ($jobs as $job)
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('detailLoker', $job->id) }}">
                                            <img src="{{ asset('storage/jobs/' . $job->photo) }}" class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('detailLoker', $job->id) }}">{{ $job->name }}</a></h3>
                                        <div class="product-price">
                                            <span class="text-muted">Kategori : {{ $job->category->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @include('frontend.includes.404')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
