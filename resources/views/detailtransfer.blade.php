@extends('layouts.admin')
@section('title','Detail Transaksi')

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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminToko, Inc.
                    <small class="float-right">Date: {{ $transaksi_id->created_at }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    Alamat: {{ Auth::user()->alamat}}<br>
                    Phone: {{ Auth::user()->phone }}<br>
                    Email: {{ Auth::user()->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $transaksi_id->name }}</strong><br>
                    {{ $transaksi_id->detail_lokasi }}<br>
                    Phone: {{ $transaksi_id->phone }}<br>
                    {{-- Email: {{ $transaksi_id-> }} --}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{ $transaksi_id->kode_unik }}</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> {{ $transaksi_id->kode_payment }}<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th style="width: 10%">Gambar Product</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($detail_transaksi as $detail)
                    <tr>
                      <td>{{ $detail->total_item }}</td>
                      <td>
                        <img src="{{ asset('storage/produk/'.$detail->produk->image)  }}" alt="" class="img-thumbnail" >
                      </td>
                      <td>{{ $detail->produk->name }}</td>
                      <td>{{ $detail->transaksi->kode_unik}}</td>
                      <td>{{ $detail->catatan}}</td>
                      <td>Rp.{{ number_format($detail->total_harga) }}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="{{ asset('dist/img/credit/visa.png') }}" alt="Visa">
                  <img src="{{ asset('dist/img/credit/mastercard.png') }}" alt="Mastercard">
                  <img src="{{ asset('dist/img/credit/american-express.png') }}" alt="American Express">
                  <img src="{{ asset('dist/img/credit/paypal2.png') }}" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    {{ $transaksi_id->bank }} <br>
                    <img src="{{ asset('storage/transfer/'.$transaksi_id->bukti_transfer) }}" alt="" width="40%" class="img-thumbnail">
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due {{ $transaksi_id->updated_at }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Harga Barang:</th>
                        <td>Rp.{{ number_format($transaksi_id->total_harga) }}</td>
                      </tr>
                      <tr>
                        <th>Ongkir</th>
                        <td>Rp.{{ number_format($transaksi_id->ongkir) }}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>Rp.{{ number_format($transaksi_id->total_transfer) }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              {{--  <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>  --}}
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
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
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>
    
@endpush
