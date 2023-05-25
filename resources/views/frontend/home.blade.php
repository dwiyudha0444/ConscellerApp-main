<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Collancer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    @include('frontend.includes.style')
</head>

<body>

    @include('frontend.includes.header-home')

    <main id="main">

        <section id="team" class="team pt-0">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Recomendation</span>
                    <h2>Recomendation</h2>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    @forelse ($datas as $data)
                        <div class="col-lg-4 col-md-6 col-12 my-2">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('detailFreelance', $data->id) }}">
                                        <img src="{{ $data->photo ? asset('storage/users/' . $data->photo) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
                                            class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('detailFreelance', $data->id) }}">{{ $data->name }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @empty
                        @include('frontend.includes.404')
                    @endforelse
                </div>

            </div>
        </section><!-- End Our Team Section -->

        <section id="featured-services" class="featured-services">
            <div class="container">

                <div class="row gy-4">
                    <div class="section-header">
                        <h2>List Category</h2>

                    </div>
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up">
                            <div class="icon flex-shrink-0"><i class="{{ $category->icon }}"></i></div>
                            <div>
                                <h4 class="title">{{ $category->name }}</h4>
                                <p class="description">{{ $category->description }}</p>
                                <a href="{{ route('filter-kategori', $category->id) }}"
                                    class="readmore stretched-link"></a>
                            </div>
                        </div>
                        <!-- End Service Item -->
                    @endforeach

                </div>

            </div>
        </section>

    </main>

    <!-- ======= Footer ======= -->
    @include('frontend.includes.footer')
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    @include('frontend.includes.script')

</body>

</html>
