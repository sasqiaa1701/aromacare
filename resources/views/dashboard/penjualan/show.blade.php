@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card mb-2">
            <div class="card-body">
                <div class="breadcrumb-wrapper mb-3">
                    <h1><i class="mdi mdi-cart-plus"></i> Detail Penjualan</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><span class="mdi mdi-home"></span></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Informasi Transaksi --}}
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="mdi mdi-information-outline"></i> Informasi Transaksi
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Order ID:</strong> {{ $penjualan->order_id }}</div>
                    <div class="col-md-4"><strong>Tanggal Transaksi:</strong>
                        {{ $penjualan->created_at->format('d-m-Y H:i') }}</div>
                    <div class="col-md-4"><strong>Status:</strong>
                        <span class="badge bg-info">{{ $penjualan->status_order }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama Pembeli:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</div>
                    <div class="col-md-4"><strong>No HP:</strong> {{ $penjualan->pelanggan->no_telp }}</div>
                    <div class="col-md-4"><strong>Alamat Pengiriman:</strong> {{ $penjualan->pelanggan->alamat1 }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Metode Pembayaran:</strong>
                        {{ $penjualan->metode_bayar->metode_pembayaran ?? '-' }}</div>
                    <div class="col-md-4"><strong>Jenis Pengiriman:</strong>
                        {{ $penjualan->jenis_pengiriman->jenis_kirim ?? '-' }}</div>
                    <div class="col-md-4"><strong>Ongkir:</strong>
                        Rp{{ number_format($penjualan->ongkos_kirim, 0, ',', '.') }}</div>
                    <div class="col-md-4">
                        <strong>Resep:</strong>
                        @if (isset($penjualan->url_resep))
                            <a target="_blank" href="/storage/{{ $penjualan->url_resep }}">
                                <i class="mdi mdi-file-document-outline"></i> File Resep
                            </a>
                        @else
                            <span><i class="mdi mdi-file-document-outline"></i> Resep belum diberikan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Produk --}}
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <i class="mdi mdi-pill"></i> Produk yang Dibeli
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->detail_penjualan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->obat->nama_obat ?? '-' }}</td>
                                    <td>Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                    <td>{{ $item->jumlah_beli }}</td>
                                    <td>Rp{{ number_format($item->harga_beli * $item->jumlah_beli, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Total Belanja</th>
                                <th>Rp{{ number_format($penjualan->total_bayar - $penjualan->ongkos_kirim, 0, ',', '.') }}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Biaya Ongkir</th>
                                <th>Rp{{ number_format($penjualan->ongkos_kirim, 0, ',', '.') }}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Total Bayar</th>
                                <th>Rp{{ number_format($penjualan->total_bayar, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex" style="gap: 10px">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahStatusModal">
                            Ubah Status
                        </button>
                        <a class="btn btn-secondary" href="{{ route('penjualan.index') }}">
                            Kembali
                        </a>
                        <a href="{{ route('laporan.penjualan.print', ['id' => $penjualan->order_id]) }}" target="_blank"
                            class="btn btn-success">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ubahStatusModal" tabindex="-1" aria-labelledby="ubahStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('penjualan.update_status', $penjualan->order_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahStatusModalLabel">Ubah Status Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $statuses = [
                                'Menunggu Konfirmasi',
                                'Diproses',
                                'Menunggu Kurir',
                                'Dibatalkan Pembeli',
                                'Dibatalkan Penjual',
                                'Bermasalah',
                                'Selesai',
                            ];
                        @endphp
                        <div class="mb-3">
                            <label for="status_order" class="form-label">Status</label>
                            <select name="status_order" id="status_order" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                @foreach ($statuses as $item)
                                    <option value="{{ $item }}"
                                        {{ $penjualan->status_order == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
