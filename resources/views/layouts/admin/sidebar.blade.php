<div id="sidebar" class="sidebar sidebar-with-footer">
    <!-- Aplication Brand -->
    <div class="app-brand">
        <a href="/dashboard" title="Sleek Dashboard">
            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                height="33" viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                    <path class="logo-fill-grey" fill="#D3D3D3" d="M11 4v25l8 4V0z" />
                </g>
            </svg>
            <span class="brand-name text-truncate">AromaCare </span>
        </a>
    </div>

    <div class="" data-simplebar style="height: 100%">
        <ul class="nav  sidebar-inner" id="sidebar-menu">
            <li class="has-sub {{ Request::is('dashboard') ? 'active expand' : '' }}">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="{{ Request::is('dashboard') ? 'true' : 'false' }}" aria-controls="dashboard">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="nav-text">Home</span> <b class="caret"></b>
                </a>

                <ul class="collapse {{ Request::is('dashboard') ? 'show' : '' }}" id="dashboard"
                    data-parent="#sidebar-menu">
                    <div class="sub-menu">
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a class="sidenav-item-link" href="{{ url('dashboard') }}">
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                    </div>
                </ul>
            </li>


            @if ($role == 'admin' || $role == 'apotek' || $role == 'karyawan' || $role == 'kasir')
                <li class="has-sub {{ Request::is('transaksi/*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#transaksi" aria-expanded="{{ Request::is('transaksi/*') ? 'true' : 'false' }}"
                        aria-controls="transaksi">
                        <i class="mdi mdi-cart-outline"></i>
                        <span class="nav-text">Transaksi</span> <b class="caret"></b>
                    </a>

                    <ul class="collapse {{ Request::is('transaksi/*') ? 'show' : '' }}" id="transaksi"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">


                            @if ($role == 'admin' || $role == 'kasir' || $role == 'karyawan')
                                <li class="{{ Request::is('transaksi/penjualan') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('transaksi/penjualan') }}">
                                        <span class="nav-text">Penjualan</span>
                                    </a>
                                </li>
                            @endif

                            @if ($role == 'admin' || $role == 'apoteker')
                                <li class="{{ Request::is('transaksi/pembelian') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('transaksi/pembelian') }}">
                                        <span class="nav-text">Pembelian</span>
                                    </a>
                                </li>
                            @endif
                        </div>
                    </ul>
                </li>
            @endif


            @if ($role == 'admin' || $role == 'pemilik')
                <li class="has-sub {{ Request::is('laporan/*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#laporan"
                        aria-expanded="{{ Request::is('laporan/*') ? 'true' : 'false' }}" aria-controls="laporan">
                        <i class="mdi mdi-file-chart-outline"></i>
                        <span class="nav-text">Laporan</span> <b class="caret"></b>
                    </a>

                    <ul class="collapse {{ Request::is('laporan/*') ? 'show' : '' }}" id="laporan"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ Request::is('laporan/penjualan') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ url('laporan/penjualan') }}">
                                    <span class="nav-text">Laporan Penjualan</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('laporan/pembelian') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ url('laporan/pembelian') }}">
                                    <span class="nav-text">Laporan Pembelian</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            @endif


            @if ($role != 'pemilik' && $role != 'kasir')
                <li
                    class="has-sub {{ Request::is('jenis-obat') || Request::is('jenis-pengiriman') || Request::is('metode-bayar') || Request::is('pelanggan') || Request::is('obat') || Request::is('distributor') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                        aria-expanded="{{ Request::is('jenis-obat') || Request::is('jenis-pengiriman') || Request::is('metode-bayar') || Request::is('pelanggan') || Request::is('obat') || Request::is('distributor') ? 'true' : 'false' }}"
                        aria-controls="app">
                        <i class="mdi mdi-pencil-box-multiple"></i>
                        <span class="nav-text">Data</span> <b class="caret"></b>
                    </a>

                    <ul class="collapse {{ Request::is('jenis-obat') || Request::is('jenis-pengiriman') || Request::is('metode-bayar') || Request::is('pelanggan') || Request::is('obat') || Request::is('distributor') || Request::is('users') ? 'show' : '' }}"
                        id="app" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            <!-- Obat -->
                            @if ($role == 'admin' || $role == 'apoteker' || $role == 'karyawan') 
                                <li class="{{ Request::is('obat') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('obat') }}">
                                        <span class="nav-text">Obat</span>
                                    </a>
                                </li>
                            @endif

                            <!-- Jenis Obat -->
                            @if ($role != 'apoteker')
                                <li class="{{ Request::is('jenis-obat') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('jenis-obat') }}">
                                        <span class="nav-text">Jenis Obat</span>
                                    </a>
                                </li>

                                <!-- Jenis Pengiriman -->
                                <li class="{{ Request::is('jenis-pengiriman') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('jenis-pengiriman') }}">
                                        <span class="nav-text">Jenis Pengiriman</span>
                                    </a>
                                </li>

                                <!-- Metode Pembayaran -->
                                <li class="{{ Request::is('metode-bayar') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('metode-bayar') }}">
                                        <span class="nav-text">Metode Pembayaran</span>
                                    </a>
                                </li>

                                <!-- Pelanggan -->
                                <li class="{{ Request::is('pelanggan') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('pelanggan') }}">
                                        <span class="nav-text">Pelanggan</span>
                                    </a>
                                </li>
                                <!-- Distributor -->
                                <li class="{{ Request::is('distributor') ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ url('distributor') }}">
                                        <span class="nav-text">Distributor</span>
                                    </a>
                                </li>


                                @if ($role == 'admin' || $role == 'apoteker')
                                    <li class="{{ Request::is('users') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{ url('users') }}">
                                            <span class="nav-text">Users</span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                        </div>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
