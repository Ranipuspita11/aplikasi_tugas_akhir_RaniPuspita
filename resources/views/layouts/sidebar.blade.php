<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="/kaiadmin/assets/img/kaiadmin/logobsl3.png" alt="navbar brand" class="navbar-brand"
                    height="70" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Master Data</h4>
                </li>

                @can('material-list')
                    <li class="nav-item">
                        <a href="{{ route('material.index') }}">
                            <i class="fas fa-boxes"></i>
                            <p>Material</p>
                        </a>
                    </li>
                @endcan
                @can('merk-list')
                    <li class="nav-item">
                        <a href="{{ route('merk.index') }}">
                            <i class="fas fa-tags"></i>
                            <p>Merk</p>
                        </a>
                    </li>
                @endcan
                @can('kategori_produk-list')
                    <li class="nav-item">
                        <a href="{{ route('kategori_produk.index') }}">
                            <i class="fas fa-th-list"></i>
                            <p>Kategori Produk</p>
                        </a>
                    </li>
                @endcan
                @can('satuan-list')
                    <li class="nav-item">
                        <a href="{{ route('satuan.index') }}">
                            <i class="fas fa-ruler-combined"></i>
                            <p>Satuan</p>
                        </a>
                    </li>
                @endcan
                @can('produk_suplier-list')
                    <li class="nav-item">
                        <a href="{{ route('produk_suplier.index') }}">
                            <i class="fas fa-store"></i>
                            <p>Produk Suplier</p>
                        </a>
                    </li>
                @endcan
                @can('suplier-list')
                    <li class="nav-item">
                        <a href="{{ route('suplier.index') }}">
                            <i class="fas fa-truck-loading"></i>
                            <p>Suplier</p>
                        </a>
                    </li>
                @endcan
                @can('rab-list')
                    <li class="nav-item">
                        <a href="{{ route('rab.index') }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>RAB</p>
                        </a>
                    </li>
                @endcan
                @can('rab_detail-list')
                    <li class="nav-item">
                        <a href="{{ route('rab_detail.index') }}">
                            <i class="fas fa-list-alt"></i>
                            <p>RAB Detail</p>
                        </a>
                    </li>
                @endcan
                @can('kegiatan-list')
                    <li class="nav-item">
                        <a href="{{ route('kegiatan.index') }}">
                            <i class="fas fa-tasks"></i>
                            <p>Kegiatan</p>
                        </a>
                    </li>
                @endcan
                {{-- <li class="nav-item">
                    <a href="{{ route('kriteria.index') }}">
                        <i class="fas fa-clipboard-check"></i>
                        <p>Kriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nilai_kriteria.index') }}">
                        <i class="fas fa-star-half-alt"></i>
                        <p>Nilai Kriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('normalisasi.index') }}">
                        <i class="fas fa-balance-scale"></i>
                        <p>Normalisasi</p>
                    </a>
                </li> --}}
                {{-- @can('skor_total-list')
                <li class="nav-item">
                    <a href="{{ route('skor_total.index') }}">
                        <i class="fas fa-chart-bar"></i>
                        <p>Skor Total</p>
                    </a>
                </li> --}}
                {{-- @endcan --}}
                @can('tabel_pengaturan_bobot-list')
                    <li class="nav-item">
                        <a href="{{ route('tabel_pengaturan_bobot.index') }}">
                            <i class="fas fa-sliders-h"></i>
                            <p>Pengaturan Bobot</p>
                        </a>
                    </li>
                @endcan
                @can('tabel_pengaturan_bobot-list')
                    <li class="nav-item">
                        <a href="{{ route('tabel_hasil_wsm.index') }}">
                            <i class="fas fa-sliders-h"></i>
                            <p>Hasil WSM</p>
                        </a>
                    </li>
                @endcan


                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">User Management</h4>
                </li>
                @can('user-list')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-user-friends"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}">
                            <i class="fas fa-user-shield"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>LOG OUT</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
