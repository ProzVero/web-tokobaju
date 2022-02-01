@extends('layouts.admin')
@section('title', 'Data kategori')

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
                <h3 class="card-title">Tabel @yield('title')</h3>
                <a href="" class="btn btn-warning float-right" data-target="#add-modal" data-toggle="modal">Tambah
                    Kategori</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $no => $d)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $d->nama_kategori }}</td>
                            <td>{{ $d->updated_at }}</td>
                            <td>
                                <a href="#" data-id="{{ $d->id }}" class="btn btn-warning mb-1" data-target="#edit-modal{{ $d->id }}" data-toggle="modal">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-id="{{ $d->id }}" class="btn btn-danger mb-1 btn-delete">
                                    <form action="{{ route('kategori.destroy', $d->id) }}" method="POST" id="delete{{ $d->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    Hapus
                                    <i class="fa fa-trash"></i>
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

<div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kategori.store') }}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" class="form-control @error('nama_kategori') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('nama_kategori')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($kategori as $edit)
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal{{ $edit->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kategori.update', $edit->id) }}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $edit->nama_kategori }}" class="form-control @error('nama_kategori') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('nama_kategori')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('page-scripts')
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('after-scripts')

<script>
    @if($errors -> any())
    $('#add-modal').modal('show')
    @endif
    $(function() {
        $("#example1").DataTable();
    });
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    $(".btn-delete").click(function(e) {
        id = e.target.dataset.id
        swal({
                title: 'Yakin ingin menghapus? '
                , text: 'Data akan di hapus secara permanen!'
                , icon: 'warning'
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    swal('Delete data success!', {
                        icon: 'success'
                    , });
                    $(`#delete${id}`).submit();
                } else {
                    // swal('Your imaginary file is safe!');
                }
            });
    });

</script>

@endpush
