@extends('layouts.admin.app')
@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Daftar Obat</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <span class="mdi mdi-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Obat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Obat</a>
                    <!-- Search Form -->
                    <form action="{{ route('obat.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Cari Obat"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-secondary">Cari</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->jenisObat->jenis ?? 'Tidak Ditemukan' }}</td>
                                    <td>{{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>{{ Str::limit($obat->deskripsi_obat, 50) }}</td>
                                    <td>
                                        <a href="{{ route('obat.edit', $obat->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('obat.destroy', $obat->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data obat ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $obats->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
