@extends('frontend.layout')
@section('content')
    <main id="main">
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">

            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Daftar keingininan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Breadcrumbs -->

        <div class="col-md-12">
            <section id="team" class="team pt-0">
                <div class="container" data-aos="fade-up">
                    <div class="section-header">
                        <h2>DAFTAR KEINGINAN</h2>

                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        @foreach ($datas as $data)
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="member">
                                    <a href="{{ route('detailLoker', $data->job_id) }}"><img
                                            src="{{ asset('storage/jobs/' . $data->jobs->photo) }}" class="img-fluid"
                                            alt=""></a>
                                    <div class="member-content">
                                        <a href="{{ route('detailLoker', $data->job_id) }}">
                                            <h4>{{ $data->jobs->name }}</h4>
                                        </a>
                                        <span class="text-muted">{{ $data->jobs->category->name }}</span>
                                        <div class="social">
                                            <a href="#" id="{{ $data->id }}" class="deleteWishlist"><i
                                                    class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Team Member -->
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $(document).on('click', '.deleteWishlist', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            console.log(id);
            Swal.fire({
                title: 'Yakin untuk hapus?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete-wishlist') }}",
                        method: "post",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Data berhasil dari wishlist.',
                                    'success'
                                )
                            }
                            window.location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
