@extends('layouts.admin.app')


@section('content')
    <div class="container-fluid mt-2">
        <div class="card mb-2">
            <div class="card-body">
                <div class="breadcrumb-wrapper mb-3">
                    <h1><i class="mdi mdi-cart-plus"></i> Transaksi Penjualan Obat</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span
                                        class="mdi mdi-home"></span></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="penjualanStatusTabs" role="tablist">
                    @foreach (['Semua', 'Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Selesai'] as $status)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#{{ Str::slug($status) }}" role="tab" aria-controls="{{ Str::slug($status) }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $status }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    @foreach (['Semua', 'Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Selesai'] as $status)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($status) }}"
                            role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order Id</th>
                                            <th>Total Bayar</th>
                                            <th>Ongkir</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Metode Pengiriman</th>
                                            <th>Status Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $filtered =
                                                $status === 'Semua'
                                                    ? $penjualan
                                                    : $penjualan->where('status_order', $status);
                                        @endphp
                                        @forelse ($filtered as $i => $item)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $item->order_id }}</td>
                                                <td>Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($item->ongkos_kirim, 0, ',', '.') }}</td>
                                                <td>{{ optional($item->metode_bayar)->metode_pembayaran ?? '-' }}</td>
                                                <td>{{ optional($item->jenis_pengiriman)->jenis_kirim ?? '-' }}</td>
                                                <td><span class="badge bg-info">{{ $item->status_order }}</span></td>
                                                <td>
                                                    <div class="d-flex" style="gap: 10px">
                                                        <a href="{{ route('penjualan.show', ['id' => $item->order_id]) }}"
                                                            class="btn btn-sm btn-primary">Detail</a>
                                                        <form
                                                            action="{{ route('penjualan.destroy', ['id' => $item->order_id]) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
