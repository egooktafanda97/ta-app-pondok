@extends('website.layouts')
@section('content')
    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, 0.7)">
                <div class="modal-header border-0">
                    <button aria-label="Close" class="btn bg-white btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px">
                        <input class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword"
                            type="text" />
                        <button class="btn btn-primary px-4">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="d-grid rounded gap-2 col-4 mx-auto mb-5">
                <a class="btn btn-warning btn-lg uppercase text-white mb-0 shadow " href="/daftarmandiri/form"
                    style="border-radius: 40px;
                " type="button">DAFTAR SEKARANG</a>
            </div>
            {{-- <div class="row gx-0">
                <div class="col-lg-6 wow zoomIn " data-wow-delay="0.1s">
                    <div class="bg-success  shadow d-flex align-items-center justify-content-center p-4"
                        style="height: 150px">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2"
                            style="width: 60px; height: 60px">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Siswa</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2"
                            style="width: 60px; height: 60px">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Alummni</h5>
                            <h1 class="mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Facts Start -->

    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="card" style="border: none">
            <div class="card-body">
                <div class="w-100"
                    style="display: flex; justify-content: center; align-items: center; flex-direction: column">
                    <h4>MOTO</h4>
                    <h5>BERILMU, BERIMAN, BERDAKWA</h5>
                </div>

            </div>
        </div>
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px">
                <h5 class="fw-bold text-primary text-uppercase">Visi & Misi</h5>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">

                        <h4 class="mb-3">Visi</h4>
                        <p class="m-0">
                            Mewujudkan Generasi Emas yang Qurani....
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="/visi">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">

                        <h4 class="mb-3">Misi</h4>
                        <p class="m-0">
                            1.Melaksanakan program hafalan Al-Quran 30 Juz selama masa belajar 6 tahun....
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="/misi">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Tentang kami</h5>
                        <h1 class="mb-0">
                            Yayasan Markazul Qur'an Wassunnah </h1>

                    </div>
                    <p class="mb-4">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Yayasan Markazul Quran Wassunnah atau yang disingkat dengan
                        Yayasan MQS dibentuk pada tanggal 29 November 2021 oleh H. M. Sarin, Apt. Mulfiana, S.Farm dan Nur
                        Pidayatai, Lc di Desa Petapahan. Yayasan MQS didirikan dalam rangka berpartisipasi untuk
                        pengembangan syiar agama Islam dan Pendidikan anak yang menanamkan pengetahuan dan nilai-nilai
                        ajaran Islam yang penuh dengan kemuliaan di Kabupaten Kuantan Singingi Provinsi Riau, Indonesia
                        dengan tujuan menghasilkan generasi yang akan menjadi aset ummat Islam Indonesia melahirkan generasi
                        pejuang, ulama dan pemimpin bangsa yang berakhlakul karimah.
                    </p>
                    <p class="mb-4"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Markazul Quran Wassunnah memiliki tujuan yaitu
                        menjadikan Pondok Pesantren sebagai
                        wahana untuk menyebarkan luaskan ajaran agama Islam, menjadikan Pondok Pesantren sebagai wadah untuk
                        menuntut Ilmu bagi para Santri sesuai dengan tuntunan Al-Quran dan Sunnah, menjadikan Pondok
                        Pesantren sebagai lembaga pendidikan Islam yang akan melahirkan para Ahli Quran yang bertakwa dan
                        berakhlakul karimah, menyiapkan sumber daya manusia yang berkualitas global serta mampu bersaing dan
                        mengukir prestasi di kancah dunia, dan memfasilitasi para santri dengan fasilitas ruang yang sesuai
                        standar yang menjadi faktor keberhasilan proses belajar mengajar.
                    </p>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">


                    </div>

                </div>
                <div class="col-lg-5" style="min-height: 500px">
                    <div class="position-relative h-100">
                        <img class="img-fluid rounded wow zoomIn" data-wow-delay="0.9s"
                            src="{{ asset('landing-page') }}/img/tentang.jpg" style="object-fit: cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">SEJARAH</h5>
                        <h1 class="mb-0">
                            Yayasan Markazul Qur'an Wassunnah </h1>

                    </div>
                    <p class="mb-4">
                        ...
                    </p>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">


                    </div>

                </div>
                <div class="col-lg-5" style="min-height: 500px">
                    <div class="position-relative h-100">
                        <img class="img-fluid rounded wow zoomIn" data-wow-delay="0.9s"
                            src="{{ asset('landing-page') }}/img/tentang.jpg" style="object-fit: cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
