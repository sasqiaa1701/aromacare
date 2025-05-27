@extends('layouts.user.app')

@section('content')
    <div class="product_image_area mb-4">
        <div class="container">
            <form action="{{ route('pelanggan.addToCart', ['id' => $obat->id]) }}" method="post">
                @csrf
                <div class="row s_product_inner">
                    <div class="col-lg-6">
                        <div class="owl-carousel owl-theme s_Product_carousel">
                            <div class="single-prd-item">
                                <img class="img-fluid" src="{{ asset('storage/' . $obat->foto1) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="s_product_text">
                            <h3>{{ $obat->nama_obat }}</h3>
                            <h2>Rp. {{ number_format($obat->harga_jual, 2) }}</h2>
                            <ul class="list">
                                <li><a class="active" href="#"><span>Category</span> :
                                        {{ $obat->jenisObat->jenis }}</a>
                                </li>
                                <li><a href="#"><span>Availibility</span> :
                                        @if ($obat->stok != 0)
                                            Tersedia
                                        @else
                                            Habis
                                        @endif
                                    </a></li>
                            </ul>
                            <p>{{ $obat->deskripsi_obat }}</p>

                            <!-- Quantity Section -->
                            <div class="product_count d-flex align-items-center">
                                <label for="qty">Quantity:</label>
                                <div class="quantity_selector d-flex align-items-center ml-3">
                                    <input type="text" name="jumlah_order" id="sst" size="2" maxlength="12"
                                        value="{{ $jumlah_order }}" title="Quantity:" class="input-text qty text-center">
                                </div>
                            </div>

                            <button type="submit" class="button primary-btn">Add to Cart</button>
                            <div class="card_area d-flex align-items-center">
                                <img class="img-thumbnail" style="height: 100px"
                                    src="{{ asset('storage/' . $obat->foto2) }}" alt="">
                                <img class="img-thumbnail" style="height: 100px"
                                    src="{{ asset('storage/' . $obat->foto3) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
