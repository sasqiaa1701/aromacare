@extends('layouts.user.app')
@section('content')
    <!-- Status Order Tab -->
    <div class="container mt-5">
        <ul class="nav nav-tabs" id="statusOrderTabs" role="tablist">
            @foreach (['Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Selesai'] as $status)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ Str::slug($status) }}-tab"
                        data-bs-toggle="tab" href="#{{ Str::slug($status) }}" role="tab"
                        aria-controls="{{ Str::slug($status) }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $status }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-4" id="statusOrderTabsContent">
            @foreach (['Menunggu Konfirmasi', 'Diproses', 'Menunggu Kurir', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Selesai'] as $status)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ Str::slug($status) }}"
                    role="tabpanel" aria-labelledby="{{ Str::slug($status) }}-tab">
                    <h4>Status: {{ $status }}</h4>

                    @php
                        $filteredOrders = $orders->where('status_order', $status);
                    @endphp

                    @if ($filteredOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredOrders as $key => $order)
                                        @php
                                            $adaObatKeras = $order->detail_penjualan->contains(function ($detail) {
                                                return $detail->obat && $detail->obat->id_jenis == 3;
                                            });

                                        @endphp

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>Rp{{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                            <td>{{ optional($order->metode_bayar)->metode_pembayaran ?? 'belum-set' }}</td>
                                            <td>
                                                @php
                                                    $orderDetails = $order->detail_penjualan->map(function ($detail) {
                                                        return [
                                                            'nama_obat' => $detail->obat->nama_obat,
                                                            'harga' => number_format($detail->harga_beli, 0, ',', '.'),
                                                            'jumlah' => $detail->jumlah_beli,
                                                            'subtotal' => number_format($detail->subtotal, 0, ',', '.'),
                                                        ];
                                                    });
                                                @endphp
                                                <div class="d-flex" style="gap: 5px">
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#statusDetailModal"
                                                        data-order="{{ $order->id }}"
                                                        data-details='@json($orderDetails)'>
                                                        Lihat Detail
                                                    </button>

                                                    @if ($adaObatKeras)
                                                        @if (!isset($order->url_resep))
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalResep{{ $order->id }}">
                                                                Masukan resep
                                                            </button>
                                                        @else
                                                            <a href="{{ asset('/storage' . '/' . $order->url_resep) }}"
                                                                target="_blank">Lihat
                                                                Resep</a>
                                                        @endif
                                                    @endif

                                                    @if ($status == 'Menunggu Konfirmasi')
                                                        <button type="button" class="btn btn-success btn-sm pay-button"
                                                            data-order-id="{{ $order->id }}">
                                                            Bayar
                                                        </button>

                                                        <div class="modal fade" id="modalResep{{ $order->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="modalResep{{ $order->id }}Label"
                                                            aria-hidden="true">
                                                            <form
                                                                action="{{ route('pelanggan.checkout.resep', ['id' => $order->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title fs-5"
                                                                                id="exampleModalLabel">
                                                                                Masukan Resep Dokter
                                                                                </h1>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="">Gambar Resep
                                                                                    Dokter</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="url_resep">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Kirim</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>



                                                        <form
                                                            action="{{ route('pelanggan.checkout.cancel', ['id' => $order->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm"
                                                                type="submit">Cancel</button>
                                                        </form>
                                                    @endif
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tidak ada pesanan dengan status "{{ $status }}".</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    

    <!-- Modal for Status Details -->
    <div class="modal fade" id="statusDetailModal" tabindex="-1" aria-labelledby="statusDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusDetailModalLabel">Detail Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="order-obat-detail">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var statusModal = document.getElementById('statusDetailModal');
        statusModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var details = JSON.parse(button.getAttribute('data-details'));
            console.log(details)
            var tbody = document.getElementById('order-obat-detail');

            tbody.innerHTML = '';

            details.forEach(function(item) {
                var row = `<tr>
                <td>${item.nama_obat}</td>
                <td>Rp${item.harga}</td>
                <td>${item.jumlah}</td>
                <td>Rp${item.subtotal}</td>
            </tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        });
    </script>


    <script>
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.dataset.orderId;

                fetch('/api/checkout/token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order_id: orderId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        snap.pay(data.token, {
                            onSuccess: function(result) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil!',
                                    text: 'Pesanan Anda akan segera diproses.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Mengupdate status dan metode pembayaran di tampilan
                                    const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
                                    if (orderRow) {
                                        orderRow.querySelector('.status').textContent = 'Diproses';
                                        orderRow.querySelector('.metode-pembayaran').textContent = result.payment_type; // Update metode pembayaran
                                    }
                                });
                            },
                            onPending: function(result) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Menunggu Pembayaran',
                                    text: 'Silakan selesaikan pembayaran Anda.',
                                });
                            },
                            onError: function(result) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat memproses pembayaran.',
                                });
                            },
                            onClose: function() {
                                console.log('Snap pop-up ditutup tanpa menyelesaikan pembayaran');
                            }
                        });
                    } else {
                        Swal.fire('Gagal', 'Gagal mendapatkan token pembayaran.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Kesalahan', 'Terjadi kesalahan saat memproses pembayaran.', 'error');
                });
            });
        });
    </script>
@endpush
