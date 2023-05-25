@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Jobs</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jobs</li>
            </ol>
        </nav>
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary"><i class="bi-plus-circle me-2"></i>Tambah
                    data</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Nama pekerjaan</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category->name }}</td>
                                <td>
                                    @if ($data->status == 'aktif')
                                        <span class="badge bg-success">{{ $data->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $data->status }}</span><br>
                                        @if (Auth::user()->roles === 'admin')
                                            <a href="#" id="{{ $data->id }}"
                                                class="btn btn-success btn-sm updateStatus"><i
                                                    class="bi bi-check"></i>Approve</a>
                                        @endif
                                    @endif
                                </td>
                                <td>{!! Str::limit($data->description, 10, '...') !!}</td>
                                <td>
                                    <img src="{{ asset('storage/jobs/' . $data->photo) }}" alt="" width="30px">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('jobs.edit', $data->id) }}" class="text-danger mx-1">
                                            <i class="bi-pencil h4"></i>
                                        </a>
                                        <a href="#" id="{{ $data->id }}" class="text-danger mx-1 deleteUser"><i
                                                class="bi-trash h4"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // delete
        $(document).on('click', '.deleteUser', function(e) {
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
                        url: "{{ route('jobs-delete') }}",
                        method: "post",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Data berhasil di hapus.',
                                    'success'
                                )
                            }
                            window.location.reload();
                        }
                    });
                }
            })
        });

        // update status
        $(document).on('click', '.updateStatus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            console.log(id);
            Swal.fire({
                title: 'Approve postingan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('jobs-status') }}",
                        method: "post",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Approved!',
                                    'Postingan jobs telah di approve',
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
