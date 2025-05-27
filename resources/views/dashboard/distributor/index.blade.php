@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Distributor</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Distributor</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('distributor.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Tambah Distributor
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
                                <th>Nama Distributor</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distributors as $distributor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($distributor->nama_distributor) }}</td>
                                    <td>{{ $distributor->alamat }}</td>
                                    <td>{{ $distributor->telepon }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('distributor.edit', $distributor->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('distributor.destroy', $distributor->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($distributors->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data distributor.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
