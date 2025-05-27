@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h4 class="mb-3">
                    <i class="mdi mdi-file-document-outline text-info"></i>
                    Detail Pembelian Obat
                </h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-primary">
                                <i class="mdi mdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('pembelian.index') }}" class="text-decoration-none text-primary">
                                Pembelian
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Informasi Umum --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h5 class="mb-3">Informasi Umum</h5>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Nota:</strong>
                        <p>{{ $pembelian->nota }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Tanggal Pembelian:</strong>
                        <p>{{ \Carbon\Carbon::parse($pembelian->tgl_pembelian)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Distributor:</strong>
                        <p>{{ $pembelian->distributor->nama_distributor }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Total Bayar:</strong>
                        <p>Rp {{ number_format($pembelian->total_bayar, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Detail Obat Dibeli</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Beli</th>
                                <th>Harga Beli</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelian->detailPembelians as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->obat->nama_obat }}</td>
                                    <td>{{ $detail->jumlah_beli }}</td>
                                    <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Bayar</th>
                                <th>Rp {{ number_format($pembelian->total_bayar, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
