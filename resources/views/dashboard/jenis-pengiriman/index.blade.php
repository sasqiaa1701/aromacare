@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Jenis Pengiriman</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Jenis Pengiriman</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('jenis-pengiriman.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Tambah Jenis Pengiriman
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mt-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Kirim</th>
                                <th>Nama Ekspedisi</th>
                                <th>Logo Ekspedisi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenisPengiriman as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($item->jenis_kirim) }}</td>
                                    <td>{{ $item->nama_ekspedisi }}</td>
                                    <td>
                                        <img class="img-fluid img-thumbnail" style="height: 100px"
                                            src="{{ asset('storage/' . $item->logo_ekspedisi) }}" alt="logo-ekspedisi">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('jenis-pengiriman.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('jenis-pengiriman.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($jenisPengiriman->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data jenis pengiriman.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
