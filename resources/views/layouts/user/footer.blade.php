<footer class="footer">
    <div class="footer-area">
        <div class="container">
            <div class="row section_gap">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title large_title">Our Mission</h4>
                        <p style="text-align: justify">
                        Our priority is to provide an easy and satisfying online shopping experience for your healthcare needs.
                        We are committed to the best service, quality pharmacy products, and professional and integrity-driven 
                        customer support.
                        </p>
                        <p style="text-align: justify">
                        We are dedicated to empowering individuals with access to safe and affordable healthcare, 
                        and we continuously innovate to ensure these services are readily available.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">Our Contact</h4>
                        <div class="ps-md-4">
                            <p class="sm-head">
                                <span class="fa fa-location-arrow"></span>
                                Main Office
                            </p>
                            <p>Merdeka Street, 123, Jakarta</p>

                            <p class="sm-head">
                                <span class="fa fa-phone"></span>
                                Phone
                            </p>
                            <p>
                                +62 0101 9988 727 <br>
                                +62 0101 8899 272
                            </p>

                            <p class="sm-head">
                                <span class="fa fa-envelope"></span>
                                Email
                            </p>
                            <p>
                                info@aromacare.co.id <br>
                                www.aromacare.co.id
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row d-flex">
                <p class="col-lg-12 footer-text text-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> AromaCare  <i class="fa fa-heart" aria-hidden="true"></i> by <a
                        href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>
<!--================ End footer Area  =================-->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('user') }}/vendors/jquery/jquery-3.2.1.min.js"></script>
<script src="{{ asset('user') }}/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>

<script src="{{ asset('user') }}/vendors/skrollr.min.js"></script>
<script src="{{ asset('user') }}/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="{{ asset('user') }}/vendors/nice-select/jquery.nice-select.min.js"></script>
<script src="{{ asset('user') }}/vendors/jquery.ajaxchimp.min.js"></script>
<script src="{{ asset('user') }}/vendors/mail-script.js"></script>
<script src="{{ asset('user') }}/js/main.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

@stack('js')

@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: {!! json_encode(Session::get('success')) !!}
        });
    </script>
@elseif (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: {!! json_encode(Session::get('error')) !!}
        });
    </script>
@elseif ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Error!',
            text: {!! json_encode($errors->first()) !!}
        });
    </script>
@elseif (Session::has('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Info!',
            text: {!! json_encode(Session::get('info')) !!}
        });
    </script>
@endif


</body>

</html>
