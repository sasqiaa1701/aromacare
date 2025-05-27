@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
                    <div>
                        <h1>Edit Pelanggan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}"><span class="mdi mdi-home"></span></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control"
                                value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                            @error('nama_pelanggan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $pelanggan->email) }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="katakunci" class="form-control">
                            @error('katakunci')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control"
                                value="{{ old('no_telp', $pelanggan->no_telp) }}">
                            @error('no_telp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-12">
                                <h5>Alamat {{ $i }}</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat{{ $i }}" class="form-control"
                                    value="{{ old("alamat$i", $pelanggan["alamat$i"]) }}">
                                @error("alamat$i")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kota</label>
                                <input type="text" name="kota{{ $i }}" class="form-control"
                                    value="{{ old("kota$i", $pelanggan["kota$i"]) }}">
                                @error("kota$i")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Provinsi</label>
                                <input type="text" name="provinsi{{ $i }}" class="form-control"
                                    value="{{ old("provinsi$i", $pelanggan["provinsi$i"]) }}">
                                @error("provinsi$i")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kode Pos</label>
                                <input type="text" name="kodepos{{ $i }}" class="form-control"
                                    value="{{ old("kodepos$i", $pelanggan["kodepos$i"]) }}">
                                @error("kodepos$i")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endfor

                        <div class="col-md-6 mb-3">
                            <label>Foto KTP (URL KTP)</label><br>
                            @if ($pelanggan->url_ktp)
                                <img src="{{ asset($pelanggan->url_ktp) }}" class="mb-2" height="100" alt="KTP">
                            @endif
                            <input type="file" name="url_ktp" class="form-control" accept="image/*">
                            @error('url_ktp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Foto Pelanggan</label><br>
                            @if ($pelanggan->foto)
                                <img src="{{ asset($pelanggan->foto) }}" class="mb-2" height="100" alt="Foto">
                            @endif
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            @error('foto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-content-save"></i> Perbarui
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
