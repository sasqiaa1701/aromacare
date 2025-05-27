@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
                    <div>
                        <h1>Tambah Pelanggan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}"><span class="mdi mdi-home"></span></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan') }}" required>
                            @error('nama_pelanggan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Password</label>
                            <input type="password" name="katakunci" class="form-control" required>
                            @error('katakunci') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
                            @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Alamat 1 -->
                        <div class="col-md-12">
                            <h5>Alamat 1</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat1" class="form-control" value="{{ old('alamat1') }}">
                            @error('alamat1') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota1" class="form-control" value="{{ old('kota1') }}">
                            @error('kota1') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi1" class="form-control" value="{{ old('provinsi1') }}">
                            @error('provinsi1') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kode Pos</label>
                            <input type="text" name="kodepos1" class="form-control" value="{{ old('kodepos1') }}">
                            @error('kodepos1') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Alamat 2 -->
                        <div class="col-md-12">
                            <h5>Alamat 2</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat2" class="form-control" value="{{ old('alamat2') }}">
                            @error('alamat2') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota2" class="form-control" value="{{ old('kota2') }}">
                            @error('kota2') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi2" class="form-control" value="{{ old('provinsi2') }}">
                            @error('provinsi2') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kode Pos</label>
                            <input type="text" name="kodepos2" class="form-control" value="{{ old('kodepos2') }}">
                            @error('kodepos2') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Alamat 3 -->
                        <div class="col-md-12">
                            <h5>Alamat 3</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat3" class="form-control" value="{{ old('alamat3') }}">
                            @error('alamat3') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota3" class="form-control" value="{{ old('kota3') }}">
                            @error('kota3') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi3" class="form-control" value="{{ old('provinsi3') }}">
                            @error('provinsi3') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kode Pos</label>
                            <input type="text" name="kodepos3" class="form-control" value="{{ old('kodepos3') }}">
                            @error('kodepos3') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Uploads -->
                        <div class="col-md-6 mb-3">
                            <label>Foto KTP (URL KTP)</label>
                            <input type="file" name="url_ktp" class="form-control" accept="image/*">
                            @error('url_ktp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Foto Pelanggan</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="mdi mdi-check"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
