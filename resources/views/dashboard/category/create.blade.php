@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('category.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg">
                        <label class="form-label">Nama kategori</label>
                        <input type="text" class="form-control" width="50%" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Icon</label>
                        <input type="text" class="form-control" width="50%" name="icon"
                            value="{{ old('icon') }}">
                        <div class="form-text">Buka <a href="https://fontawesome.com/icons">link berikut</a> kemudian copy
                            code. Contoh : 'fab fa-react'</div>
                        @error('icon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-lg">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control bg-dark" id="" cols="10">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
