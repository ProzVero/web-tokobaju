@extends('layouts.admin')
@section('title', 'Profile')

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
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="  @if (Auth::user()->image==null)
                                {{ asset('dist/img/avatar2.png') }}
                            @else
                                {{ asset('storage/logo_toko/' . Auth::user()->image) }}
                                @endif" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                            @if (Auth::user()->user_id == 'admin')
                                <ul class="list-group list-group-unbordered mb-3" hidden>
                                    <li class="list-group-item">
                                        <b>Produk</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Transaksi</b> <a class="float-right">543</a>
                                    </li>
                                </ul>
                            @elseif (Auth::user()->user_id == 'seller')
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Produk</b> <a class="float-right">{{ $jml_produk }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Transaksi</b> <a class="float-right">{{ $jml_transaksi }}</a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ Auth::user()->alamat }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" name="name"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="inputName2" name="phone"
                                                    value="{{ Auth::user()->phone }}">
                                            </div>
                                        </div>
                                        @if (Auth::user()->user_id == 'admin')
                                            <div class="form-group row" hidden>
                                                <label for="inputName2" class="col-sm-2 col-form-label">Nama Toko</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="nama_toko" placeholder="Nama toko"
                                                        value="{{ Auth::user()->nama_toko }}">
                                                </div>
                                            </div>
                                        @elseif (Auth::user()->user_id == 'seller')
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Nama Toko</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="nama_toko" placeholder="Nama toko"
                                                        value="{{ Auth::user()->nama_toko }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" name="alamat"
                                                    placeholder="Alamat">{{ Auth::user()->alamat }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="image" class="col-sm-2 col-form-label">Upload Logo</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                        name="image">
                                                    <label for="image" class="custom-file-label">Pilih logo</label>
                                                </div>

                                                <img src="{{ asset('storage/logo_toko/' . Auth::user()->image) }}" alt=""
                                                    width="30%" class="img-thumbnail mt-2">
                                            </div>

                                            <div class="invalid-feedback">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
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

@push('after-scripts')

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>

@endpush
