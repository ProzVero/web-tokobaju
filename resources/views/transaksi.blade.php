@extends('layouts.admin')
@section('title','Data Transaksi')

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
              <h3 class="card-title">Tabel @yield('title') Menunggu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Toko</th>
                  <th>Total</th>
                  <th>Bank</th>
                  <th>Status</th>
                  <th style="width: 80px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($transaksiMenunggu as $no => $d)
                    <tr>
                      <td>{{ $no+1 }}</td>
                      <td>{{ $d->user->nama_toko }}</td>
                      <td>Rp.{{ number_format($d->total_transfer) }}</td>
                      <td>{{ $d->bank }}</td>
                      <td>{{ $d->status }}</td>
                      <td>
                        <a href="{{ route('transaksiProses', $d->id) }}" class="badge badge-success mb-1">
                          Proses
                        </a>
                        <a href="{{ route('transaksiBatal', $d->id) }}" class="badge badge-danger mb-1" >
                          Batal
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

      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel @yield('title') Selesai</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Total</th>
                  <th>Bank</th>
                  <th>Status</th>
                  <th>Bukti Transfer</th>
                  <th style="width: 20px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($transaksiSelesai as $no => $d)
                    <tr>
                      <td>{{ $no+1 }}</td>
                      <td>Rp.{{ number_format($d->total_transfer) }}</td>
                      <td>{{ $d->bank }}</td>
                      <td>{{ $d->status }}</td>
                      <td>
                        <a href="{{ asset('storage/app/public/transfer/' . $d->bukti_transfer) }}" class="btn btn-primary mb-1">
                          Bukti Transfer
                        </a>
                      </td>
                      <td >
                        @if ($d->status == "DIKIRIM")
                        <a href="{{ route('transaksiSelesai', $d->id) }}" class="btn btn-block btn-primary mb-1">
                          Selesai
                        </a>
                        @elseif ($d->status == "PROSES")
                        <a href="{{ route('transaksiKirim', $d->id) }}" class="btn btn-block btn-success mb-1">
                          Kirim
                        </a>
                        @elseif ($d->status == "SELESAI" || $d->status == "BATAL")                        
                        <a href="{{ route('detailtransaksi', $d->id) }}" class="btn btn-block btn-info mb-1">
                          Detail
                        </a>
                        @elseif ($d->status == "DIBAYAR")                        
                        <a href="{{ route('transaksiKirim', $d->id) }}" class="btn btn-block btn-success mb-1">
                          Proses
                        </a>
                        @endif
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

<script>
  @if ($errors->any())
    $('#add-modal').modal('show')
  @endif
  $(function () {
    $("#example1").DataTable();
  });
  $(function () {
    $("#example2").DataTable();
  });
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>
    
@endpush
