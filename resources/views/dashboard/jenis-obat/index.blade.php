@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-wrapper">
                        <h1>Jenis Obat</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <span class="mdi mdi-home"></span>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Jenis Obat</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('jenis-obat.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle-outline"></i> Tambah Jenis Obat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mt-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenisObats as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis }}</td>
                                    <td>{{ $item->deskripsi_jenis }}</td>
                                    <td>
                                        <img class="image-fluid img-thumbnail " style="height: 100px"
                                            src="{{ asset('storage/' . $item->image_url) }}" alt="image-urls">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2" style="gap: 10px">
                                            <a href="{{ route('jenis-obat.edit', ['jenis_obat' => $item->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('jenis-obat.destroy', ['jenis_obat' => $item->id]) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button href="#" class="btn btn-danger btn-sm"
                                                    type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
