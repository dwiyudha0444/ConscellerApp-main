@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Jobs</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('portofolio.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="row">


                <div class="col-lg-3">
                    <p>Cover:</p>
                    <form action="#" method="post">
                        <button class="btn text-danger">X</button>
                        @csrf
                        @method('delete')
                    </form>
                    <img src="{{ asset('storage/portofolio/' . $portofolios->photo) }}" class="img-responsive"
                        style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                    <br>



                    @if (count($portofolios->portofolioImage) > 0)
                        <p>Images:</p>
                        @foreach ($portofolios->portofolioImage as $img)
                            <form action="{{ route('deleteImage', $img->id) }}" method="post">
                                <button class="btn text-danger">X</button>
                                @csrf
                                @method('delete')
                            </form>
                            <img src="{{ asset('storage/portofolioImages/' . $img->images) }}" class="img-responsive"
                                style="max-height: 100px; max-width: 100px;" alt="" srcset="">
                        @endforeach
                    @endif

                </div>


                <div class="col-lg-9">
                    <h3 class="text-center text-danger"><b>Update Portofolio</b> </h3>
                    <div class="form-group">
                        <form action="{{ route('portofolio.update', $portofolios->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="text" name="name" class="form-control m-2" placeholder="Nama"
                                value="{{ $portofolios->name }}">
                            <input type="url" name="url" class="form-control m-2" placeholder="Url"
                                value="{{ $portofolios->url }}">

                                
                            <label class="m-2">Cover Image</label>
                            <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="photo">

                            <label class="m-2">Images</label>
                            <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]"
                                multiple>

                                <label class="m-2">Jadwal Boking</label>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <input type="tgl1" name="tgl1" class="form-control m-2" placeholder="Tanggal 1"
                                        value="{{ $portofolios->tgl1 }}">
                                    </div>
                                    <div class="col-lg">
                                        <input type="jdwl" name="jdwl" class="form-control m-2" placeholder="Jadwal 1"
                                        value="{{ $portofolios->jdwl }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <input type="tgl1" name="tgl2" class="form-control m-2" placeholder="Tanggal 2"
                                        value="{{ $portofolios->tgl2 }}">
                                    </div>
                                    <div class="col-lg">
                                        <input type="jdwl2" name="jdwl2" class="form-control m-2" placeholder="Jadwal 2"
                                        value="{{ $portofolios->jdwl2 }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <input type="tgl3" name="tgl3" class="form-control m-2" placeholder="Tanggal 3"
                                        value="{{ $portofolios->tgl3 }}">
                                    </div>
                                    <div class="col-lg">
                                        <input type="jdwl3" name="jdwl3" class="form-control m-2" placeholder="Jadwal 3"
                                        value="{{ $portofolios->jdwl3 }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <input type="tgl4" name="tgl4" class="form-control m-2" placeholder="Tanggal 4"
                                        value="{{ $portofolios->tgl4 }}">
                                    </div>
                                    <div class="col-lg">
                                        <input type="jdwl4" name="jdwl4" class="form-control m-2" placeholder="Jadwal 4"
                                        value="{{ $portofolios->jdwl4 }}">
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-danger mt-3 ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
