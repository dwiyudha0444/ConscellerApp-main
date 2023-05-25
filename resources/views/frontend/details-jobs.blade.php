@extends('frontend.layout')
@section('content')
    <main id="main">

        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('{{ asset('templates/frontend') }}/img/page-header.jpg');">

            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Halaman Detail</li>
                        <li>{{ $data->name }}</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 flex">
                    <div class="slider-for">
                        <div>
                            <img src="{{ asset('storage/jobs/' . $data->photo) }}" alt="" width="600px">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>{{ $data->name }}</h3>
                    <p>
                        {!! $data->description !!}
                    </p>
                    <form action="{{ route('addWishlist', $data->id) }}" method="post">
                        @csrf
                        <div class="btn-group">
                            <a href="https://wa.me/62{{ $data->user->phone }}?&text=Halo saya berminat untuk pekerjaan di posisi {{ $data->name }}"
                                target="blank" class="btn btn-success me-2">Menuju Ke Whatsapp <i
                                    class="fa-brands fa-whatsapp"></i></a>
                            <button type="submit" id="{{ $data->id }}" class="btn btn-danger addWishlist">Add To
                                Wishlist
                                <i class="fa-solid fa-heart"></i></button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <section id="team" class="team pt-0">
                <div class="container" data-aos="fade-up">
                    <b><u>
                            <h2 style="font-family: poppins;">RELATED</h2></b></u>

                    <div class="row mt-2" data-aos="fade-up" data-aos-delay="100">

                        @foreach ($rekomens as $rekomen)
                            <div class="col-lg-3 col-md-6 d-flex">
                                <div class="member">
                                    <img src="{{ asset('storage/jobs/' . $rekomen->photo) }}" class="img-fluid"
                                        alt="">
                                    <div class="member-content">
                                        <h4>{{ $rekomen->name }}</h4>
                                        <div class="social">
                                            <a href=""><i class="bi bi-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Team Member -->
                        @endforeach
                    </div>

                </div>
            </section>
        </div>
        </div>
    </main>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
    </script>
@endpush
