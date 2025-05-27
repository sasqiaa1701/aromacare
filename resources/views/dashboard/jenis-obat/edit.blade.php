@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="card-body">
                <div class="breadcrumb-wrapper">
                    <h1>Edit Jenis Obat</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <span class="mdi mdi-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('jenis-obat.index') }}">Jenis Obat</a>
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
                <form action="{{ route('jenis-obat.update', $jenisObat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="jenis">Jenis Obat</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis"
                            name="jenis" value="{{ old('jenis', $jenisObat->jenis) }}" required>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi_jenis') is-invalid @enderror" id="deskripsi_jenis" name="deskripsi_jenis" rows="4"
                            required>{{ old('deskripsi_jenis', $jenisObat->deskripsi_jenis) }}</textarea>
                        @error('deskripsi_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">

                        <!-- Menampilkan gambar yang sudah ada jika ada -->
                        @if ($jenisObat->image_url)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $jenisObat->image_url) }}" alt="Image" class="img-thumbnail" width="150">
                                <p class="mt-1 text-muted">Klik untuk pilih gambar baru atau biarkan kosong jika tidak ingin mengganti gambar.</p>
                            </div>
                        @endif

                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jenis-obat.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
