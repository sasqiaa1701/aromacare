@extends('layouts.user.app')

@section('content')
    <div class="container mt-4">
        <h2>Profil Pelanggan</h2>

        <form action="{{ route('profile.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Kata Kunci (Password Baru)</label>
                    <input type="password" name="katakunci" class="form-control"
                        placeholder="Isi jika ingin mengganti password">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
                </div>
                <div class="col-md-6">
                    <label>No Telp</label>
                    <input type="text" name="no_telp" value="{{ $pelanggan->no_telp }}" class="form-control">
                </div>
            </div>

            @for ($i = 1; $i <= 3; $i++)
                <h5>Alamat {{ $i }}</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="alamat{{ $i }}" value="{{ $pelanggan->{'alamat' . $i} }}"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Kota</label>
                        <input type="text" name="kota{{ $i }}" value="{{ $pelanggan->{'kota' . $i} }}"
                            class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi{{ $i }}"
                            value="{{ $pelanggan->{'provinsi' . $i} }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Kode Pos</label>
                        <input type="text" name="kodepos{{ $i }}" value="{{ $pelanggan->{'kodepos' . $i} }}"
                            class="form-control">
                    </div>
                </div>
            @endfor

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Foto KTP</label><br>
                    @if ($pelanggan->url_ktp)
                        <a href="{{ asset($pelanggan->url_ktp) }}" target="_blank">Lihat KTP</a><br>
                    @endif
                    <input type="file" name="url_ktp" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Foto</label><br>
                    @if ($pelanggan->foto)
                        <img src="{{ asset($pelanggan->foto) }}" alt="Foto" width="100"><br>
                    @endif
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Simpan Perubahan</button>
            <a class="btn btn-danger mb-2 text-white" href="{{ route('guest.logout', ['id' => 1]) }} ">Logout</a>

        </form>
    </div>
@endsection
