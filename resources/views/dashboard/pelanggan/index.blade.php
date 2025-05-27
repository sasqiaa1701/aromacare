@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Daftar Pelanggan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('pelanggan.index') }}">Pelanggan</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Pelanggan</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Tambah Pelanggan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mt-2">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $index => $p)
                            <tr>
                                <td>{{ $pelanggan->firstItem() + $index }}</td>
                                <td>{{ $p->nama_pelanggan }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ $p->alamat1 }}, {{ $p->kota1 }}, {{ $p->provinsi1 }}, {{ $p->kodepos1 }}</td>
                                <td>
                                    <img src="{{ asset($p->foto) }}" alt="Foto Pelanggan" width="50" height="50">
                                </td>
                                <td>
                                    <div class="d-flex gap-2" style="gap: 10px">
                                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                                <i class="mdi mdi-delete"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data pelanggan tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $pelanggan->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
