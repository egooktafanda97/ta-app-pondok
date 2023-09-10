<nav class="pcoded-navbar menu-light brand-blue">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/home">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span><span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'operator' || auth()->user()->role == 'SUPER-ADMIN')
                    <li class="nav-item">
                        <a class="nav-link " href="/operator">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Operator</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/pimpinan">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Pimpinan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/register-siswa">
                            <span class="pcoded-micon">
                                <i class="las la-bullhorn"></i>
                            </span><span class="pcoded-mtext">Data Pendaftaran</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'guru')
                    <li class="nav-item">
                        <a class="nav-link " href="/hafalan">
                            <span class="pcoded-micon">
                                <i class="lab la-pied-piper-hat"></i>
                            </span><span class="pcoded-mtext">Progres Hafalan</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'PIMPINAN' || auth()->user()->role == 'SUPER-ADMIN')
                    <li class="nav-item">
                        <a class="nav-link " href="/guru">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Guru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/orangtua">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Orang Tua</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'operator' || auth()->user()->role == 'SUPER-ADMIN')
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
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link " href="/pengasuh">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Pengasuh</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link " href="/siswa_register">
                            <span class="pcoded-micon">
                                <i class="feather icon-users"></i>
                            </span><span class="pcoded-mtext">Santri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/wa/scann">
                            <span class="pcoded-micon">
                                <i class="lab la-whatsapp"></i>
                            </span><span class="pcoded-mtext">Scann Wa</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'orangtua' || auth()->user()->role == 'SUPER-ADMIN')
                    <li class="nav-item">
                        <a class="nav-link " href="/hafalan/show-hafalan-bywali">
                            <span class="pcoded-micon">
                                <i class="fa fa-user"></i>
                            </span><span class="pcoded-mtext">Laporan Hafalan Santri</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'PIMPINAN' || auth()->user()->role == 'SUPER-ADMIN')
                    <li class="nav-item">
                        <a class="nav-link " href="/siswa_register/show-pimpinan">
                            <span class="pcoded-micon">
                                <i class="fa fa-user"></i>
                            </span><span class="pcoded-mtext">Laporan Hafalan Santri</span>
                        </a>
                    </li>
                @endif



                {{-- LAPORAN HAFALAN ORANG TUA DAN PIMPINAN --}}

                @if (auth()->user()->role == 'orangtua')
                <li class="nav-item">
                    <a class="nav-link " href="/orangtua/hafalansantri">
                        <span class="pcoded-micon">
                            <i class="lab la-pied-piper-hat"></i>
                        </span><span class="pcoded-mtext">Progres Hafalan Anak</span>
                    </a>
                </li>
            @endif
                @if (auth()->user()->role == 'pimpinan')
                <li class="nav-item">
                    <a class="nav-link " href="/pimpinan/hafalan">
                        <span class="pcoded-micon">
                            <i class="lab la-pied-piper-hat"></i>
                        </span><span class="pcoded-mtext">Progres Hafalan Santri</span>
                    </a>
                </li>
            @endif

                 {{-- LAPORAN HAFALAN ORANG TUA DAN PIMPINAN --}}


                <li class="nav-item">
                    <a class="nav-link " href="/login/logout">
                        <span class="pcoded-micon">
                            <i class="las la-sign-out-alt"></i>
                        </span><span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
