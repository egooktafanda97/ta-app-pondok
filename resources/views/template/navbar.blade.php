<nav class="pcoded-navbar menu-light brand-blue">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="index.html">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span><span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'operator')
                    <li class="nav-item">
                        <a class="nav-link " href="/operator">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Operator</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/register-siswa">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Data Pendaftaran</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'guru')
                    <li class="nav-item">
                        <a class="nav-link " href="/hafalan">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Progres Hafalan</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'operator')
                    <li class="nav-item">
                        <a class="nav-link " href="/orangtua">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Orang Tua</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/guru">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Guru</span>
                        </a>
                    <li class="nav-item">
                        <a class="nav-link " href="/pengasuh">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Pengasuh</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/siswa_register">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/wa/scann">
                            <span class="pcoded-micon">
                                <i class="fa fa-whastapp"></i>
                            </span><span class="pcoded-mtext">Scann Wa</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
