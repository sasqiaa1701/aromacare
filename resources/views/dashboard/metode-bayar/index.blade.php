@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Metode Pembayaran</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Metode Pembayaran</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('metode-bayar.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Tambah Metode Pembayaran
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
                                <th>Metode</th>
                                <th>Tempat Bayar</th>
                                <th>No Rekening</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($metodeBayar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->metode_pembayaran }}</td>
                                    <td>{{ $item->tempat_bayar }}</td>
                                    <td>{{ $item->no_rekening }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->url_logo) }}" class="img-thumbnail"
                                            style="height: 80px;" alt="logo">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('metode-bayar.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('metode-bayar.destroy', $item->id) }}" method="POST"
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
                        </tbody>
                    </table>
                    {{-- Optional: Pagination --}}
                    {{-- {{ $metodeBayar->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
