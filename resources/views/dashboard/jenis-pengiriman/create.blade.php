@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Tambah Jenis Pengiriman</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <span class="mdi mdi-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('jenis-pengiriman.index') }}">Jenis Pengiriman</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('jenis-pengiriman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Jenis Kirim -->
                    <div class="form-group">
                        <label for="jenis_kirim">Jenis Kirim</label>
                        <select name="jenis_kirim" id="jenis_kirim"
                            class="form-control @error('jenis_kirim') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jenis Kirim</option>
                            @foreach (['kargo', 'ekonomi', 'regular', 'same day', 'standar'] as $jenis)
                                <option value="{{ $jenis }}" {{ old('jenis_kirim') == $jenis ? 'selected' : '' }}>
                                    {{ ucfirst($jenis) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_kirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Ekspedisi -->
                    <div class="form-group">
                        <label for="nama_ekspedisi">Nama Ekspedisi</label>
                        <input type="text" class="form-control @error('nama_ekspedisi') is-invalid @enderror"
                            id="nama_ekspedisi" name="nama_ekspedisi" value="{{ old('nama_ekspedisi') }}" required>
                        @error('nama_ekspedisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Logo Ekspedisi -->
                    <div class="form-group">
                        <label for="logo_ekspedisi">Logo Ekspedisi</label>
                        <input type="file" class="form-control-file @error('logo_ekspedisi') is-invalid @enderror"
                            id="logo_ekspedisi" name="logo_ekspedisi" accept="image/*">
                        @error('logo_ekspedisi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jenis-pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
