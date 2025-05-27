@extends('layouts.user.app')

@section('content')
    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Filter Jenis Obat</div>
                        <ul class="main-categories">
                            <li class="common-filter">
                                <ul>
                                    <li>
                                        <input class="pixel-radio" type="radio" name="jenis_obat" id="jenisAll"
                                            value="all" checked>
                                        <label for="jenisAll">Semua</label>
                                    </li>
                                    @foreach ($jenisObats as $item)
                                        <li class="filter-list">
                                            <input class="pixel-radio" type="radio" name="jenis_obat"
                                                id="jenis{{ $item->id }}" value="{{ $item->id }}">
                                            <label for="jenis{{ $item->id }}">
                                                {{ $item->jenis }}
                                                <span>({{ $item->deskripsi_jenis }})</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Produk Obat -->
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Produk List -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row">
                            @foreach ($obats as $item)
                                <div class="col-md-6 col-lg-4" data-jenis="{{ $item->jenisObat->id }}">
                                    <div class="card text-center card-product">
                                        <div class="card-product__img">
                                            <img class="card-img" src="{{ asset('/storage/' . $item->foto1) }}"
                                                alt="Foto Obat">
                                            <ul class="card-product__imgOverlay">
                                                <li>
                                                    <button
                                                        onclick="window.location.href='{{ route('landing.product.detail', ['id' => $item->id]) }}'"
                                                        class="btn">
                                                        <i class="ti-search"></i>
                                                    </button>
                                                </li>

                                                <li>
                                                    <form action="{{ route('pelanggan.addToCart', ['id' => $item->id]) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit">
                                                            <i class="ti-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $item->jenisObat->jenis }}</p>
                                            <h4 class="card-product__title"><a href="#">{{ $item->nama_obat }}</a>
                                            </h4>
                                            <p class="card-product__price">Rp. {{ number_format($item->harga_jual) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="jenis_obat"]');
            const cards = document.querySelectorAll('[data-jenis]');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selected = this.value;
                    cards.forEach(card => {
                        if (selected === 'all' || card.dataset.jenis === selected) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
