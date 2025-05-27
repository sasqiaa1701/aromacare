@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">
                            <i class="mdi mdi-cart-plus text-primary"></i>
                            Laporan Pembelian Obat
                        </h4>
                        <small class="text-muted">Menampilkan daftar laporan pembelian obat dari distributor.</small>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="text-decoration-none text-primary">
                                    <i class="mdi mdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Pembelian
                            </li>
                        </ol>
                    </nav>
                </div>

                <form method="GET" action="{{ route('laporan.pembelian.index') }}" class="row mb-4">
                    <div class="col-md-4">
                        <label for="tgl_pembelian">Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control"
                            value="{{ request('tgl_pembelian') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="id_distributor">Distributor</label>
                        <select name="id_distributor" id="id_distributor" class="form-control">
                            <option value="">-- Semua Distributor --</option>
                            @foreach ($distributors as $distributor)
                                <option value="{{ $distributor->id }}"
                                    {{ request('id_distributor') == $distributor->id ? 'selected' : '' }}>
                                    {{ $distributor->nama_distributor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="mdi mdi-filter"></i> Filter
                        </button>
                    </div>
                </form>

            </div>
        </div>

        {{-- Tabel Laporan Pembelian Obat --}}
        <div class="card shadow-sm border-0 my-2">
            <div class="card-body">
                <h5 class="mb-4"><i class="mdi mdi-table-large"></i> Daftar Pembelian Obat</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nota</th>
                                <th>Tanggal Pembelian</th>
                                <th>Distributor</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nota }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->distributor->nama_distributor }}</td>
                                    <td>Rp {{ number_format($item->total_bayar, 2) }}</td>
                                    <td>
                                        <a href="{{ route('laporan.pembelian.show', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-info"><i class="mdi mdi-eye"></i> Lihat</a>
                                        <a target="_blank"
                                            href="{{ route('laporan.pembelian.print', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-warning"><i class="mdi mdi-printer"></i>Print</a>
                                        <form action="{{ route('laporan.pembelian.destroy', ['id' => $item->id]) }}"
                                            class="d-inline" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i>
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
