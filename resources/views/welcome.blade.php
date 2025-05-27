@extends('layouts.user.app')

@section('content')
    <main class="site-main">

        <!--================ Hero banner start =================-->
        <section class="hero-banner">
            <div class="container">
                <div class="row no-gutters align-items-center pt-60px">
                    <div class="col-5 d-none d-sm-block">
                        <div class="hero-banner__img">
                            <img class="img-fluid" src="{{ asset('user') }}/img/home/hero-banner.png" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                        <div class="hero-banner__content">
                            <h4>Easy Medicine Shopping</h4>
                            <h1>Find Quality Medicine for Your Needs</h1>
                            <p>We provide a wide range of quality medicines from trusted distributors. Enjoy the convenience of fulfilling your healthcare needs, quickly and safely.</p>
                            <a class="button button-hero" href="{{ route('landing.category') }}">See Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Hero banner start =================-->

        <!--================ Hero Carousel start =================-->

        <!--================ Hero Carousel end =================-->

        <!-- ================ trending product section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Top Searched Items</p>
                    <h2>Top <span class="section-intro__style">Items</span></h2>
                </div>
                <div class="row">
                    @foreach ($obats as $item)
                        <div class="col-md-6 col-lg-4" data-jenis="{{ $item->jenisObat->id }}">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ asset('storage/' . $item->foto1) }}" alt="Foto Obat">
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
            </div>
        </section>
    </main>
@endsection
