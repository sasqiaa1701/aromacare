@extends('layouts.admin.app')
@section('content')
    <div class="content">
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <i class="mdi mdi-pill" style="font-size: 36px; color: #5e72e4;"></i>
                        <h2 class="mb-1">{{ $obats }}</h2>
                        <p>Total Obat</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <i class="mdi mdi-account-multiple-outline" style="font-size: 36px; color: #f5365c;"></i>
                        <h2 class="mb-1">{{ $pelanggans }}</h2>
                        <p>Total Pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <i class="mdi mdi-account-circle-outline" style="font-size: 36px; color: #2dce89;"></i>
                        <h2 class="mb-1">{{ $users }}</h2>
                        <p>Total User</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <i class="mdi mdi-cash-multiple" style="font-size: 36px; color: #fb6340;"></i>
                        <h2 class="mb-1">{{ $penjualans }}</h2>
                        <p>Total Transaksi</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none recent-orders" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Recent Orders</h2>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nota</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($penjualanTerbaru as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->order_id }}</td>
                                        <td class="d-none d-lg-table-cell">{{ $item->tgl_penjualan }}</td>
                                        <td>
                                            <a class="text-dark" href="">
                                                {{ optional($item->pelanggan)->nama_pelanggan ?? '-' }}</a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">Rp.{{ number_format($item->total_bayar) }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $item->status_order }}</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                    id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdown-recent-order1">
                                                    <li class="dropdown-item">
                                                        <a
                                                            href="{{ route('penjualan.show', ['id' => $item->order_id]) }}">View</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
