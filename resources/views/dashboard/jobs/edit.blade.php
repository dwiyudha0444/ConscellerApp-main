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
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('jobs.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Nama pekerjaan</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" id="" class="form-control bg-dark">
                            <option disabled selected>{{ $data->category->name }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Deskripsi pekerjaan</label>
                        <textarea name="description" id="description" rows="10" cols="30" class="form-control">{{ $data->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control bg-dark" name="photo"
                            onchange="document.getElementById('foto').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mb-2">
                            <img src="{{ asset('storage/jobs/' . $data->photo) }}" id="foto" alt=""
                                width="200">
                        </div>
                        @error('photo')
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
