<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pondok pesantren</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('landing-page') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="{{ asset('landing-page') }}/lib/animate/animate.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('landing-page') }}/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('landing-page') }}/css/style.css" rel="stylesheet" />
    
</head>

<body>
    <!-- Spinner Start -->
    <div class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
        id="spinner">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a class="navbar-brand p-0" href="index.html">
                <h1 class="m-0"><i class="fa fa-mosque me-2"></i>Al-Zaytun</h1>
            </a>
            <button class="navbar-toggler" data-bs-target="#navbarCollapse" data-bs-toggle="collapse" type="button">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a class="nav-item nav-link" href="/">Home</a>
                    <a class="nav-item nav-link" href="/tentang">Tentang</a>
                    <a class="nav-item nav-link" href="/berita">Berita</a>
                    
                    <a class="nav-item nav-link" href="/kontak">Kontak</a>
                </div>
                <butaton class="btn text-primary ms-3" data-bs-target="#searchModal" data-bs-toggle="modal"
                    type="button"><i class="fa fa-search"></i></butaton>
            </div>
        </nav>

        <div class="carousel slide carousel-fade" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100" src="{{ asset('landing-page') }}/img/carousel01.jpg" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                                Beriman
                            </h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">
                                Siswa yang beriman dan bertakwa
                            </h1>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img alt="Image" class="w-100" src="{{ asset('landing-page') }}/img/carousel02.jpg" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">
                                Berpendidikan
                            </h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">
                                Menjadi siswa yang cerdas dan berpendidikan
                            </h1>

                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#header-carousel" type="button">
                <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#header-carousel" type="button">
                <span aria-hidden="true" class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->
    @yield('content')

    <!-- Back to Top -->
    <a class="btn btn-lg btn-primary btn-lg-square rounded back-to-top" href="#"><i
            class="bi bi-arrow-up"></i></a>
            
            @include('sweetalert::alert')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing-page') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('landing-page') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('landing-page') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('landing-page') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('landing-page') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landing-page') }}/js/main.js"></script>
    
</body>

</html>
