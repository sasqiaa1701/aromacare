@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-2">
        <div class="card mb-2">
            <div class="card-body">
                <div class="breadcrumb-wrapper mb-3">
                    <h1><i class="mdi mdi-cart-plus"></i> Transaksi Pembelian Obat</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span
                                        class="mdi mdi-home"></span></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Form Pembelian -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        @php
                            $now = \Carbon\Carbon::now();
                            $generatedNota = 'NOTA-' . $now->format('Ymd-His');
                        @endphp
                        <form action="{{ route('pembelian.store') }}" method="POST" id="pembelian-form">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><i class="mdi mdi-receipt"></i> No. Nota</label>
                                    <input type="text" name="nota" class="form-control" value="{{ $generatedNota }}"
                                        readonly required>
                                </div>
                                <div class="col-md-4">
                                    <label><i class="mdi mdi-calendar"></i> Tanggal Pembelian</label>
                                    <input type="date" name="tgl_pembelian" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label><i class="mdi mdi-truck"></i> Distributor</label>
                                    <select name="id_distributor" class="form-control" required>
                                        <option value="">-- Pilih Distributor --</option>
                                        @foreach ($distributors as $distributor)
                                            <option value="{{ $distributor->id }}">{{ $distributor->nama_distributor }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Input Obat -->
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label><i class="mdi mdi-pill"></i> Obat</label>
                                    <select id="obat-select" class="form-control">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach ($obats as $obat)
                                            <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}">
                                                {{ $obat->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><i class="mdi mdi-counter"></i> Jumlah</label>
                                    <input type="number" id="jumlah-input" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label><i class="mdi mdi-currency-idr"></i> Harga Beli</label>
                                    <input type="number" id="harga-input" class="form-control">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-success w-100" id="add-to-cart">
                                        <i class="mdi mdi-cart-arrow-down"></i> Tambah
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden Inputs & Submit -->
                            <input type="hidden" name="total_bayar" id="totalBayarInput">
                            <div id="detail-fields"></div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save"></i> Simpan Pembelian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5><i class="mdi mdi-basket"></i> Keranjang Obat</h5>
                        <table class="table table-bordered" id="keranjang-table">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th colspan="2" id="total-bayar">0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        let totalBayar = 0;

        document.getElementById('add-to-cart').addEventListener('click', function() {
            const obatSelect = document.getElementById('obat-select');
            const jumlahInput = document.getElementById('jumlah-input');
            const hargaInput = document.getElementById('harga-input');

            const obatId = obatSelect.value;
            const namaObat = obatSelect.options[obatSelect.selectedIndex]?.dataset.nama || '';
            const jumlah = parseInt(jumlahInput.value);
            const harga = parseInt(hargaInput.value);

            if (!obatId || !jumlah || !harga) {
                alert("Isi semua kolom terlebih dahulu.");
                return;
            }

            const subtotal = jumlah * harga;
            totalBayar += subtotal;

            // Tampilkan ke tabel
            const tbody = document.querySelector("#keranjang-table tbody");
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${namaObat}</td>
                <td>${jumlah}</td>
                <td>${harga}</td>
                <td>${subtotal}</td>
                <td><button type="button" class="btn btn-sm btn-danger btn-remove"><i class="mdi mdi-delete"></i></button></td>
            `;
            tbody.appendChild(row);

            // Tambahkan input hidden ke form
            const detailFields = document.getElementById('detail-fields');
            detailFields.innerHTML += `
                <input type="hidden" name="obat_id[]" value="${obatId}">
                <input type="hidden" name="jumlah_beli[]" value="${jumlah}">
                <input type="hidden" name="harga_beli[]" value="${harga}">
                <input type="hidden" name="subtotal[]" value="${subtotal}">
            `;

            document.getElementById('total-bayar').innerText = totalBayar.toLocaleString();
            document.getElementById('totalBayarInput').value = totalBayar;

            // Reset input
            obatSelect.value = "";
            jumlahInput.value = "";
            hargaInput.value = "";
        });

        // Hapus item dari keranjang
        document.querySelector("#keranjang-table tbody").addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove')) {
                const row = e.target.closest('tr');
                const subtotal = parseInt(row.children[3].innerText);
                totalBayar -= subtotal;
                document.getElementById('total-bayar').innerText = totalBayar.toLocaleString();
                document.getElementById('totalBayarInput').value = totalBayar;
                row.remove();
            }
        });
    </script>
@endsection
