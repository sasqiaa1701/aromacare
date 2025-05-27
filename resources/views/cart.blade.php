@extends('layouts.user.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--bootstrap4 .select2-selection--single {
            height: 38px;
            padding: 0.375rem 0.75rem;
        }

        #ongkir-result {
            font-size: 1.1rem;
        }

        #grand-total-container h5 {
            font-weight: bold;
            color: #2b2b2b;
        }

        @media (max-width: 768px) {
            .checkout_btn_inner .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keranjangs as $item)
                                <tr>
                                    <td>
                                        <div class="media align-items-center">
                                            <img src="{{ asset('storage/' . $item->obat->foto1) }}" alt=""
                                                class="img-thumbnail mr-3" style="height: 100px;">
                                            <div class="media-body">
                                                <h6 class="mt-0">{{ $item->obat->nama_obat }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->harga) }}</td>
                                    <td>
                                        <input type="text" class="form-control text-center"
                                            value="{{ $item->jumlah_order }}" readonly>
                                    </td>
                                    <td>Rp {{ number_format($item->subtotal) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                                <td><strong>Rp {{ number_format($keranjangs->sum('subtotal')) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h5 class="mb-3">Pengiriman</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="jenis-pengiriman">Jenis Pengiriman</label>
                            <select id="jenis-pengiriman" class="form-control">
                                <option value="">Pilih Jenis Pengiriman</option>
                                @foreach ($jenisPengirimans as $pengiriman)
                                    <option value="{{ $pengiriman->nama_ekspedisi }}">{{ $pengiriman->jenis_kirim }} -
                                        {{ $pengiriman->nama_ekspedisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="destination-select">Lokasi Tujuan</label>
                            <select id="destination-select" class="form-control" style="width: 100%"></select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button id="cek-ongkir" class="btn btn-primary btn-block">Cek Ongkir</button>
                        </div>
                    </div>
                    <div class="mt-3" id="ongkir-result">
                        <div class="mt-3">
                            <label for="service-select">Pilih Layanan</label>
                            <select id="service-select" class="form-control" disabled></select>
                        </div>

                        <div class="mt-2" id="selected-ongkir-info"></div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0" id="grand-total-container" style="display: none;">
                            <h5 class="text-md-left text-center">Grand Total: <span id="grand-total-text">Rp 0</span></h5>
                        </div>
                        <div class="col-md-6 text-md-right text-center">
                            <div
                                class="checkout_btn_inner d-flex flex-column flex-md-row justify-content-center justify-content-md-end">
                                <a class="btn btn-secondary mb-2 mb-md-0 mr-md-2"
                                    href="{{ route('landing.category', ['id' => 1]) }}">
                                    Continue Shopping
                                </a>
                                <button id="pay-button" class="btn btn-success">Proceed to Checkout</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#destination-select').select2({
                    placeholder: 'Cari Lokasi Tujuan...',
                    width: '100%',
                    theme: 'bootstrap4',
                    dropdownAutoWidth: true,
                    ajax: {
                        url: '/api/rajaongkir/destinations',
                        dataType: 'json',
                        delay: 300,
                        data: function(params) {
                            return {
                                search: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.data.map(function(item) {
                                    return {
                                        id: item.id,
                                        text: item.label
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 3
                });

                $('#cek-ongkir').click(function() {
                    const destinationId = $('#destination-select').val();
                    const courierId = $('#jenis-pengiriman').val();
                    const weightTotal =
                        {{ $keranjangs->sum(fn($item) => $item->jumlah_order * $item->obat->berat) }};
                    const weight = Math.max(1, weightTotal);

                    // Reset sebelum request baru
                    $('#service-select').html('<option value="">Pilih layanan</option>').prop('disabled', true);
                    $('#selected-ongkir-info').html('');
                    $('#ongkir-result .text-danger').remove(); // hapus error lama jika ada

                    if (!destinationId || !courierId) {
                        alert('Mohon pilih tujuan dan jenis pengiriman terlebih dahulu.');
                        return;
                    }

                    $.ajax({
                        url: '/api/rajaongkir/cek-ongkir',
                        type: 'POST',
                        data: {
                            destination: destinationId,
                            courier: courierId,
                            weight: weight,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            const layanan = res.data;
                            if (Array.isArray(layanan) && layanan.length > 0) {
                                let options = '<option value="">Pilih layanan</option>';
                                layanan.forEach((item, index) => {
                                    options += `<option value="${item.cost}" data-etd="${item.etd}">
                        ${item.service} - ${item.description} (Rp ${item.cost.toLocaleString()}, Estimasi: ${item.etd})
                    </option>`;
                                });
                                $('#service-select').html(options).prop('disabled', false);
                            } else {
                                $('#ongkir-result').append(
                                    `<span class="text-danger">Tidak ada layanan tersedia.</span>`
                                );
                            }
                        },
                        error: function() {
                            $('#ongkir-result').append(
                                `<span class="text-danger">Terjadi kesalahan saat menghubungi server. Silakan coba lagi.</span>`
                            );
                        }
                    });
                });

                $('#service-select').on('change', function() {
                    const ongkir = parseInt($(this).val());
                    const etd = $('option:selected', this).data('etd');
                    const subtotal = {{ $keranjangs->sum('subtotal') }};

                    if (ongkir) {
                        $('#selected-ongkir-info').html(
                            `<span class="text-success">Ongkir dipilih: Rp ${ongkir.toLocaleString()} (Estimasi: ${etd})</span>`
                        );

                        const grandTotal = subtotal + ongkir;
                        $('#grand-total-text').text(`Rp ${grandTotal.toLocaleString()}`);
                        $('#grand-total-container').show();
                    } else {
                        $('#selected-ongkir-info').html('');
                        $('#grand-total-container').hide();
                    }
                });
            });

            $('#pay-button').click(function() {
                const ongkir = parseInt($('#service-select').val());
                if (!ongkir) {
                    alert("Silakan pilih layanan ongkir terlebih dahulu.");
                    return;
                }

                const total = {{ $keranjangs->sum('subtotal') }} + ongkir;

                $.post("{{ route('checkout') }}", {
                    total: total,
                    id_pelanggan: "{{ auth('pelanggan')->user()->id }}",
                    jenis_pengiriman: $("#jenis-pengiriman").val(),
                    ongkir: ongkir,
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    if (data.success) {
                        // Jika checkout berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Checkout berhasil!',
                            text: 'Order ID: ' + data.order_id,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ url('/checkout') }}";
                            }
                        });
                    } else {
                        // Jika checkout gagal
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Checkout',
                            text: data.error,
                            confirmButtonText: 'Coba Lagi'
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
