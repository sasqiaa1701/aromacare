<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            Copyright &copy; <span id="copy-year"></span> a template by
            <a class="text-primary" href="https://themefisher.com" target="_blank">Themefisher</a>.
        </p>
    </div>
    <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
    </script>
</footer>
</div>
<!-- End Page Wrapper -->
</div>


<!-- Javascript -->
<script src="{{ asset('admin') }}/assets/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/simplebar/simplebar.min.js"></script>

<script src="{{ asset('admin') }}/assets/plugins/charts/Chart.min.js"></script>
<script src="{{ asset('admin') }}/assets/js/chart.js"></script>

<script src="{{ asset('admin') }}/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="{{ asset('admin') }}/assets/js/vector-map.js"></script>

<script src="{{ asset('admin') }}/assets/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{ asset('admin') }}/assets/js/date-range.js"></script>

<script src="{{ asset('admin') }}/assets/plugins/toastr/toastr.min.js"></script>

<script src="{{ asset('admin') }}/assets/js/sleek.js"></script>
<link href="{{ asset('admin') }}/assets/options/optionswitch.css" rel="stylesheet" />
<script src="{{ asset('admin') }}/assets/options/optionswitcher.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>


<script>
    @if (session('success'))

        toastr.success("{{ session('success') }}", "Sukses!");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}", "Gagal!");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}", "Peringatan!");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}", "Info");
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Error!");
        @endforeach
    @endif
</script>


</body>

</html>
