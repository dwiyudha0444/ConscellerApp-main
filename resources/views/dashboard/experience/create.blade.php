@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] }}</li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('experience.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <form action="{{ route('experience.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nama pengalaman</label>
                    <input type="text" class="form-control" id="" name="name" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Portofolio</label>
                    <select name="portofolio_id" id="" class="form-control bg-dark">
                        <option disabled selected>-- Pilih portofolio --</option>
                        @foreach ($portofolios as $portofolio)
                            <option value="{{ $portofolio->id }}">{{ $portofolio->name }}</option>
                        @endforeach
                    </select>
                    @error('portofolio_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
