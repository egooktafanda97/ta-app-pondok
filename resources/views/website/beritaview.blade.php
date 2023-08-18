@extends('website.layouts')

@section('content')
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                            <div class="col-md-12 wow slideInUp" data-wow-delay="0.1s">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                   
                                    <div class="p-4">
                                        <h4 class="mb-3">{!!$judul!!}</h4>
                                        <p>{!!$artikel!!}</p>
                                        <a class="text-uppercase text-info h4" href="/berita"> <i
                                            class="bi bi-arrow-left"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <!-- Blog list End -->

            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
