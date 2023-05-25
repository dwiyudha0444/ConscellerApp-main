@extends('dashboard.index')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <h3 class="mb-3">Kategori</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="bi-plus-circle me-2"></i>Tambah
                    data</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">Nama kategori</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Desktipsi</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->icon }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('category.edit', $data->id) }}" class="text-danger mx-1">
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
                        url: "{{ route('category-delete') }}",
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
    </script>
@endpush
