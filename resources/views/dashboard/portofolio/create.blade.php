@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portofolio</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('portofolio.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('portofolio.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Url</label>
                        <input type="url" class="form-control" name="url" value="{{ old('url') }}">
                        @error('url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Cover</label>
                        <input type="file" class="form-control bg-dark" name="photo"
                            onchange="document.getElementById('foto').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mb-2">
                            <img src="" id="foto" alt="" width="200">
                        </div>
                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Photo lebih dari 1</label>
                        <input type="file" class="form-control" name="images[]" multiple>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Tanggal 1</label>
                        <input type="text" class="form-control" name="tgl1" value="{{ old('tgl1') }}">
                        @error('tgl1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Tanggal 2</label>
                        <input type="text" class="form-control" name="tgl2" value="{{ old('tgl2') }}">
                        @error('tgl2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Tanggal 3</label>
                        <input type="text" class="form-control" name="tgl3" value="{{ old('tgl3') }}">
                        @error('tgl3')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Tanggal 4</label>
                        <input type="text" class="form-control" name="tgl4" value="{{ old('tgl4') }}">
                        @error('tgl4')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Jadwal 1</label>
                        <input type="text" class="form-control" name="jdwl" value="{{ old('jdwl') }}">
                        @error('jdwl')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Jadwal 2</label>
                        <input type="text" class="form-control" name="jdwl2" value="{{ old('jdwl2') }}">
                        @error('jdwl2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Jadwal 3</label>
                        <input type="text" class="form-control" name="jdwl3" value="{{ old('jdwl3') }}">
                        @error('jdwl3')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Jadwal 4</label>
                        <input type="text" class="form-control" name="jdwl4" value="{{ old('jdwl4') }}">
                        @error('jdwl4')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
