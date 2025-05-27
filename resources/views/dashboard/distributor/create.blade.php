@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Tambah Distributor</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('distributor.index') }}">Distributor</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Distributor</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="card mt-2">
            <div class="card-body">
                <form action="{{ route('distributor.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Nama Distributor -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_distributor">Nama Distributor</label>
                                <input type="text" name="nama_distributor" id="nama_distributor"
                                    class="form-control @error('nama_distributor') is-invalid @enderror"
                                    value="{{ old('nama_distributor') }}" required>
                                @error('nama_distributor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"
                                    required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" id="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}"
                                    required>
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('distributor.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
