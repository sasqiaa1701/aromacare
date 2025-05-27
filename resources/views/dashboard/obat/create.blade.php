@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Tambah Obat</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <span class="mdi mdi-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('obat.index') }}">Obat</a>
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
                <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Obat -->
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat"
                            name="nama_obat" value="{{ old('nama_obat') }}" required>
                        @error('nama_obat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Obat -->
                    <div class="form-group">
                        <label for="id_jenis">Jenis Obat</label>
                        <select name="id_jenis" id="id_jenis" class="form-control @error('id_jenis') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>Pilih Jenis Obat</option>
                            @foreach ($jenisObat as $jenis)
                                <option value="{{ $jenis->id }}" {{ old('id_jenis') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga Jual -->
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual"
                            name="harga_jual" value="{{ old('harga_jual') }}" required>
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi Obat -->
                    <div class="form-group">
                        <label for="deskripsi_obat">Deskripsi Obat</label>
                        <textarea class="form-control @error('deskripsi_obat') is-invalid @enderror" id="deskripsi_obat" name="deskripsi_obat"
                            rows="4" required>{{ old('deskripsi_obat') }}</textarea>
                        @error('deskripsi_obat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto 1 -->
                    <div class="form-group">
                        <label for="foto1">Foto 1</label>
                        <input type="file" class="form-control-file @error('foto1') is-invalid @enderror" id="foto1"
                            name="foto1" accept="image/*" required>
                        @error('foto1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto 2 -->
                    <div class="form-group">
                        <label for="foto2">Foto 2</label>
                        <input type="file" class="form-control-file @error('foto2') is-invalid @enderror" id="foto2"
                            name="foto2" accept="image/*">
                        @error('foto2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto 3 -->
                    <div class="form-group">
                        <label for="foto3">Foto 3</label>
                        <input type="file" class="form-control-file @error('foto3') is-invalid @enderror" id="foto3"
                            name="foto3" accept="image/*">
                        @error('foto3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
                            name="stok" value="{{ old('stok') }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
