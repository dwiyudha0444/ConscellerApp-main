@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">User</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User profile</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5 mt-5">
                        <img class="rounded-circle mt-5" width="100px" id="foto"
                            src="{{ $data->photo ? asset('storage/users/' . $data->photo) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}">
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form action="{{ route('updateProfile', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="label">Name</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Email</label>
                                    <input type="text" class="form-control" value="{{ $data->email }}" name="email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="label">Phone</label>
                                    <input type="text" class="form-control" value="{{ $data->phone }}" name="phone">
                                    <div class="form-text">Masukkan nomor tanpa memberikan angka '0' di awal, contoh :
                                        818973512</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Role</label>
                                    <input type="text" class="form-control bg-dark" value="{{ $data->roles }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Confirm password</label>
                                    <input type="password" class="form-control" name="confrim_password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                @if (Auth::user()->roles == 'freelance' || Auth::user()->roles == 'admin')
                                    <div class="col-md-6">
                                        <label class="form-label">Foto</label>
                                        <input type="file" class="form-control bg-dark" name="photo"
                                            onchange="document.getElementById('foto').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Apakah hanya menerima hari weekend?</label>
                                        <select name="is_weekend" id="" class="form-control bg-dark">
                                            <option value="" disabled selected>-- Pilih status --</option>
                                            <option value="1" {{ $data->is_weekend == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="0" {{ $data->is_weekend == 0 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </div>
                                @else
                                    <div class="col">
                                        <label class="form-label">Foto</label>
                                        <input type="file" class="form-control bg-dark" name="photo"
                                            onchange="document.getElementById('foto').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg">
                                    <label for="form-label">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control bg-dark" cols="30">{{ $data->description }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save
                                    Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
