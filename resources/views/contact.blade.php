@extends('layouts.user.app')

@section('content')
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <section class="section-margin--small">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <!-- Leaflet Map Container -->
                <div id="map" style="height: 420px;"></div>
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                <script>
                    var map = L.map('map').setView([-6.2088, 106.8456], 13); // Jakarta coordinates

                    // Add tile layer (OSM or any other)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Add a marker for Jakarta
                    L.marker([-6.2088, 106.8456]).addTo(map)
                        .bindPopup("<b>Jakarta, Indonesia</b><br>AromaCare ")
                        .openPopup();
                </script>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Jakarta, Indonesia</h3>
                            <p>Jl. Thamrin No. 10, Jakarta Pusat</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:+621234567890">+62 21 2345 6789</a></h3>
                            <p>Senin hingga Jumat, 9 pagi hingga 6 sore</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:info@perusahaan.co.id">info@perusahaan.co.id</a></h3>
                            <p>Kirimkan pertanyaan Anda kapan saja!</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <form action="#/" class="form-contact contact_form" method="post" id="contactForm"
                        novalidate="novalidate">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        placeholder="Masukkan nama Anda">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Masukkan alamat email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        placeholder="Masukkan subjek">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5"
                                        placeholder="Masukkan pesan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
