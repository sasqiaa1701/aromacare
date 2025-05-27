@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Edit Metode Pembayaran</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <span class="mdi mdi-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('metode-bayar.index') }}">Metode Pembayaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('metode-bayar.update', $metodeBayar->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <input type="text" class="form-control @error('metode_pembayaran') is-invalid @enderror"
                            id="metode_pembayaran" name="metode_pembayaran"
                            value="{{ old('metode_pembayaran', $metodeBayar->metode_pembayaran) }}" required>
                        @error('metode_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tempat_bayar">Tempat Bayar</label>
                        <input type="text" class="form-control @error('tempat_bayar') is-invalid @enderror"
                            id="tempat_bayar" name="tempat_bayar"
                            value="{{ old('tempat_bayar', $metodeBayar->tempat_bayar) }}" required>
                        @error('tempat_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_rekening">No. Rekening</label>
                        <input type="text" class="form-control @error('no_rekening') is-invalid @enderror"
                            id="no_rekening" name="no_rekening" value="{{ old('no_rekening', $metodeBayar->no_rekening) }}"
                            required>
                        @error('no_rekening')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url_logo">Logo (Opsional)</label><br>
                        @if ($metodeBayar->url_logo)
                            <img src="{{ asset('storage/' . $metodeBayar->url_logo) }}" alt="Logo" width="100"
                                class="mb-2">
                        @endif
                        <input type="file" class="form-control-file @error('url_logo') is-invalid @enderror"
                            id="url_logo" name="url_logo" accept="image/*">
                        @error('url_logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('metode-bayar.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
