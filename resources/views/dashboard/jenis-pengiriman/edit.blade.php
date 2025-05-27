@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Edit Jenis Pengiriman</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><span class="mdi mdi-home"></span></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('jenis-pengiriman.index') }}">Jenis Pengiriman</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('jenis-pengiriman.update', $jenisPengiriman->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Jenis Kirim -->
                    <div class="form-group">
                        <label for="jenis_kirim">Jenis Kirim</label>
                        <select class="form-control @error('jenis_kirim') is-invalid @enderror" name="jenis_kirim"
                            id="jenis_kirim" required>
                            <option value="">-- Pilih Jenis Kirim --</option>
                            @foreach (['kargo', 'ekonomi', 'regular', 'same day', 'standar'] as $jenis)
                                <option value="{{ $jenis }}"
                                    {{ $jenisPengiriman->jenis_kirim == $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}
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
                            id="nama_ekspedisi" name="nama_ekspedisi"
                            value="{{ old('nama_ekspedisi', $jenisPengiriman->nama_ekspedisi) }}" required>
                        @error('nama_ekspedisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Logo Ekspedisi -->
                    <div class="form-group">
                        <label for="logo_ekspedisi">Logo Ekspedisi</label>
                        @if ($jenisPengiriman->logo_ekspedisi)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $jenisPengiriman->logo_ekspedisi) }}" alt="Logo"
                                    height="100">
                            </div>
                        @endif
                        <input type="file" class="form-control-file @error('logo_ekspedisi') is-invalid @enderror"
                            id="logo_ekspedisi" name="logo_ekspedisi" accept="image/*">
                        @error('logo_ekspedisi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('jenis-pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
