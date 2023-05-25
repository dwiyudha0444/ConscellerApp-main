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
                        <li>{{ $data->user->name }}</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 flex">
                    <div class="slider-for">
                        @foreach ($images as $img)
                            <div>
                                <img src="{{ asset('storage/portofolioImages/' . $img->images) }}" alt=""
                                    width="500px">
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-nav mt-2">
                        @foreach ($images as $img)
                            <div>
                                <img src="{{ asset('storage/portofolioImages/' . $img->images) }}" alt=""
                                    style="width: 100%;" class="me-3">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Nama portofolio : {{ $data->name }}</h3>
                    <h5>Link : <a href="{{ $data->url }}" target="blank">Klik disini</a></h5>
                    <br>
                    <h5>Jadwal</h5>
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th colspan="4" class="table-active" scope="col">Tanggal</th>
                          </tr>
                          <tr>
                            <th scope="col">{{ $data->tgl1 }}</th>
                            <th scope="col">{{ $data->tgl2 }}</th>
                            <th scope="col">{{ $data->tgl3 }}</th>
                            <th scope="col">{{ $data->tgl4 }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $data->jdwl }}</td>
                            <td>{{ $data->jdwl2 }}</td>
                            <td>{{ $data->jdwl3 }}</td>
                            <td>{{ $data->jdwl4 }}</td>
                          </tr>
                    
                        </tbody>
                      </table>

                      <br>
                      <h5>Deskripsi</h5>
                    <p>
                        {!! $data->user->description !!}
                    </p>
                    <span class="badge text-bg-danger mb-3">Hanya menerima pesanan saat weekend</span>
                    <form action="{{ route('addWishlist', $data->id) }}" method="post">
                        @csrf
                        <div class="btn-group">
                            <a href="https://wa.me/62{{ $data->user->phone }}?&text=Halo {{ $data->user->name }} saya berminat untuk jasa anda"
                                target="blank" class="btn btn-success me-2">Go To Whatsapp <i
                                    class="fa-brands fa-whatsapp"></i></a>
                            <button type="submit" id="{{ $data->id }}" class="btn btn-danger addWishlist me-2">Add To
                                Wishlist
                                <i class="fa-solid fa-heart"></i></button>
                            @if ($data->user->is_weekend == 1)
                                <a type="submit" class="btn btn-primary me-2">Booking Now
                                    <i class="fa-solid fa-book"></i></a>
                            @endif
                        </div>

                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <section id="team" class="team pt-0">
                <div class="container" data-aos="fade-up">
                    <b><u>
                            <h2 style="font-family: poppins;">Portofolio lainnya</h2></b></u>

                    <div class="row mt-2" data-aos="fade-up" data-aos-delay="100">

                        @foreach ($rekomens as $rekomen)
                            <div class="col-lg-3 col-md-6 d-flex">
                                <div class="member">
                                    <a href="{{ route('detailPorto', $rekomen->id) }}"> <img
                                            src="{{ asset('storage/portofolio/' . $rekomen->photo) }}" class="img-fluid"
                                            alt=""></a>
                                    <div class="member-content">
                                        <h4>{{ $rekomen->name }}</h4>
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
