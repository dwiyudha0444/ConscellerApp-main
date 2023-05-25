@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('users.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{ $data->phone }}">
                        <div class="form-text">Masukkan nomor tanpa memberikan angka '0' di awal, contoh : 818973512</div>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control bg-dark" cols="10">{{ $data->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Role</label>
                        <select name="roles" class="form-control bg-dark">
                            <option selected>{{ $data->roles }}</option>
                            <option disabled>-- Pilih Roles --</option>
                            <option value="admin">Admin</option>
                            <option value="client">Client</option>
                            <option value="freelance">Freelance</option>
                        </select>
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control bg-dark" name="photo"
                            onchange="document.getElementById('foto').src = window.URL.createObjectURL(this.files[0])">
                        <div class="mb-2">
                            <img src="{{ asset('storage/users/' . $data->photo) }}" id="foto" alt=""
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
