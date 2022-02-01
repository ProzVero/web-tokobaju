@extends('layouts.admin')
@section('title', 'Data Produk')

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
                    Produk</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th style="width: 30%" class="text-center">Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $no => $d)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $d->user->nama_toko }}</td>
                            <td class="text-center"><img src="{{ asset('storage/produk/' . $d->image) }}" alt="" width="30%" class="img-thumbnail"></td>
                            <td>{{ $d->name }}</td>
                            <td>Rp.{{ number_format($d->harga) }}</td>
                            <td>{{ $d->stok }} Biji</td>
                            <td>{{ $d->updated_at }}</td>
                            <td>
                                <a href="#" data-id="{{ $d->id }}" class="btn btn-warning mb-1" data-target="#edit-modal{{ $d->id }}" data-toggle="modal">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-id="{{ $d->id }}" class="btn btn-danger mb-1 btn-delete">
                                    <form action="{{ route('produk.destroy', $d->id) }}" method="POST" id="delete{{ $d->id }}">
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
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('produk.store') }}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="nama_toko" value="{{ Auth::user()->nama_toko }}">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stok /Sak</label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok') }}" class="form-control @error('stok')
                    is-invalid
                  @enderror">
                                <div class="invalid-feedback">
                                    @error('stok')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Berat /Kg</label>
                                <input type="number" name="berat" id="berat" value="{{ old('berat') }}" class="form-control @error('berat') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('berat')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" id="harga" value="{{ old('harga') }}" class="form-control @error('harga') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('harga')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                    <option value="">No Selected</option>
                                    @foreach($kategori as $item)
                                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('kategori_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"></textarea>
                        <div class="invalid-feedback">
                            @error('kategori_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image">
                                <label for="image" class="custom-file-label">Pilih file</label>
                            </div>
                        </div>

                        <div class="invalid-feedback">
                            @error('image')
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

@foreach ($produk as $edit)
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal{{ $edit->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('produk.update', $edit->id) }}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="nama_toko" value="{{ Auth::user()->nama_toko }}">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" value="{{ $edit->name }}" class="form-control @error('name') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stok /Sak</label>
                                <input type="number" name="stok" id="stok" value="{{ $edit->stok }}" class="form-control @error('stok') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('stok')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Berat /Kg</label>
                                <input type="number" name="berat" id="berat" value="{{ $edit->berat }}" class="form-control @error('berat') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('berat')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" id="harga" value="{{ $edit->harga }}" class="form-control @error('harga') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('harga')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id')  is-invalid  @enderror">
                                    @foreach($kategori as $item)
                                        @if ($edit->kategori_id == $item->id)
                                            <option value="{{$edit->kategori_id}}">{{$item->nama_kategori}}
                                            </option>
                                        @endif
                                    @endforeach
                                    @foreach($kategori as $item)
                                        @if ($edit->kategori_id != $item->id)
                                            <option value="{{$edit->kategori_id}}">{{$item->nama_kategori}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                <div class="invalid-feedback">
                                    @error('kategori_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control @error('deskripsi')
                    is-invalid
                  @enderror">{{ $edit->deskripsi }}</textarea>
                        <div class="invalid-feedback">
                            @error('kategori_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image')
                    is-invalid
                  @enderror" name="image" value="{{ $edit->image }}">
                                <label for="image" class="custom-file-label">Pilih file</label>
                            </div>
                        </div>

                        <div class="invalid-feedback">
                            @error('image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <img src="{{ asset('storage/produk/' . $edit->image) }}" alt="" width="30%" class="img-thumbnail">

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
