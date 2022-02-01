@extends('layouts.admin')
@section('title', 'Daftar Toko')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Nama Toko</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $no => $d)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td class="text-center"><img src="{{ asset('storage/logo_toko/' . $d->image) }}"
                                            alt="" width="70%" class="img-thumbnail"></td>
                                    <td>{{ $d->nama_toko }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->phone }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->updated_at }}</td>
                                    <td>
                                        <a href="#" data-id="{{ $d->id }}" class="btn btn-danger mb-1 btn-delete">
                                            <form action="{{ route('user.destroy', $d->id) }}" method="POST"
                                                id="delete{{ $d->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection

@push('page-scripts')
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('page-scripts')

    <script>
        $(".btn-delete").click(function(e) {
            id = e.target.dataset.id
            swal({
                    title: 'Yakin ingin menghapus? ',
                    text: 'Data akan di hapus secara permanen!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal('Delete data success!', {
                            icon: 'success',
                        });
                        $(`#delete${id}`).submit();
                    } else {
                        // swal('Your imaginary file is safe!');
                    }
                });
        });
        $(function() {
            $("#example1").DataTable();
        });
    </script>

@endpush
