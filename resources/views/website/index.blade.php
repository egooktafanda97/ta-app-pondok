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
                <a href="/daftarmandiri/form" type="button" class="btn btn-warning btn-lg uppercase text-white mb-0 shadow " style="border-radius: 40px;
                ">DAFTAR SEKARANG</a>
            </div>
            <div class="row gx-0">
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
            </div>
        </div>
    </div>
    <!-- Facts Start -->

    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px">
                <h5 class="fw-bold text-primary text-uppercase">Visi & Misi</h5>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-trophy text-white"></i>
                        </div>
                        <h4 class="mb-3">Visi</h4>
                        <p class="m-0">
                            Amet justo dolor lorem kasd amet magna sea stet eos vero lorem
                            ipsum dolore sed....
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="visi.html">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-trophy text-white"></i>
                        </div>
                        <h4 class="mb-3">Misi</h4>
                        <p class="m-0">
                            Amet justo dolor lorem kasd amet magna sea stet eos vero lorem
                            ipsum dolore sed....
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="misi.html">
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
                            Pondok pesantren Al-Zaytun
                        </h1>
                    </div>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                        sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem
                        et sit, sed stet no labore lorem sit. Sanctus clita duo justo et
                        tempor eirmod magna dolore erat amet
                    </p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3">
                                <i class="fa fa-check text-primary me-3"></i>Komputer
                            </h5>
                            <h5 class="mb-3">
                                <i class="fa fa-check text-primary me-3"></i>Latihan kepemimpinan
                            </h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3">
                                <i class="fa fa-check text-primary me-3"></i>Olahraga
                            </h5>
                            <h5 class="mb-3">
                                <i class="fa fa-check text-primary me-3"></i>Pertanian
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">


                    </div>

                </div>
                <div class="col-lg-5" style="min-height: 500px">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="{{ asset('landing-page') }}/img/tentang.jpg" style="object-fit: cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
