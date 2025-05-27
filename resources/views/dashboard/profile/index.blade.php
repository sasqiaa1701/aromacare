@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card mb-2">
            <div class="card-body">
                <h1 class="mb-3"><i class="mdi mdi-account-circle"></i> Edit Profil</h1>

                <form action="{{ route('profile.admin.update') }}" method="POST">
                    @csrf
                    @method('post')

                    <div class="form-group mb-2">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                            required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password (opsional)</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Simpan
                        Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
